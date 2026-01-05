<?php

namespace App\Livewire\Boq;

use Livewire\Component;
use App\Models\Boq;
use App\Models\Project;
use App\Models\Tax;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Create extends Component
{
    public $project_id;
    public $project_name = '';
    public $mainBoqs = [];
    public $taxEnabled = false;
    public $taxId = '';
    public $taxes = [];
    public $userProjects = [];
    public $singleProject = false;
    public $noProjectAccess = false;

    public function mount()
    {
        $this->taxes = Tax::all();

        $query = Project::query();
        if (Auth::user()->type === 'Company') {
            $query->where('company_id', Auth::user()->company_id);
        } else {
            $query->whereHas('users', fn($q) => $q->where('user_id', Auth::id()));
        }

        $this->userProjects = $query->orderBy('name')->get()->pluck('name', 'id');

        if ($this->userProjects->isEmpty()) {
            $this->noProjectAccess = true;
            $this->addError('project_access', 'You are not assigned to any project. Contact your admin.');
        } elseif ($this->userProjects->count() === 1) {
            $this->project_id = $this->userProjects->keys()->first();
            $this->singleProject = true;
            $this->loadProjectName();
        }
    }

    public function updatedProjectId()
    {
        $this->loadProjectName();
        $this->regenerateSerials();
    }

    protected function loadProjectName()
    {
        if ($this->project_id) {
            $project = Project::find($this->project_id);
            $this->project_name = $project ? $project->name : '';
        }
    }

    public function updatedTaxEnabled($value)
    {
        if (!$value) {
            $this->taxId = '';
            $this->resetErrorBag('taxId');
        }
    }

    public function addMainBoq()
    {
        $this->mainBoqs[] = [
            'serial_number' => '',
            'name' => '',
            'boqCount' => 0,
            'boqs' => [],
            'subToggled' => false,
            'subCount' => 0,
            'subBoqs' => [],
        ];
        $this->regenerateSerials();
    }

    public function generateMainBoqs($index)
    {
        $this->validate(["mainBoqs.$index.boqCount" => 'required|integer|min:1']);
        $this->mainBoqs[$index]['boqs'] = array_fill(0, $this->mainBoqs[$index]['boqCount'], [
            'serial_number' => '',
            'item_description' => '',
            'unit' => '',
            'quantity' => '',
            'unit_rate' => '',
            'amount' => '',
            'summary' => '',
        ]);
        $this->regenerateSerials();
    }

    public function generateSubBoqs($index)
    {
        $this->validate(["mainBoqs.$index.subCount" => 'required|integer|min:1']);
        $this->mainBoqs[$index]['subBoqs'] = array_fill(0, $this->mainBoqs[$index]['subCount'], [
            'serial_number' => '',
            'name' => '',
            'boqCount' => 0,
            'boqs' => [],
        ]);
        $this->regenerateSerials();
    }

    public function generateSubSubBoqs($mainIndex, $subIndex)
    {
        $this->validate(["mainBoqs.$mainIndex.subBoqs.$subIndex.boqCount" => 'required|integer|min:1']);
        $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'] = array_fill(0, $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqCount'], [
            'serial_number' => '',
            'item_description' => '',
            'unit' => '',
            'quantity' => '',
            'unit_rate' => '',
            'amount' => '',
            'summary' => '',
        ]);
        $this->regenerateSerials();
    }

    /**
     * Generate project code like HWBD (first letters of each word)
     * "Highway Bridge" → "HWBD"
     * "Office Tower A" → "OTA"
     */
    protected function getProjectCode()
    {
        if (empty($this->project_name)) {
            return strtoupper(Str::random(4));
        }
        
        // Split words and take first letter of each (max 4 chars)
        $words = explode(' ', trim($this->project_name));
        $code = '';
        
        foreach ($words as $word) {
            if (strlen($code) < 4) {
                $firstLetter = strtoupper(substr(preg_replace('/[^A-Z]/', '', $word), 0, 1));
                if ($firstLetter) {
                    $code .= $firstLetter;
                }
            } else {
                break;
            }
        }
        
        // If less than 4 letters, pad with next available letters
        if (strlen($code) < 4) {
            $cleanName = preg_replace('/[^A-Z0-9]/', '', strtoupper($this->project_name));
            $code .= substr($cleanName, strlen($code), 4 - strlen($code));
        }
        
        return substr($code, 0, 4);
    }


    /**
     * NEW: Generate hierarchical serials like HIGHWAY.1, HIGHWAY.1.1, HIGHWAY.1.1.1
     */
    public function regenerateSerials()
    {
        $projectCode = $this->getProjectCode();
        
        foreach ($this->mainBoqs as $mIndex => &$main) {
            // Main BOQ: HIGHWAY.1, HIGHWAY.2, etc.
            $main['serial_number'] = $projectCode . '.' . ($mIndex + 1);
            
            $mainSerial = $main['serial_number'];

            if (empty($main['subToggled'])) {
                // Direct items: HIGHWAY.1.1, HIGHWAY.1.2
                foreach ($main['boqs'] as $bIndex => &$boq) {
                    $boq['serial_number'] = $mainSerial . '.' . ($bIndex + 1);
                }
            } else {
                // Sub BOQs: HIGHWAY.1.1, HIGHWAY.1.2
                foreach ($main['subBoqs'] as $sIndex => &$sub) {
                    $sub['serial_number'] = $mainSerial . '.' . ($sIndex + 1);
                    $subSerial = $sub['serial_number'];

                    // Sub-sub items: HIGHWAY.1.1.1, HIGHWAY.1.1.2
                    foreach ($sub['boqs'] as $bIndex => &$boq) {
                        $boq['serial_number'] = $subSerial . '.' . ($bIndex + 1);
                    }
                }
            }
        }
    }

    public function save()
    {
        try {
            if ($this->noProjectAccess || empty($this->project_id)) {
                $this->addError('project_id', 'Please select a project first.');
                return;
            }

            $project = Project::find($this->project_id);
            if (!$project || $project->company_id !== Auth::user()->company_id) {
                throw ValidationException::withMessages(['project_id' => 'Invalid project.']);
            }

            if (Boq::where('project_id', $this->project_id)->whereNull('parent_id')->exists()) {
                throw ValidationException::withMessages(['project_id' => 'BOQ already exists for this project.']);
            }

            $rules = [
                'project_id' => 'required|exists:projects,id',
                'mainBoqs' => 'required|array|min:1',
                'mainBoqs.*.name' => 'required|string|max:255',
            ];

            foreach ($this->mainBoqs as $mIndex => $main) {
                if ($main['subToggled']) {
                    $rules["mainBoqs.$mIndex.subBoqs.*.name"] = 'required|string|max:255';
                    $rules["mainBoqs.$mIndex.subBoqs.*.boqs.*.item_description"] = 'required|string';
                    $rules["mainBoqs.$mIndex.subBoqs.*.boqs.*.unit"] = 'required|string';
                    $rules["mainBoqs.$mIndex.subBoqs.*.boqs.*.quantity"] = 'required|numeric|min:0';
                    $rules["mainBoqs.$mIndex.subBoqs.*.boqs.*.unit_rate"] = 'required|numeric|min:0';
                } else {
                    $rules["mainBoqs.$mIndex.boqs.*.item_description"] = 'required|string';
                    $rules["mainBoqs.$mIndex.boqs.*.unit"] = 'required|string';
                    $rules["mainBoqs.$mIndex.boqs.*.quantity"] = 'required|numeric|min:0';
                    $rules["mainBoqs.$mIndex.boqs.*.unit_rate"] = 'required|numeric|min:0';
                }
            }

            if ($this->taxEnabled) $rules['taxId'] = 'required|exists:taxes,id';
            $this->validate($rules);

            $projectSlug = Str::slug($project->name . '-' . uniqid());
            
            DB::transaction(function () use ($projectSlug) {
                foreach ($this->mainBoqs as $main) {
                    if (empty(trim($main['name']))) continue;
                    
                    $mainBoq = Boq::create([
                        'project_id' => $this->project_id,
                        'name' => $main['name'],
                        'serial_number' => $main['serial_number'],
                        'company_id' => Auth::user()->company_id,
                        'slug' => $projectSlug,
                        'tax_id' => $this->taxEnabled ? $this->taxId : null,
                    ]);

                    if ($main['subToggled'] && !empty($main['subBoqs'])) {
                        foreach ($main['subBoqs'] as $sub) {
                            if (empty(trim($sub['name']))) continue;
                            $subBoq = Boq::create([
                                'project_id' => $this->project_id,
                                'parent_id' => $mainBoq->id,
                                'name' => $sub['name'],
                                'serial_number' => $sub['serial_number'],
                                'company_id' => Auth::user()->company_id,
                                'slug' => $projectSlug,
                            ]);
                            foreach ($sub['boqs'] as $item) {
                                Boq::create(array_merge($item, [
                                    'project_id' => $this->project_id,
                                    'parent_id' => $subBoq->id,
                                    'name' => $sub['name'],
                                    'amount' => (float)($item['quantity'] ?? 0) * (float)($item['unit_rate'] ?? 0),
                                    'company_id' => Auth::user()->company_id,
                                    'slug' => $projectSlug,
                                ]));
                            }
                        }
                    } else {
                        foreach ($main['boqs'] as $boq) {
                            Boq::create(array_merge($boq, [
                                'project_id' => $this->project_id,
                                'parent_id' => $mainBoq->id,
                                'name' => $main['name'],
                                'amount' => (float)($boq['quantity'] ?? 0) * (float)($boq['unit_rate'] ?? 0),
                                'company_id' => Auth::user()->company_id,
                                'slug' => $projectSlug,
                            ]));
                        }
                    }
                }
            });

            session()->flash('success', 'BOQ created successfully!');
            return redirect()->route('boq.index');

        } catch (ValidationException $e) {
            $this->setErrorBag($e->validator->getMessageBag());
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to save BOQ: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.boq.create');
    }
}

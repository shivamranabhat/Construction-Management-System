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

class Edit extends Component
{
    public $project_id;
    public $project_name = ''; // For project serial code
    public $mainBoqs = [];
    public $boqSlug;
    public $taxEnabled = false;
    public $taxId = '';
    public $taxes = [];

    // Modal delete
    public $showDeleteModal = false;
    public $deleteType = '';
    public $deleteIndices = [];

    // Totals
    public $subtotal = 0;
    public $taxAmount = 0;
    public $total = 0;

    public $userProjects = [];
    public $singleProject = false;
    public $noProjectAccess = false;

    public function mount($slug)
    {
        $this->boqSlug = $slug;
        $this->taxes = Tax::all();

        $mainBoq = Boq::where('slug', $slug)->whereNull('parent_id')->firstOrFail();
        $this->project_id = $mainBoq->project_id;
        $this->taxEnabled = !is_null($mainBoq->tax_id);
        $this->taxId = $mainBoq->tax_id;

        $projects = Project::query()
            ->when(Auth::user()->type === 'Company', fn($q) => $q->where('company_id', Auth::user()->company_id),
                              fn($q) => $q->whereHas('users', fn($sub) => $sub->where('user_id', Auth::id())))
            ->orderBy('name')
            ->get()
            ->pluck('name', 'id');

        $this->userProjects = $projects;

        if ($projects->count() === 1) {
            $this->project_id = $projects->keys()->first();
            $this->singleProject = true;
        }

        $this->loadProjectName();
        $this->loadBoqs();
        $this->calculateTotals();
    }

    public function updatedProjectId()
    {
        $this->loadProjectName();
        $this->regenerateSerials();
        $this->calculateTotals();
    }

    protected function loadProjectName()
    {
        if ($this->project_id) {
            $project = Project::find($this->project_id);
            $this->project_name = $project ? $project->name : '';
        }
    }

    protected function loadBoqs()
    {
        $this->mainBoqs = [];

        $mainBoqs = Boq::where('slug', $this->boqSlug)
            ->whereNull('parent_id')
            ->with('children.children')
            ->get();

        foreach ($mainBoqs as $main) {
            $mainData = [
                'id' => $main->id,
                'serial_number' => $main->serial_number,
                'name' => $main->name,
                'boqCount' => 0,
                'boqs' => [],
                'subToggled' => false,
                'subCount' => 0,
                'subBoqs' => [],
            ];

            $hasSub = $main->children->whereNull('item_description')->isNotEmpty();

            if ($hasSub) {
                $mainData['subToggled'] = true;
                foreach ($main->children as $sub) {
                    if (is_null($sub->item_description)) {
                        $subItems = $sub->children;
                        $mainData['subBoqs'][] = [
                            'id' => $sub->id,
                            'serial_number' => $sub->serial_number,
                            'name' => $sub->name,
                            'boqCount' => $subItems->count(),
                            'boqs' => $subItems->map(fn($i) => [
                                'id' => $i->id,
                                'serial_number' => $i->serial_number,
                                'item_description' => $i->item_description,
                                'unit' => $i->unit,
                                'quantity' => $i->quantity,
                                'unit_rate' => $i->unit_rate,
                                'amount' => $i->amount,
                                'summary' => $i->summary,
                            ])->toArray(),
                        ];
                    }
                }
            } else {
                $mainData['boqCount'] = $main->children->count();
                $mainData['boqs'] = $main->children->map(fn($i) => [
                    'id' => $i->id,
                    'serial_number' => $i->serial_number,
                    'item_description' => $i->item_description,
                    'unit' => $i->unit,
                    'quantity' => $i->quantity,
                    'unit_rate' => $i->unit_rate,
                    'amount' => $i->amount,
                    'summary' => $i->summary,
                ])->toArray();
            }

            $this->mainBoqs[] = $mainData;
        }

        $this->regenerateSerials();
    }

    protected function getProjectCode()
    {
        if (empty($this->project_name)) {
            return strtoupper(Str::random(4));
        }

        $words = explode(' ', trim($this->project_name));
        $code = '';

        foreach ($words as $word) {
            if (strlen($code) < 4) {
                $letter = strtoupper(substr(preg_replace('/[^A-Z]/', '', $word), 0, 1));
                if ($letter) {
                    $code .= $letter;
                }
            } else {
                break;
            }
        }

        if (strlen($code) < 4) {
            $clean = preg_replace('/[^A-Z0-9]/', '', strtoupper($this->project_name));
            $code .= substr($clean, strlen($code), 4 - strlen($code));
        }

        return substr($code, 0, 4);
    }

    public function regenerateSerials()
    {
        $projectCode = $this->getProjectCode();

        foreach ($this->mainBoqs as $mIndex => &$main) {
            $main['serial_number'] = $projectCode . '.' . ($mIndex + 1);
            $mainSerial = $main['serial_number'];

            if (empty($main['subToggled'])) {
                foreach ($main['boqs'] as $bIndex => &$boq) {
                    $boq['serial_number'] = $mainSerial . '.' . ($bIndex + 1);
                }
            } else {
                foreach ($main['subBoqs'] as $sIndex => &$sub) {
                    $sub['serial_number'] = $mainSerial . '.' . ($sIndex + 1);
                    $subSerial = $sub['serial_number'];

                    foreach ($sub['boqs'] as $bIndex => &$boq) {
                        $boq['serial_number'] = $subSerial . '.' . ($bIndex + 1);
                    }
                }
            }
        }
    }

    public function updated($property)
    {
        $this->calculateTotals();
    }

    public function updatedTaxEnabled($value)
    {
        if (!$value) {
            $this->taxId = '';
        }
        $this->calculateTotals();
    }

    public function updatedTaxId()
    {
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $subtotal = 0;

        foreach ($this->mainBoqs as $main) {
            if ($main['subToggled']) {
                foreach ($main['subBoqs'] as $sub) {
                    foreach ($sub['boqs'] as $item) {
                        $subtotal += (float)($item['quantity'] ?? 0) * (float)($item['unit_rate'] ?? 0);
                    }
                }
            } else {
                foreach ($main['boqs'] as $item) {
                    $subtotal += (float)($item['quantity'] ?? 0) * (float)($item['unit_rate'] ?? 0);
                }
            }
        }

        $this->subtotal = $subtotal;
        $taxRate = 0;

        if ($this->taxEnabled && $this->taxId) {
            $tax = $this->taxes->firstWhere('id', $this->taxId);
            $taxRate = $tax->rate ?? 0;
        }

        $this->taxAmount = $subtotal * $taxRate / 100;
        $this->total = $subtotal + $this->taxAmount;
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
        $this->calculateTotals();
    }

    public function generateMainBoqs($index)
    {
        $this->validate(["mainBoqs.$index.boqCount" => 'required|integer|min:1']);
        $count = (int) $this->mainBoqs[$index]['boqCount'];
        $current = count($this->mainBoqs[$index]['boqs']);
        $diff = $count - $current;

        if ($diff > 0) {
            for ($i = 0; $i < $diff; $i++) {
                $this->mainBoqs[$index]['boqs'][] = [
                    'serial_number' => '',
                    'item_description' => '',
                    'unit' => '',
                    'quantity' => '',
                    'unit_rate' => '',
                    'amount' => '',
                    'summary' => '',
                ];
            }
        } elseif ($diff < 0) {
            $this->mainBoqs[$index]['boqs'] = array_slice($this->mainBoqs[$index]['boqs'], 0, $count);
        }
        $this->regenerateSerials();
        $this->calculateTotals();
    }

    public function generateSubBoqs($index)
    {
        $this->validate(["mainBoqs.$index.subCount" => 'required|integer|min:1']);
        $count = (int) $this->mainBoqs[$index]['subCount'];
        $current = count($this->mainBoqs[$index]['subBoqs']);
        $diff = $count - $current;

        if ($diff > 0) {
            for ($i = 0; $i < $diff; $i++) {
                $this->mainBoqs[$index]['subBoqs'][] = [
                    'serial_number' => '',
                    'name' => '',
                    'boqCount' => 0,
                    'boqs' => [],
                ];
            }
        } elseif ($diff < 0) {
            $this->mainBoqs[$index]['subBoqs'] = array_slice($this->mainBoqs[$index]['subBoqs'], 0, $count);
        }
        $this->regenerateSerials();
        $this->calculateTotals();
    }

    public function generateSubSubBoqs($mainIndex, $subIndex)
    {
        $this->validate(["mainBoqs.$mainIndex.subBoqs.$subIndex.boqCount" => 'required|integer|min:1']);
        $count = (int) $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqCount'];
        $current = count($this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs']);
        $diff = $count - $current;

        if ($diff > 0) {
            for ($i = 0; $i < $diff; $i++) {
                $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'][] = [
                    'serial_number' => '',
                    'item_description' => '',
                    'unit' => '',
                    'quantity' => '',
                    'unit_rate' => '',
                    'amount' => '',
                    'summary' => '',
                ];
            }
        } elseif ($diff < 0) {
            $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'] = array_slice(
                $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'],
                0,
                $count
            );
        }
        $this->regenerateSerials();
        $this->calculateTotals();
    }

    public function confirmDelete($type, $indices)
    {
        $this->deleteType = $type;
        $this->deleteIndices = $indices;
        $this->showDeleteModal = true;
    }

    public function deleteMainBoq()
    {
        if ($this->deleteType === 'main' && isset($this->mainBoqs[$this->deleteIndices['mainIndex']]['id'])) {
            $id = $this->mainBoqs[$this->deleteIndices['mainIndex']]['id'];
            Boq::where('id', $id)
                ->orWhere('parent_id', $id)
                ->delete();
        }
        unset($this->mainBoqs[$this->deleteIndices['mainIndex']]);
        $this->mainBoqs = array_values($this->mainBoqs);
        $this->closeModal();
        $this->regenerateSerials();
        $this->calculateTotals();
    }

    public function deleteSubBoq()
    {
        if ($this->deleteType === 'sub') {
            $m = $this->deleteIndices['mainIndex'];
            $s = $this->deleteIndices['subIndex'];
            if (isset($this->mainBoqs[$m]['subBoqs'][$s]['id'])) {
                $id = $this->mainBoqs[$m]['subBoqs'][$s]['id'];
                Boq::where('id', $id)
                    ->orWhere('parent_id', $id)
                    ->delete();
            }
            unset($this->mainBoqs[$m]['subBoqs'][$s]);
            $this->mainBoqs[$m]['subBoqs'] = array_values($this->mainBoqs[$m]['subBoqs']);
            $this->mainBoqs[$m]['subCount'] = count($this->mainBoqs[$m]['subBoqs']);
        }
        $this->closeModal();
        $this->regenerateSerials();
        $this->calculateTotals();
    }

    public function deleteSubSubBoq()
    {
        if ($this->deleteType === 'subsub') {
            $m = $this->deleteIndices['mainIndex'];
            $s = $this->deleteIndices['subIndex'];
            $b = $this->deleteIndices['boqIndex'];
            if (isset($this->mainBoqs[$m]['subBoqs'][$s]['boqs'][$b]['id'])) {
                $id = $this->mainBoqs[$m]['subBoqs'][$s]['boqs'][$b]['id'];
                Boq::where('id', $id)->delete();
            }
            unset($this->mainBoqs[$m]['subBoqs'][$s]['boqs'][$b]);
            $this->mainBoqs[$m]['subBoqs'][$s]['boqs'] = array_values($this->mainBoqs[$m]['subBoqs'][$s]['boqs']);
            $this->mainBoqs[$m]['subBoqs'][$s]['boqCount'] = count($this->mainBoqs[$m]['subBoqs'][$s]['boqs']);
        }
        $this->closeModal();
        $this->regenerateSerials();
        $this->calculateTotals();
    }

    public function deleteMainBoqItem()
    {
        if ($this->deleteType === 'mainitem') {
            $m = $this->deleteIndices['mainIndex'];
            $b = $this->deleteIndices['boqIndex'];
            if (isset($this->mainBoqs[$m]['boqs'][$b]['id'])) {
                $id = $this->mainBoqs[$m]['boqs'][$b]['id'];
                Boq::where('id', $id)->delete();
            }
            unset($this->mainBoqs[$m]['boqs'][$b]);
            $this->mainBoqs[$m]['boqs'] = array_values($this->mainBoqs[$m]['boqs']);
            $this->mainBoqs[$m]['boqCount'] = count($this->mainBoqs[$m]['boqs']);
        }
        $this->closeModal();
        $this->regenerateSerials();
        $this->calculateTotals();
    }

    public function closeModal()
    {
        $this->showDeleteModal = false;
        $this->deleteType = '';
        $this->deleteIndices = [];
    }

    public function save()
    {
        $rules = [
            'project_id' => 'required|exists:projects,id',
            'mainBoqs' => 'required|array|min:1',
            'mainBoqs.*.name' => 'required|string|max:255',
        ];

        foreach ($this->mainBoqs as $m => $main) {
            if ($main['subToggled']) {
                $rules["mainBoqs.$m.subBoqs"] = 'required|array|min:1';
                foreach ($main['subBoqs'] as $s => $sub) {
                    $rules["mainBoqs.$m.subBoqs.$s.name"] = 'required|string';
                    $rules["mainBoqs.$m.subBoqs.$s.boqs"] = 'required|array|min:1';
                    foreach ($sub['boqs'] as $b => $boq) {
                        $rules["mainBoqs.$m.subBoqs.$s.boqs.$b.item_description"] = 'required|string';
                        $rules["mainBoqs.$m.subBoqs.$s.boqs.$b.unit"] = 'required|string';
                        $rules["mainBoqs.$m.subBoqs.$s.boqs.$b.quantity"] = 'required|numeric|min:0';
                        $rules["mainBoqs.$m.subBoqs.$s.boqs.$b.unit_rate"] = 'required|numeric|min:0';
                    }
                }
            } else {
                $rules["mainBoqs.$m.boqs"] = 'required|array|min:1';
                foreach ($main['boqs'] as $b => $boq) {
                    $rules["mainBoqs.$m.boqs.$b.item_description"] = 'required|string';
                    $rules["mainBoqs.$m.boqs.$b.unit"] = 'required|string';
                    $rules["mainBoqs.$m.boqs.$b.quantity"] = 'required|numeric|min:0';
                    $rules["mainBoqs.$m.boqs.$b.unit_rate"] = 'required|numeric|min:0';
                }
            }
        }

        if ($this->taxEnabled) {
            $rules['taxId'] = 'required|exists:taxes,id';
        }

        $this->validate($rules);

        DB::transaction(function () {
            foreach ($this->mainBoqs as $main) {
                if (empty($main['name'])) continue;

                $mainData = [
                    'project_id' => $this->project_id,
                    'name' => $main['name'],
                    'serial_number' => $main['serial_number'],
                    'company_id' => auth()->user()->company_id,
                    'slug' => $this->boqSlug,
                    'tax_id' => $this->taxEnabled ? $this->taxId : null,
                ];

                $mainBoq = isset($main['id'])
                    ? Boq::find($main['id'])->fill($mainData)
                    : Boq::create($mainData);
                $mainBoq->save();

                if ($main['subToggled']) {
                    foreach ($main['subBoqs'] as $sub) {
                        $subData = [
                            'project_id' => $this->project_id,
                            'parent_id' => $mainBoq->id,
                            'name' => $sub['name'],
                            'serial_number' => $sub['serial_number'],
                            'company_id' => auth()->user()->company_id,
                            'slug' => $this->boqSlug,
                        ];

                        $subBoq = isset($sub['id'])
                            ? Boq::find($sub['id'])->fill($subData)
                            : Boq::create($subData);
                        $subBoq->save();

                        foreach ($sub['boqs'] as $item) {
                            $itemData = [
                                'project_id' => $this->project_id,
                                'parent_id' => $subBoq->id,
                                'name' => $sub['name'],
                                'serial_number' => $item['serial_number'],
                                'item_description' => $item['item_description'],
                                'unit' => $item['unit'],
                                'quantity' => (float)$item['quantity'],
                                'unit_rate' => (float)$item['unit_rate'],
                                'amount' => (float)$item['quantity'] * (float)$item['unit_rate'],
                                'summary' => $item['summary'] ?? null,
                                'company_id' => auth()->user()->company_id,
                                'slug' => $this->boqSlug,
                            ];

                            isset($item['id'])
                                ? Boq::find($item['id'])->fill($itemData)->save()
                                : Boq::create($itemData);
                        }
                    }
                } else {
                    foreach ($main['boqs'] as $boq) {
                        $boqData = [
                            'project_id' => $this->project_id,
                            'parent_id' => $mainBoq->id,
                            'name' => $main['name'],
                            'serial_number' => $boq['serial_number'],
                            'item_description' => $boq['item_description'],
                            'unit' => $boq['unit'],
                            'quantity' => (float)$boq['quantity'],
                            'unit_rate' => (float)$boq['unit_rate'],
                            'amount' => (float)$boq['quantity'] * (float)$boq['unit_rate'],
                            'summary' => $boq['summary'] ?? null,
                            'company_id' => auth()->user()->company_id,
                            'slug' => $this->boqSlug,
                        ];

                        isset($boq['id'])
                            ? Boq::find($boq['id'])->fill($boqData)->save()
                            : Boq::create($boqData);
                    }
                }
            }
        });

        return redirect()->route('boq.index')->with('success', 'BOQ updated successfully!');
    }

    public function render()
    {
        return view('livewire.boq.edit');
    }
}

<?php


// namespace App\Livewire\Boq;

// use Livewire\Component;
// use App\Models\Boq;
// use App\Models\Project;
// use App\Models\Tax;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Str;

// class Create extends Component
// {
//     public $project_id;
//     public $mainBoqs = [];

//     public $taxEnabled = false;
//     public $taxId = '';
//     public $taxes = [];

//     public function mount()
//     {
//         $this->taxes = Tax::all();
//     }

//     public function updatedTaxEnabled($value)
//     {
//         if (!$value) {
//             $this->taxId = '';
//             $this->resetErrorBag('taxId');
//         }
//     }

//     public function addMainBoq()
//     {
//         $this->mainBoqs[] = [
//             'serial_number' => '', 'name' => '', 'boqCount' => 0, 'boqs' => [],
//             'subToggled' => false, 'subCount' => 0, 'subBoqs' => [],
//         ];
//     }

//     public function generateMainBoqs($index)
//     {
//         $this->validate(["mainBoqs.$index.boqCount" => 'required|integer|min:1']);
//         $this->mainBoqs[$index]['boqs'] = array_fill(0, $this->mainBoqs[$index]['boqCount'], [
//             'serial_number' => '', 'item_description' => '', 'unit' => '',
//             'quantity' => '', 'unit_rate' => '', 'amount' => '', 'summary' => '',
//         ]);
//     }

//     public function generateSubBoqs($index)
//     {
//         $this->validate(["mainBoqs.$index.subCount" => 'required|integer|min:1']);
//         $this->mainBoqs[$index]['subBoqs'] = array_fill(0, $this->mainBoqs[$index]['subCount'], [
//             'serial_number' => '', 'name' => '', 'boqCount' => 0, 'boqs' => [],
//         ]);
//     }

//     public function generateSubSubBoqs($mainIndex, $subIndex)
//     {
//         $this->validate(["mainBoqs.$mainIndex.subBoqs.$subIndex.boqCount" => 'required|integer|min:1']);
//         $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'] = array_fill(0, $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqCount'], [
//             'serial_number' => '', 'item_description' => '', 'unit' => '',
//             'quantity' => '', 'unit_rate' => '', 'amount' => '', 'summary' => '',
//         ]);
//     }

//     public function save()
//     {
//         try {
//             $rules = [
//                 'project_id' => 'required|exists:projects,id',
//                 'mainBoqs' => 'required|array|min:1',
//                 'mainBoqs.*.name' => 'required|string|max:255',
//             ];

//             foreach ($this->mainBoqs as $mIndex => $main) {
//                 if ($main['subToggled']) {
//                     $rules["mainBoqs.$mIndex.subBoqs"] = 'required|array|min:1';
//                     foreach ($main['subBoqs'] as $sIndex => $sub) {
//                         $rules["mainBoqs.$mIndex.subBoqs.$sIndex.name"] = 'required|string|max:255';
//                         $rules["mainBoqs.$mIndex.subBoqs.$sIndex.boqs"] = 'required|array|min:1';
//                         foreach ($sub['boqs'] as $bIndex => $boq) {
//                             $rules["mainBoqs.$mIndex.subBoqs.$sIndex.boqs.$bIndex.serial_number"] = 'required|string';
//                             $rules["mainBoqs.$mIndex.subBoqs.$sIndex.boqs.$bIndex.item_description"] = 'required|string';
//                             $rules["mainBoqs.$mIndex.subBoqs.$sIndex.boqs.$bIndex.unit"] = 'required|string';
//                             $rules["mainBoqs.$mIndex.subBoqs.$sIndex.boqs.$bIndex.quantity"] = 'required|numeric|min:0';
//                             $rules["mainBoqs.$mIndex.subBoqs.$sIndex.boqs.$bIndex.unit_rate"] = 'required|numeric|min:0';
//                             $rules["mainBoqs.$mIndex.subBoqs.$sIndex.boqs.$bIndex.summary"] = 'nullable|string';
//                         }
//                     }
//                 } else {
//                     $rules["mainBoqs.$mIndex.boqs"] = 'required|array|min:1';
//                     foreach ($main['boqs'] as $bIndex => $boq) {
//                         $rules["mainBoqs.$mIndex.boqs.$bIndex.serial_number"] = 'required|string';
//                         $rules["mainBoqs.$mIndex.boqs.$bIndex.item_description"] = 'required|string';
//                         $rules["mainBoqs.$mIndex.boqs.$bIndex.unit"] = 'required|string';
//                         $rules["mainBoqs.$mIndex.boqs.$bIndex.quantity"] = 'required|numeric|min:0';
//                         $rules["mainBoqs.$mIndex.boqs.$bIndex.unit_rate"] = 'required|numeric|min:0';
//                         $rules["mainBoqs.$mIndex.boqs.$bIndex.summary"] = 'nullable|string';
//                     }
//                 }
//             }

//             if ($this->taxEnabled) {
//                 $rules['taxId'] = 'required|exists:taxes,id';
//             }

//             $this->validate($rules);

//             $projectSlug = Str::slug(Project::find($this->project_id)->name . '-' . uniqid());

//             DB::transaction(function () use ($projectSlug) {
//                 foreach ($this->mainBoqs as $main) {
//                     if (empty($main['name'])) continue;

//                     $mainBoq = Boq::create([
//                         'project_id' => $this->project_id,
//                         'name' => $main['name'],
//                         'serial_number' => $main['serial_number'],
//                         'company_id' => auth()->user()->company_id,
//                         'slug' => $projectSlug,
//                         'tax_id' => $this->taxEnabled ? $this->taxId : null,
//                     ]);

//                     if ($main['subToggled']) {
//                         foreach ($main['subBoqs'] as $sub) {
//                             $subBoq = Boq::create([
//                                 'project_id' => $this->project_id,
//                                 'parent_id' => $mainBoq->id,
//                                 'name' => $sub['name'],
//                                 'serial_number' => $sub['serial_number'],
//                                 'company_id' => auth()->user()->company_id,
//                                 'slug' => $projectSlug,
//                             ]);

//                             foreach ($sub['boqs'] as $item) {
//                                 Boq::create([
//                                     'project_id' => $this->project_id,
//                                     'parent_id' => $subBoq->id,
//                                     'name' => $sub['name'],
//                                     'serial_number' => $item['serial_number'],
//                                     'item_description' => $item['item_description'],
//                                     'unit' => $item['unit'],
//                                     'quantity' => (float)$item['quantity'],
//                                     'unit_rate' => (float)$item['unit_rate'],
//                                     'amount' => (float)$item['quantity'] * (float)$item['unit_rate'],
//                                     'company_id' => auth()->user()->company_id,
//                                     'summary' => $item['summary'],
//                                     'slug' => $projectSlug,
//                                 ]);
//                             }
//                         }
//                     } else {
//                         foreach ($main['boqs'] as $boq) {
//                             Boq::create([
//                                 'project_id' => $this->project_id,
//                                 'parent_id' => $mainBoq->id,
//                                 'name' => $main['name'],
//                                 'serial_number' => $boq['serial_number'],
//                                 'item_description' => $boq['item_description'],
//                                 'unit' => $boq['unit'],
//                                 'quantity' => (float)$boq['quantity'],
//                                 'unit_rate' => (float)$boq['unit_rate'],
//                                 'amount' => (float)$boq['quantity'] * (float)$boq['unit_rate'],
//                                 'company_id' => auth()->user()->company_id,
//                                 'summary' => $boq['summary'],
//                                 'slug' => $projectSlug,
//                             ]);
//                         }
//                     }
//                 }
//             });

//             session()->flash('success', 'BOQs created successfully!');
//             return redirect()->route('boq.index');
//         } catch (\Exception $e) {
//             session()->flash('error', 'Failed to save: ' . $e->getMessage());
//         }
//     }

//     public function render()
//     {
//         $projects = Project::all();
//         return view('livewire.boq.create', compact('projects'));
//     }
// }


namespace App\Livewire\Boq;

use Livewire\Component;
use App\Models\Boq;
use App\Models\Project;
use App\Models\Tax;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class Create extends Component
{
    public $project_id;
    public $mainBoqs = [];

    public $taxEnabled = false;
    public $taxId = '';
    public $taxes = [];

    public function mount()
    {
        $this->taxes = Tax::all();
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
            'serial_number' => '', 'name' => '', 'boqCount' => 0, 'boqs' => [],
            'subToggled' => false, 'subCount' => 0, 'subBoqs' => [],
        ];
    }

    public function generateMainBoqs($index)
    {
        $this->validate(["mainBoqs.$index.boqCount" => 'required|integer|min:1']);
        $this->mainBoqs[$index]['boqs'] = array_fill(0, $this->mainBoqs[$index]['boqCount'], [
            'serial_number' => '', 'item_description' => '', 'unit' => '',
            'quantity' => '', 'unit_rate' => '', 'amount' => '', 'summary' => '',
        ]);
    }

    public function generateSubBoqs($index)
    {
        $this->validate(["mainBoqs.$index.subCount" => 'required|integer|min:1']);
        $this->mainBoqs[$index]['subBoqs'] = array_fill(0, $this->mainBoqs[$index]['subCount'], [
            'serial_number' => '', 'name' => '', 'boqCount' => 0, 'boqs' => [],
        ]);
    }

    public function generateSubSubBoqs($mainIndex, $subIndex)
    {
        $this->validate(["mainBoqs.$mainIndex.subBoqs.$subIndex.boqCount" => 'required|integer|min:1']);
        $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'] = array_fill(0, $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqCount'], [
            'serial_number' => '', 'item_description' => '', 'unit' => '',
            'quantity' => '', 'unit_rate' => '', 'amount' => '', 'summary' => '',
        ]);
    }

    public function save()
    {
        try {
            // === STEP 1: Validate Project & Company Ownership ===
            $project = Project::find($this->project_id);

            if (!$project) {
                throw ValidationException::withMessages(['project_id' => 'Invalid project selected.']);
            }

            if ($project->company_id !== auth()->user()->company_id) {
                throw ValidationException::withMessages(['project_id' => 'You can only create BOQ for projects in your company.']);
            }

            // === STEP 2: Check if BOQ already exists for this project ===
            $existingBoq = Boq::where('project_id', $this->project_id)
                ->where('company_id', auth()->user()->company_id)
                ->whereNull('parent_id')
                ->exists();

            if ($existingBoq) {
                throw ValidationException::withMessages(['project_id' => 'A BOQ already exists for this project.']);
            }

            // === STEP 3: Dynamic BOQ Structure Validation ===
            $rules = [
                'project_id' => 'required|exists:projects,id',
                'mainBoqs' => 'required|array|min:1',
                'mainBoqs.*.name' => 'required|string|max:255',
            ];

            foreach ($this->mainBoqs as $mIndex => $main) {
                if ($main['subToggled']) {
                    $rules["mainBoqs.$mIndex.subBoqs"] = 'required|array|min:1';
                    foreach ($main['subBoqs'] as $sIndex => $sub) {
                        $rules["mainBoqs.$mIndex.subBoqs.$sIndex.name"] = 'required|string|max:255';
                        $rules["mainBoqs.$mIndex.subBoqs.$sIndex.boqs"] = 'required|array|min:1';
                        foreach ($sub['boqs'] as $bIndex => $boq) {
                            $rules["mainBoqs.$mIndex.subBoqs.$sIndex.boqs.$bIndex.serial_number"] = 'required|string';
                            $rules["mainBoqs.$mIndex.subBoqs.$sIndex.boqs.$bIndex.item_description"] = 'required|string';
                            $rules["mainBoqs.$mIndex.subBoqs.$sIndex.boqs.$bIndex.unit"] = 'required|string';
                            $rules["mainBoqs.$mIndex.subBoqs.$sIndex.boqs.$bIndex.quantity"] = 'required|numeric|min:0';
                            $rules["mainBoqs.$mIndex.subBoqs.$sIndex.boqs.$bIndex.unit_rate"] = 'required|numeric|min:0';
                            $rules["mainBoqs.$mIndex.subBoqs.$sIndex.boqs.$bIndex.summary"] = 'nullable|string';
                        }
                    }
                } else {
                    $rules["mainBoqs.$mIndex.boqs"] = 'required|array|min:1';
                    foreach ($main['boqs'] as $bIndex => $boq) {
                        $rules["mainBoqs.$mIndex.boqs.$bIndex.serial_number"] = 'required|string';
                        $rules["mainBoqs.$mIndex.boqs.$bIndex.item_description"] = 'required|string';
                        $rules["mainBoqs.$mIndex.boqs.$bIndex.unit"] = 'required|string';
                        $rules["mainBoqs.$mIndex.boqs.$bIndex.quantity"] = 'required|numeric|min:0';
                        $rules["mainBoqs.$mIndex.boqs.$bIndex.unit_rate"] = 'required|numeric|min:0';
                        $rules["mainBoqs.$mIndex.boqs.$bIndex.summary"] = 'nullable|string';
                    }
                }
            }

            if ($this->taxEnabled) {
                $rules['taxId'] = 'required|exists:taxes,id';
            }

            $this->validate($rules);

            // === STEP 4: Generate Unique Slug for the entire BOQ set ===
            $projectSlug = Str::slug($project->name . '-' . uniqid());

            DB::transaction(function () use ($projectSlug) {
                foreach ($this->mainBoqs as $main) {
                    if (empty($main['name'])) continue;

                    $mainBoq = Boq::create([
                        'project_id' => $this->project_id,
                        'name' => $main['name'],
                        'serial_number' => $main['serial_number'],
                        'company_id' => auth()->user()->company_id,
                        'slug' => $projectSlug,
                        'tax_id' => $this->taxEnabled ? $this->taxId : null,
                    ]);

                    if ($main['subToggled']) {
                        foreach ($main['subBoqs'] as $sub) {
                            $subBoq = Boq::create([
                                'project_id' => $this->project_id,
                                'parent_id' => $mainBoq->id,
                                'name' => $sub['name'],
                                'serial_number' => $sub['serial_number'],
                                'company_id' => auth()->user()->company_id,
                                'slug' => $projectSlug,
                            ]);

                            foreach ($sub['boqs'] as $item) {
                                Boq::create([
                                    'project_id' => $this->project_id,
                                    'parent_id' => $subBoq->id,
                                    'name' => $sub['name'],
                                    'serial_number' => $item['serial_number'],
                                    'item_description' => $item['item_description'],
                                    'unit' => $item['unit'],
                                    'quantity' => (float)$item['quantity'],
                                    'unit_rate' => (float)$item['unit_rate'],
                                    'amount' => (float)$item['quantity'] * (float)$item['unit_rate'],
                                    'company_id' => auth()->user()->company_id,
                                    'summary' => $item['summary'],
                                    'slug' => $projectSlug,
                                ]);
                            }
                        }
                    } else {
                        foreach ($main['boqs'] as $boq) {
                            Boq::create([
                                'project_id' => $this->project_id,
                                'parent_id' => $mainBoq->id,
                                'name' => $main['name'],
                                'serial_number' => $boq['serial_number'],
                                'item_description' => $boq['item_description'],
                                'unit' => $boq['unit'],
                                'quantity' => (float)$boq['quantity'],
                                'unit_rate' => (float)$boq['unit_rate'],
                                'amount' => (float)$boq['quantity'] * (float)$boq['unit_rate'],
                                'company_id' => auth()->user()->company_id,
                                'summary' => $boq['summary'],
                                'slug' => $projectSlug,
                            ]);
                        }
                    }
                }
            });

            session()->flash('success', 'BOQ created successfully!');
            return redirect()->route('boq.index');

        } catch (ValidationException $e) {
            $this->setErrorBag($e->validator->getMessageBag());
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to save: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $projects = Project::where('company_id', auth()->user()->company_id)
            ->withCount(['boqs' => function ($q) {
                $q->whereNull('parent_id');
            }])
            ->get()
            ->map(function ($project) {
                $project->has_boq = $project->boqs_count > 0;
                return $project;
            });

        return view('livewire.boq.create', compact('projects'));
    }
}
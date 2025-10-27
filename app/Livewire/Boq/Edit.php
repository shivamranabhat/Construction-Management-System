<?php

// namespace App\Livewire\Boq;

// use Livewire\Component;
// use App\Models\Boq;
// use App\Models\Project;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Str;

// class Edit extends Component
// {
//     public $project_id;
//     public $mainBoqs = [];
//     public $boqSlug;
//     public $deleteType = ''; // 'main', 'sub', 'subsub', 'mainitem'
//     public $deleteIndices = []; // Stores indices for the item to delete

//     public function mount($slug)
//     {
//         $this->boqSlug = $slug;
//         $mainBoq = Boq::where('slug', $slug)->whereNull('parent_id')->firstOrFail();
//         $this->project_id = $mainBoq->project_id;

//         $this->loadBoqs();
//     }

//     protected function loadBoqs()
//     {
//         $this->mainBoqs = [];

//         $main = Boq::where('slug', $this->boqSlug)->whereNull('parent_id')->first();

//         if ($main) {
//             $mainBoqData = [
//                 'id' => $main->id,
//                 'serial_number' => $main->serial_number,
//                 'name' => $main->name,
//                 'boqCount' => 0,
//                 'boqs' => [],
//                 'subToggled' => false,
//                 'subCount' => 0,
//                 'subBoqs' => [],
//             ];

//             $subBoqs = Boq::where('parent_id', $main->id)->whereNull('item_description')->get();
//             if ($subBoqs->isNotEmpty()) {
//                 $mainBoqData['subToggled'] = true;
//                 $mainBoqData['subCount'] = $subBoqs->count();

//                 foreach ($subBoqs as $sub) {
//                     $subBoqItems = Boq::where('parent_id', $sub->id)->whereNotNull('item_description')->get();
//                     $mainBoqData['subBoqs'][] = [
//                         'id' => $sub->id,
//                         'serial_number' => $sub->serial_number,
//                         'name' => $sub->name,
//                         'boqCount' => $subBoqItems->count(),
//                         'boqs' => $subBoqItems->map(fn($item) => [
//                             'id' => $item->id,
//                             'serial_number' => $item->serial_number,
//                             'item_description' => $item->item_description,
//                             'unit' => $item->unit,
//                             'quantity' => $item->quantity,
//                             'unit_rate' => $item->unit_rate,
//                             'amount' => $item->amount,
//                         ])->toArray(),
//                     ];
//                 }
//             } else {
//                 $boqItems = Boq::where('parent_id', $main->id)->whereNotNull('item_description')->get();
//                 $mainBoqData['boqCount'] = $boqItems->count();
//                 $mainBoqData['boqs'] = $boqItems->map(fn($item) => [
//                     'id' => $item->id,
//                     'serial_number' => $item->serial_number,
//                     'item_description' => $item->item_description,
//                     'unit' => $item->unit,
//                     'quantity' => $item->quantity,
//                     'unit_rate' => $item->unit_rate,
//                     'amount' => $item->amount,
//                 ])->toArray();
//             }

//             $this->mainBoqs[] = $mainBoqData;
//         }
//     }

//     public function addMainBoq()
//     {
//         $this->mainBoqs[] = [
//             'serial_number' => '',
//             'name' => '',
//             'boqCount' => 0,
//             'boqs' => [],
//             'subToggled' => false,
//             'subCount' => 0,
//             'subBoqs' => [],
//         ];
//     }

//     /**
//      * ✅ Non-destructive generation for main BOQs
//      */
//     public function generateMainBoqs($index)
//     {
//         $this->validate([
//             "mainBoqs.$index.boqCount" => 'required|integer|min:1',
//         ]);

//         $currentCount = count($this->mainBoqs[$index]['boqs']);
//         $newCount = (int) $this->mainBoqs[$index]['boqCount'];

//         if ($newCount > $currentCount) {
//             for ($i = $currentCount; $i < $newCount; $i++) {
//                 $this->mainBoqs[$index]['boqs'][] = [
//                     'serial_number' => '',
//                     'item_description' => '',
//                     'unit' => '',
//                     'quantity' => '',
//                     'unit_rate' => '',
//                     'amount' => '',
//                 ];
//             }
//         } elseif ($newCount < $currentCount) {
//             $this->mainBoqs[$index]['boqs'] = array_slice($this->mainBoqs[$index]['boqs'], 0, $newCount);
//         }
//     }

//     /**
//      * ✅ Non-destructive generation for sub BOQs
//      */
//     public function generateSubBoqs($index)
//     {
//         $this->validate([
//             "mainBoqs.$index.subCount" => 'required|integer|min:1',
//         ]);

//         $currentCount = count($this->mainBoqs[$index]['subBoqs']);
//         $newCount = (int) $this->mainBoqs[$index]['subCount'];

//         if ($newCount > $currentCount) {
//             for ($i = $currentCount; $i < $newCount; $i++) {
//                 $this->mainBoqs[$index]['subBoqs'][] = [
//                     'serial_number' => '',
//                     'name' => '',
//                     'boqCount' => 0,
//                     'boqs' => [],
//                 ];
//             }
//         } elseif ($newCount < $currentCount) {
//             $this->mainBoqs[$index]['subBoqs'] = array_slice($this->mainBoqs[$index]['subBoqs'], 0, $newCount);
//         }
//     }

//     /**
//      * ✅ Non-destructive generation for sub-sub BOQs
//      */
//     public function generateSubSubBoqs($mainIndex, $subIndex)
//     {
//         $this->validate([
//             "mainBoqs.$mainIndex.subBoqs.$subIndex.boqCount" => 'required|integer|min:1',
//         ]);

//         $currentCount = count($this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs']);
//         $newCount = (int) $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqCount'];

//         if ($newCount > $currentCount) {
//             for ($i = $currentCount; $i < $newCount; $i++) {
//                 $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'][] = [
//                     'serial_number' => '',
//                     'item_description' => '',
//                     'unit' => '',
//                     'quantity' => '',
//                     'unit_rate' => '',
//                     'amount' => '',
//                 ];
//             }
//         } elseif ($newCount < $currentCount) {
//             $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'] =
//                 array_slice($this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'], 0, $newCount);
//         }
//     }

//     /**
//      * Open delete confirmation modal
//      */
//     public function confirmDelete($type, $indices)
//     {
//         $this->deleteType = $type;
//         $this->deleteIndices = $indices;
//         $this->showDeleteModal = true;
//     }

//     /**
//      * Delete a Main BOQ
//      */
//     public function deleteMainBoq()
//     {
//         if ($this->deleteType === 'main' && isset($this->mainBoqs[$this->deleteIndices['mainIndex']])) {
//             unset($this->mainBoqs[$this->deleteIndices['mainIndex']]);
//             $this->mainBoqs = array_values($this->mainBoqs);
//         }
//         $this->showDeleteModal = false;
//         $this->deleteType = '';
//         $this->deleteIndices = [];
//     }

//     /**
//      * Delete a Sub BOQ
//      */
//     public function deleteSubBoq()
//     {
//         if ($this->deleteType === 'sub' && isset($this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']])) {
//             unset($this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']]);
//             $this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'] = array_values($this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs']);
//             $this->mainBoqs[$this->deleteIndices['mainIndex']]['subCount'] = count($this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs']);
//         }
//         $this->showDeleteModal = false;
//         $this->deleteType = '';
//         $this->deleteIndices = [];
//     }

//     /**
//      * Delete a Sub-Sub BOQ item
//      */
//     public function deleteSubSubBoq()
//     {
//         if ($this->deleteType === 'subsub' && isset($this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']]['boqs'][$this->deleteIndices['boqIndex']])) {
//             unset($this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']]['boqs'][$this->deleteIndices['boqIndex']]);
//             $this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']]['boqs'] = array_values($this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']]['boqs']);
//             $this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']]['boqCount'] = count($this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']]['boqs']);
//         }
//         $this->showDeleteModal = false;
//         $this->deleteType = '';
//         $this->deleteIndices = [];
//     }

//     /**
//      * Delete a Main BOQ item
//      */
//     public function deleteMainBoqItem()
//     {
//         if ($this->deleteType === 'mainitem' && isset($this->mainBoqs[$this->deleteIndices['mainIndex']]['boqs'][$this->deleteIndices['boqIndex']])) {
//             unset($this->mainBoqs[$this->deleteIndices['mainIndex']]['boqs'][$this->deleteIndices['boqIndex']]);
//             $this->mainBoqs[$this->deleteIndices['mainIndex']]['boqs'] = array_values($this->mainBoqs[$this->deleteIndices['mainIndex']]['boqs']);
//             $this->mainBoqs[$this->deleteIndices['mainIndex']]['boqCount'] = count($this->mainBoqs[$this->deleteIndices['mainIndex']]['boqs']);
//         }
//         $this->showDeleteModal = false;
//         $this->deleteType = '';
//         $this->deleteIndices = [];
//     }

//     /**
//      * Close the delete modal
//      */
//     public function closeModal()
//     {
//         $this->showDeleteModal = false;
//         $this->deleteType = '';
//         $this->deleteIndices = [];
//     }

//     /**
//      *  Save BOQs
//      */
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
//                     }
//                 }
//             }

//             $this->validate($rules);

//             DB::transaction(function () {
//                 Boq::where('slug', $this->boqSlug)->delete();

//                 foreach ($this->mainBoqs as $main) {
//                     if (empty($main['name'])) continue;

//                     $mainBoq = Boq::create([
//                         'project_id' => $this->project_id,
//                         'name' => $main['name'],
//                         'serial_number' => $main['serial_number'],
//                         'company_id' => auth()->user()->company_id,
//                         'slug' => Str::slug($main['name'] . '-' . uniqid()),
//                     ]);

//                     if ($main['subToggled']) {
//                         foreach ($main['subBoqs'] as $sub) {
//                             $subBoq = Boq::create([
//                                 'project_id' => $this->project_id,
//                                 'parent_id' => $mainBoq->id,
//                                 'name' => $sub['name'],
//                                 'serial_number' => $sub['serial_number'],
//                                 'company_id' => auth()->user()->company_id,
//                                 'slug' => $mainBoq->slug,
//                             ]);

//                             foreach ($sub['boqs'] as $item) {
//                                 Boq::create([
//                                     'project_id' => $this->project_id,
//                                     'parent_id' => $subBoq->id,
//                                     'name' => $sub['name'],
//                                     'serial_number' => $item['serial_number'],
//                                     'item_description' => $item['item_description'],
//                                     'unit' => $item['unit'],
//                                     'quantity' => (float) $item['quantity'],
//                                     'unit_rate' => (float) $item['unit_rate'],
//                                     'amount' => (float) $item['quantity'] * (float) $item['unit_rate'],
//                                     'company_id' => auth()->user()->company_id,
//                                     'slug' => $mainBoq->slug,
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
//                                 'quantity' => (float) $boq['quantity'],
//                                 'unit_rate' => (float) $boq['unit_rate'],
//                                 'amount' => (float) $boq['quantity'] * (float) $boq['unit_rate'],
//                                 'company_id' => auth()->user()->company_id,
//                                 'slug' => $mainBoq->slug,
//                             ]);
//                         }
//                     }
//                 }
//             });

//             session()->flash('success', 'BOQs updated successfully!');
//             return redirect()->route('boq.index');
//         } catch (\Exception $e) {
//             session()->flash('error', 'Failed to update BOQs. Error: ' . $e->getMessage());
//         }
//     }

//     public function render()
//     {
//         $projects = Project::all();
//         return view('livewire.boq.edit', compact('projects'));
//     }
// }


namespace App\Livewire\Boq;

use Livewire\Component;
use App\Models\Boq;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $project_id;
    public $mainBoqs = [];
    public $boqSlug;
    public $showDeleteModal = false;
    public $deleteType = ''; // 'main', 'sub', 'subsub', 'mainitem'
    public $deleteIndices = []; // Stores indices for the item to delete

    public function mount($slug)
    {
        $this->boqSlug = $slug;
        $mainBoq = Boq::where('slug', $slug)->whereNull('parent_id')->firstOrFail();
        $this->project_id = $mainBoq->project_id;

        $this->loadBoqs();
    }

    protected function loadBoqs()
    {
        $this->mainBoqs = [];

        $main = Boq::where('slug', $this->boqSlug)->whereNull('parent_id')->first();

        if ($main) {
            $mainBoqData = [
                'id' => $main->id,
                'serial_number' => $main->serial_number,
                'name' => $main->name,
                'boqCount' => 0,
                'boqs' => [],
                'subToggled' => false,
                'subCount' => 0,
                'subBoqs' => [],
            ];

            $subBoqs = Boq::where('parent_id', $main->id)->whereNull('item_description')->get();
            if ($subBoqs->isNotEmpty()) {
                $mainBoqData['subToggled'] = true;
                $mainBoqData['subCount'] = $subBoqs->count();

                foreach ($subBoqs as $sub) {
                    $subBoqItems = Boq::where('parent_id', $sub->id)->whereNotNull('item_description')->get();
                    $mainBoqData['subBoqs'][] = [
                        'id' => $sub->id,
                        'serial_number' => $sub->serial_number,
                        'name' => $sub->name,
                        'boqCount' => $subBoqItems->count(),
                        'boqs' => $subBoqItems->map(fn($item) => [
                            'id' => $item->id,
                            'serial_number' => $item->serial_number,
                            'item_description' => $item->item_description,
                            'unit' => $item->unit,
                            'quantity' => $item->quantity,
                            'unit_rate' => $item->unit_rate,
                            'amount' => $item->amount,
                        ])->toArray(),
                    ];
                }
            } else {
                $boqItems = Boq::where('parent_id', $main->id)->whereNotNull('item_description')->get();
                $mainBoqData['boqCount'] = $boqItems->count();
                $mainBoqData['boqs'] = $boqItems->map(fn($item) => [
                    'id' => $item->id,
                    'serial_number' => $item->serial_number,
                    'item_description' => $item->item_description,
                    'unit' => $item->unit,
                    'quantity' => $item->quantity,
                    'unit_rate' => $item->unit_rate,
                    'amount' => $item->amount,
                ])->toArray();
            }

            $this->mainBoqs[] = $mainBoqData;
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
    }

    public function generateMainBoqs($index)
    {
        $this->validate([
            "mainBoqs.$index.boqCount" => 'required|integer|min:1',
        ]);

        $currentCount = count($this->mainBoqs[$index]['boqs']);
        $newCount = (int) $this->mainBoqs[$index]['boqCount'];

        if ($newCount > $currentCount) {
            for ($i = $currentCount; $i < $newCount; $i++) {
                $this->mainBoqs[$index]['boqs'][] = [
                    'serial_number' => '',
                    'item_description' => '',
                    'unit' => '',
                    'quantity' => '',
                    'unit_rate' => '',
                    'amount' => '',
                ];
            }
        } elseif ($newCount < $currentCount) {
            $this->mainBoqs[$index]['boqs'] = array_slice($this->mainBoqs[$index]['boqs'], 0, $newCount);
        }
    }

    public function generateSubBoqs($index)
    {
        $this->validate([
            "mainBoqs.$index.subCount" => 'required|integer|min:1',
        ]);

        $currentCount = count($this->mainBoqs[$index]['subBoqs']);
        $newCount = (int) $this->mainBoqs[$index]['subCount'];

        if ($newCount > $currentCount) {
            for ($i = $currentCount; $i < $newCount; $i++) {
                $this->mainBoqs[$index]['subBoqs'][] = [
                    'serial_number' => '',
                    'name' => '',
                    'boqCount' => 0,
                    'boqs' => [],
                ];
            }
        } elseif ($newCount < $currentCount) {
            $this->mainBoqs[$index]['subBoqs'] = array_slice($this->mainBoqs[$index]['subBoqs'], 0, $newCount);
        }
    }

    public function generateSubSubBoqs($mainIndex, $subIndex)
    {
        $this->validate([
            "mainBoqs.$mainIndex.subBoqs.$subIndex.boqCount" => 'required|integer|min:1',
        ]);

        $currentCount = count($this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs']);
        $newCount = (int) $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqCount'];

        if ($newCount > $currentCount) {
            for ($i = $currentCount; $i < $newCount; $i++) {
                $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'][] = [
                    'serial_number' => '',
                    'item_description' => '',
                    'unit' => '',
                    'quantity' => '',
                    'unit_rate' => '',
                    'amount' => '',
                ];
            }
        } elseif ($newCount < $currentCount) {
            $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'] =
                array_slice($this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'], 0, $newCount);
        }
    }

    public function save()
    {
        try {
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
                    }
                }
            }

            $this->validate($rules);

            DB::transaction(function () {
                foreach ($this->mainBoqs as $main) {
                    if (empty($main['name'])) continue;

                    $mainBoqData = [
                        'project_id' => $this->project_id,
                        'name' => $main['name'],
                        'serial_number' => $main['serial_number'],
                        'company_id' => auth()->user()->company_id,
                        'slug' => isset($main['id']) ? $this->boqSlug : Str::slug($main['name'] . '-' . uniqid()),
                    ];

                    $mainBoq = isset($main['id']) 
                        ? Boq::updateOrCreate(['id' => $main['id']], $mainBoqData)
                        : Boq::create($mainBoqData);

                    if ($main['subToggled']) {
                        foreach ($main['subBoqs'] as $sub) {
                            $subBoqData = [
                                'project_id' => $this->project_id,
                                'parent_id' => $mainBoq->id,
                                'name' => $sub['name'],
                                'serial_number' => $sub['serial_number'],
                                'company_id' => auth()->user()->company_id,
                                'slug' => $mainBoq->slug,
                            ];

                            $subBoq = isset($sub['id']) 
                                ? Boq::updateOrCreate(['id' => $sub['id']], $subBoqData)
                                : Boq::create($subBoqData);

                            foreach ($sub['boqs'] as $item) {
                                $itemData = [
                                    'project_id' => $this->project_id,
                                    'parent_id' => $subBoq->id,
                                    'name' => $sub['name'],
                                    'serial_number' => $item['serial_number'],
                                    'item_description' => $item['item_description'],
                                    'unit' => $item['unit'],
                                    'quantity' => (float) $item['quantity'],
                                    'unit_rate' => (float) $item['unit_rate'],
                                    'amount' => (float) $item['quantity'] * (float) $item['unit_rate'],
                                    'company_id' => auth()->user()->company_id,
                                    'slug' => $mainBoq->slug,
                                ];

                                isset($item['id']) 
                                    ? Boq::updateOrCreate(['id' => $item['id']], $itemData)
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
                                'quantity' => (float) $boq['quantity'],
                                'unit_rate' => (float) $boq['unit_rate'],
                                'amount' => (float) $boq['quantity'] * (float) $boq['unit_rate'],
                                'company_id' => auth()->user()->company_id,
                                'slug' => $mainBoq->slug,
                            ];

                            isset($boq['id']) 
                                ? Boq::updateOrCreate(['id' => $boq['id']], $boqData)
                                : Boq::create($boqData);
                        }
                    }
                }
            });

            session()->flash('success', 'BOQs updated successfully!');
            return redirect()->route('boq.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update BOQs. Error: ' . $e->getMessage());
        }
    }

    /**
     * Open delete confirmation modal
     */
    public function confirmDelete($type, $indices)
    {
        $this->deleteType = $type;
        $this->deleteIndices = $indices;
        $this->showDeleteModal = true;
    }

    /**
     * Delete a Main BOQ
     */
    public function deleteMainBoq()
    {
        if ($this->deleteType === 'main' && isset($this->mainBoqs[$this->deleteIndices['mainIndex']])) {
            $mainBoq = $this->mainBoqs[$this->deleteIndices['mainIndex']];
            if (isset($mainBoq['id'])) {
                // Delete the Main BOQ and all its descendants
                Boq::where('id', $mainBoq['id'])->delete();
                Boq::where('parent_id', $mainBoq['id'])->delete();
                if ($mainBoq['subToggled']) {
                    foreach ($mainBoq['subBoqs'] as $subBoq) {
                        if (isset($subBoq['id'])) {
                            Boq::where('parent_id', $subBoq['id'])->delete();
                        }
                    }
                }
            }
            unset($this->mainBoqs[$this->deleteIndices['mainIndex']]);
            $this->mainBoqs = array_values($this->mainBoqs);
        }
        $this->showDeleteModal = false;
        $this->deleteType = '';
        $this->deleteIndices = [];
    }

    /**
     * Delete a Sub BOQ
     */
    public function deleteSubBoq()
    {
        if ($this->deleteType === 'sub' && isset($this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']])) {
            $subBoq = $this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']];
            if (isset($subBoq['id'])) {
                // Delete the Sub BOQ and its items
                Boq::where('id', $subBoq['id'])->delete();
                Boq::where('parent_id', $subBoq['id'])->delete();
            }
            unset($this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']]);
            $this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'] = array_values($this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs']);
            $this->mainBoqs[$this->deleteIndices['mainIndex']]['subCount'] = count($this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs']);
        }
        $this->showDeleteModal = false;
        $this->deleteType = '';
        $this->deleteIndices = [];
    }

    /**
     * Delete a Sub-Sub BOQ item
     */
    public function deleteSubSubBoq()
    {
        if ($this->deleteType === 'subsub' && isset($this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']]['boqs'][$this->deleteIndices['boqIndex']])) {
            $boqItem = $this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']]['boqs'][$this->deleteIndices['boqIndex']];
            if (isset($boqItem['id'])) {
                // Delete the Sub-Sub BOQ item
                Boq::where('id', $boqItem['id'])->delete();
            }
            unset($this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']]['boqs'][$this->deleteIndices['boqIndex']]);
            $this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']]['boqs'] = array_values($this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']]['boqs']);
            $this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']]['boqCount'] = count($this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']]['boqs']);
        }
        $this->showDeleteModal = false;
        $this->deleteType = '';
        $this->deleteIndices = [];
    }

    /**
     * Delete a Main BOQ item
     */
    public function deleteMainBoqItem()
    {
        if ($this->deleteType === 'mainitem' && isset($this->mainBoqs[$this->deleteIndices['mainIndex']]['boqs'][$this->deleteIndices['boqIndex']])) {
            $boqItem = $this->mainBoqs[$this->deleteIndices['mainIndex']]['boqs'][$this->deleteIndices['boqIndex']];
            if (isset($boqItem['id'])) {
                // Delete the Main BOQ item
                Boq::where('id', $boqItem['id'])->delete();
            }
            unset($this->mainBoqs[$this->deleteIndices['mainIndex']]['boqs'][$this->deleteIndices['boqIndex']]);
            $this->mainBoqs[$this->deleteIndices['mainIndex']]['boqs'] = array_values($this->mainBoqs[$this->deleteIndices['mainIndex']]['boqs']);
            $this->mainBoqs[$this->deleteIndices['mainIndex']]['boqCount'] = count($this->mainBoqs[$this->deleteIndices['mainIndex']]['boqs']);
        }
        $this->showDeleteModal = false;
        $this->deleteType = '';
        $this->deleteIndices = [];
    }

    /**
     * Close the delete modal
     */
    public function closeModal()
    {
        $this->showDeleteModal = false;
        $this->deleteType = '';
        $this->deleteIndices = [];
    }

    public function render()
    {
        $projects = Project::all();
        return view('livewire.boq.edit', compact('projects'));
    }
}
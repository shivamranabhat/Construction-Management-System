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
//     public $showDeleteModal = false;
//     public $deleteType = ''; // 'main', 'sub', 'subsub', 'mainitem'
//     public $deleteIndices = []; // Stores indices for the item to delete

//     public function mount($slug)
//     {
//         $this->boqSlug = $slug;
//         $mainBoq = Boq::whereSlug($slug)->whereNull('parent_id')->firstOrFail();
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
//                             'summary' => $item->summary,
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
//                     'summary' => $item->summary,
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
//                     'summary' => '',
//                 ];
//             }
//         } elseif ($newCount < $currentCount) {
//             $this->mainBoqs[$index]['boqs'] = array_slice($this->mainBoqs[$index]['boqs'], 0, $newCount);
//         }
//     }

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
//                     'summary' => '',
//                 ];
//             }
//         } elseif ($newCount < $currentCount) {
//             $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'] =
//                 array_slice($this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'], 0, $newCount);
//         }
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

//             $this->validate($rules);

//             DB::transaction(function () {
//                 foreach ($this->mainBoqs as $main) {
//                     if (empty($main['name'])) continue;

//                     $mainBoqData = [
//                         'project_id' => $this->project_id,
//                         'name' => $main['name'],
//                         'serial_number' => $main['serial_number'],
//                         'company_id' => auth()->user()->company_id,
//                         'slug' => isset($main['id']) ? $this->boqSlug : Str::slug($main['name'] . '-' . uniqid()),
//                     ];

//                     $mainBoq = isset($main['id']) 
//                         ? Boq::updateOrCreate(['id' => $main['id']], $mainBoqData)
//                         : Boq::create($mainBoqData);

//                     if ($main['subToggled']) {
//                         foreach ($main['subBoqs'] as $sub) {
//                             $subBoqData = [
//                                 'project_id' => $this->project_id,
//                                 'parent_id' => $mainBoq->id,
//                                 'name' => $sub['name'],
//                                 'serial_number' => $sub['serial_number'],
//                                 'company_id' => auth()->user()->company_id,
//                                 'slug' => $mainBoq->slug,
//                             ];

//                             $subBoq = isset($sub['id']) 
//                                 ? Boq::updateOrCreate(['id' => $sub['id']], $subBoqData)
//                                 : Boq::create($subBoqData);

//                             foreach ($sub['boqs'] as $item) {
//                                 $itemData = [
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
//                                     'summary' => $item['summary'] ?? null,
//                                     'slug' => $mainBoq->slug,
//                                 ];

//                                 isset($item['id']) 
//                                     ? Boq::updateOrCreate(['id' => $item['id']], $itemData)
//                                     : Boq::create($itemData);
//                             }
//                         }
//                     } else {
//                         foreach ($main['boqs'] as $boq) {
//                             $boqData = [
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
//                                 'summary' => $boq['summary'] ?? null,
//                                 'slug' => $mainBoq->slug,
//                             ];

//                             isset($boq['id']) 
//                                 ? Boq::updateOrCreate(['id' => $boq['id']], $boqData)
//                                 : Boq::create($boqData);
//                         }
//                     }
//                 }
//             });

//             return redirect()->route('boq.index')->with('success', 'BOQs updated successfully!');
//         } catch (\Exception $e) {
//             session()->flash('error', 'Failed to update BOQs. Error: ' . $e->getMessage());
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
//             $mainBoq = $this->mainBoqs[$this->deleteIndices['mainIndex']];
//             if (isset($mainBoq['id'])) {
//                 // Delete the Main BOQ and all its descendants
//                 Boq::where('id', $mainBoq['id'])->delete();
//                 Boq::where('parent_id', $mainBoq['id'])->delete();
//                 if ($mainBoq['subToggled']) {
//                     foreach ($mainBoq['subBoqs'] as $subBoq) {
//                         if (isset($subBoq['id'])) {
//                             Boq::where('parent_id', $subBoq['id'])->delete();
//                         }
//                     }
//                 }
//             }
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
//             $subBoq = $this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']];
//             if (isset($subBoq['id'])) {
//                 // Delete the Sub BOQ and its items
//                 Boq::where('id', $subBoq['id'])->delete();
//                 Boq::where('parent_id', $subBoq['id'])->delete();
//             }
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
//             $boqItem = $this->mainBoqs[$this->deleteIndices['mainIndex']]['subBoqs'][$this->deleteIndices['subIndex']]['boqs'][$this->deleteIndices['boqIndex']];
//             if (isset($boqItem['id'])) {
//                 // Delete the Sub-Sub BOQ item
//                 Boq::where('id', $boqItem['id'])->delete();
//             }
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
//             $boqItem = $this->mainBoqs[$this->deleteIndices['mainIndex']]['boqs'][$this->deleteIndices['boqIndex']];
//             if (isset($boqItem['id'])) {
//                 // Delete the Main BOQ item
//                 Boq::where('id', $boqItem['id'])->delete();
//             }
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
use App\Models\Tax;
use Illuminate\Support\Facades\DB;

class Edit extends Component
{
    public $project_id;
    public $mainBoqs = [];
    public $boqSlug;
    public $taxEnabled = false;
    public $taxId = '';
    public $taxes = [];

    // Modal
    public $showDeleteModal = false;
    public $deleteType = ''; // 'main', 'sub', 'subsub', 'mainitem'
    public $deleteIndices = [];

    // Totals
    public $subtotal = 0;
    public $taxAmount = 0;
    public $total = 0;

    public function mount($slug)
    {
        $this->boqSlug = $slug;
        $this->taxes = Tax::all();

        $mainBoq = Boq::where('slug', $slug)->whereNull('parent_id')->firstOrFail();
        $this->project_id = $mainBoq->project_id;
        $this->taxEnabled = !is_null($mainBoq->tax_id);
        $this->taxId = $mainBoq->tax_id;

        $this->loadBoqs();
        $this->calculateTotals();
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
    }

    public function updated($property)
    {
        $this->calculateTotals();
    }

    public function updatedTaxEnabled($value)
    {
        if (!$value) $this->taxId = '';
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
                        $qty = (float) ($item['quantity'] ?? 0);
                        $rate = (float) ($item['unit_rate'] ?? 0);
                        $subtotal += $qty * $rate;
                    }
                }
            } else {
                foreach ($main['boqs'] as $item) {
                    $qty = (float) ($item['quantity'] ?? 0);
                    $rate = (float) ($item['unit_rate'] ?? 0);
                    $subtotal += $qty * $rate;
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
                    'serial_number' => '', 'item_description' => '', 'unit' => '',
                    'quantity' => '', 'unit_rate' => '', 'amount' => '', 'summary' => '',
                ];
            }
        } elseif ($diff < 0) {
            $this->mainBoqs[$index]['boqs'] = array_slice($this->mainBoqs[$index]['boqs'], 0, $count);
        }
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
                    'serial_number' => '', 'name' => '', 'boqCount' => 0, 'boqs' => [],
                ];
            }
        } elseif ($diff < 0) {
            $this->mainBoqs[$index]['subBoqs'] = array_slice($this->mainBoqs[$index]['subBoqs'], 0, $count);
        }
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
                    'serial_number' => '', 'item_description' => '', 'unit' => '',
                    'quantity' => '', 'unit_rate' => '', 'amount' => '', 'summary' => '',
                ];
            }
        } elseif ($diff < 0) {
            $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'] =
                array_slice($this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'], 0, $count);
        }
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
            Boq::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        unset($this->mainBoqs[$this->deleteIndices['mainIndex']]);
        $this->mainBoqs = array_values($this->mainBoqs);
        $this->closeModal();
        $this->calculateTotals();
    }

    public function deleteSubBoq()
    {
        if ($this->deleteType === 'sub') {
            $m = $this->deleteIndices['mainIndex'];
            $s = $this->deleteIndices['subIndex'];
            $id = $this->mainBoqs[$m]['subBoqs'][$s]['id'] ?? null;
            if ($id) Boq::where('id', $id)->orWhere('parent_id', $id)->delete();
            unset($this->mainBoqs[$m]['subBoqs'][$s]);
            $this->mainBoqs[$m]['subBoqs'] = array_values($this->mainBoqs[$m]['subBoqs']);
            $this->mainBoqs[$m]['subCount'] = count($this->mainBoqs[$m]['subBoqs']);
        }
        $this->closeModal();
        $this->calculateTotals();
    }

    public function deleteSubSubBoq()
    {
        if ($this->deleteType === 'subsub') {
            $m = $this->deleteIndices['mainIndex'];
            $s = $this->deleteIndices['subIndex'];
            $b = $this->deleteIndices['boqIndex'];
            $id = $this->mainBoqs[$m]['subBoqs'][$s]['boqs'][$b]['id'] ?? null;
            if ($id) Boq::where('id', $id)->delete();
            unset($this->mainBoqs[$m]['subBoqs'][$s]['boqs'][$b]);
            $this->mainBoqs[$m]['subBoqs'][$s]['boqs'] = array_values($this->mainBoqs[$m]['subBoqs'][$s]['boqs']);
            $this->mainBoqs[$m]['subBoqs'][$s]['boqCount'] = count($this->mainBoqs[$m]['subBoqs'][$s]['boqs']);
        }
        $this->closeModal();
        $this->calculateTotals();
    }

    public function deleteMainBoqItem()
    {
        if ($this->deleteType === 'mainitem') {
            $m = $this->deleteIndices['mainIndex'];
            $b = $this->deleteIndices['boqIndex'];
            $id = $this->mainBoqs[$m]['boqs'][$b]['id'] ?? null;
            if ($id) Boq::where('id', $id)->delete();
            unset($this->mainBoqs[$m]['boqs'][$b]);
            $this->mainBoqs[$m]['boqs'] = array_values($this->mainBoqs[$m]['boqs']);
            $this->mainBoqs[$m]['boqCount'] = count($this->mainBoqs[$m]['boqs']);
        }
        $this->closeModal();
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
                        $rules["mainBoqs.$m.subBoqs.$s.boqs.$b.serial_number"] = 'required';
                        $rules["mainBoqs.$m.subBoqs.$s.boqs.$b.item_description"] = 'required';
                        $rules["mainBoqs.$m.subBoqs.$s.boqs.$b.unit"] = 'required';
                        $rules["mainBoqs.$m.subBoqs.$s.boqs.$b.quantity"] = 'required|numeric|min:0';
                        $rules["mainBoqs.$m.subBoqs.$s.boqs.$b.unit_rate"] = 'required|numeric|min:0';
                    }
                }
            } else {
                $rules["mainBoqs.$m.boqs"] = 'required|array|min:1';
                foreach ($main['boqs'] as $b => $boq) {
                    $rules["mainBoqs.$m.boqs.$b.serial_number"] = 'required';
                    $rules["mainBoqs.$m.boqs.$b.item_description"] = 'required';
                    $rules["mainBoqs.$m.boqs.$b.unit"] = 'required';
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
        $projects = Project::all();
        return view('livewire.boq.edit', compact('projects'));
    }
}
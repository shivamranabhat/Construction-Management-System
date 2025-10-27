<?php

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

    public function mount($slug)
    {
        $this->boqSlug = $slug;
        $mainBoq = Boq::where('slug', $slug)->whereNull('parent_id')->firstOrFail();
        $this->project_id = $mainBoq->project_id;

        // Load the specific main BOQ and its sub-items
        $this->loadBoqs();
    }

    protected function loadBoqs()
    {
        $this->mainBoqs = [];
        // Fetch only the main BOQ with the matching slug
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

            // Check if main BOQ has sub-BOQs
            $subBoqs = Boq::where('parent_id', $main->id)->where('item_description', null)->get();
            if ($subBoqs->isNotEmpty()) {
                $mainBoqData['subToggled'] = true;
                $mainBoqData['subCount'] = $subBoqs->count();
                foreach ($subBoqs as $sub) {
                    $subBoqItems = Boq::where('parent_id', $sub->id)->whereNotNull('item_description')->get();
                    $subBoqData = [
                        'id' => $sub->id,
                        'serial_number' => $sub->serial_number,
                        'name' => $sub->name,
                        'boqCount' => $subBoqItems->count(),
                        'boqs' => $subBoqItems->map(function ($item) {
                            return [
                                'id' => $item->id,
                                'serial_number' => $item->serial_number,
                                'item_description' => $item->item_description,
                                'unit' => $item->unit,
                                'quantity' => $item->quantity,
                                'unit_rate' => $item->unit_rate,
                                'amount' => $item->amount,
                            ];
                        })->toArray(),
                    ];
                    $mainBoqData['subBoqs'][] = $subBoqData;
                }
            } else {
                $boqItems = Boq::where('parent_id', $main->id)->whereNotNull('item_description')->get();
                $mainBoqData['boqCount'] = $boqItems->count();
                $mainBoqData['boqs'] = $boqItems->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'serial_number' => $item->serial_number,
                        'item_description' => $item->item_description,
                        'unit' => $item->unit,
                        'quantity' => $item->quantity,
                        'unit_rate' => $item->unit_rate,
                        'amount' => $item->amount,
                    ];
                })->toArray();
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

        $this->mainBoqs[$index]['boqs'] = [];
        for ($i = 0; $i < $this->mainBoqs[$index]['boqCount']; $i++) {
            $this->mainBoqs[$index]['boqs'][] = [
                'serial_number' => '',
                'item_description' => '',
                'unit' => '',
                'quantity' => '',
                'unit_rate' => '',
                'amount' => '',
            ];
        }
    }

    public function generateSubBoqs($index)
    {
        $this->validate([
            "mainBoqs.$index.subCount" => 'required|integer|min:1',
        ]);

        $this->mainBoqs[$index]['subBoqs'] = [];
        for ($i = 0; $i < $this->mainBoqs[$index]['subCount']; $i++) {
            $this->mainBoqs[$index]['subBoqs'][] = [
                'serial_number' => '',
                'name' => '',
                'boqCount' => 0,
                'boqs' => [],
            ];
        }
    }

    public function generateSubSubBoqs($mainIndex, $subIndex)
    {
        $this->validate([
            "mainBoqs.$mainIndex.subBoqs.$subIndex.boqCount" => 'required|integer|min:1',
        ]);

        $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'] = [];
        for ($i = 0; $i < $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqCount']; $i++) {
            $this->mainBoqs[$mainIndex]['subBoqs'][$subIndex]['boqs'][] = [
                'serial_number' => '',
                'item_description' => '',
                'unit' => '',
                'quantity' => '',
                'unit_rate' => '',
                'amount' => '',
            ];
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
                // Delete existing BOQs with the same slug
                Boq::where('slug', $this->boqSlug)->delete();

                foreach ($this->mainBoqs as $main) {
                    if (empty($main['name'])) continue;

                    $mainBoq = Boq::create([
                        'project_id' => $this->project_id,
                        'name' => $main['name'],
                        'serial_number' => $main['serial_number'],
                        'company_id' => auth()->user()->company_id,
                        'slug' => Str::slug($main['name'] . '-' . uniqid()),
                    ]);

                    if ($main['subToggled']) {
                        foreach ($main['subBoqs'] as $sub) {
                            $subBoq = Boq::create([
                                'project_id' => $this->project_id,
                                'parent_id' => $mainBoq->id,
                                'name' => $sub['name'],
                                'serial_number' => $sub['serial_number'],
                                'company_id' => auth()->user()->company_id,
                                'slug' => $mainBoq->slug,
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
                                    'slug' => $mainBoq->slug,
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
                                'slug' => $mainBoq->slug,
                            ]);
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

    public function render()
    {
        $projects = Project::all();
        return view('livewire.boq.edit', compact('projects'));
    }
}
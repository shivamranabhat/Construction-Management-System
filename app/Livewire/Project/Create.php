<?php

namespace App\Livewire\Project;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Str;

class Create extends Component
{
    public $name, $code, $client, $start_date, $end_date, $budget, $status;

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:projects,name',
            'code' => 'required|string|max:50|unique:projects,code',
            'client' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'budget' => 'nullable|numeric|min:0',
            'status' => 'required|string',
        ]);

        Project::create([
            'name' => $this->name,
            'code' => $this->code,
            'client' => $this->client,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'budget' => $this->budget,
            'status' => $this->status,
            'company_id' => auth()->user()->company_id,
            'slug' => Str::slug('proj'.'-'.$this->name.'-'.now()),
        ]);

        session()->flash('success', 'Project created successfully!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.project.create');
    }
}

<?php

namespace App\Livewire\Project;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $project;
    public $slug;
    public $name, $code, $client, $start_date, $end_date, $budget, $status;

    public function mount($slug)
    {
        $this->project = Project::where('slug', $slug)->firstOrFail();
        $this->slug = $slug;
        $this->fill($this->project->toArray());
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:projects,name,' . $this->project->id,
            'code' => 'required|string|max:50|unique:projects,code,' . $this->project->id,
            'client' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'budget' => 'nullable|numeric|min:0',
            'status' => 'required|string',
        ]);

        $this->project->update([
            'name' => $this->name,
            'code' => $this->code,
            'client' => $this->client,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'budget' => $this->budget,
            'status' => $this->status,
            'slug' => $slug = Str::slug('proj'.'-'.$this->name.'-'.now()),
        ]);

        return redirect()->route('project.index')->with('success', 'Project updated successfully!');
    }

    public function render()
    {
        return view('livewire.project.edit');
    }
}

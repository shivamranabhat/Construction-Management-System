<?php

namespace App\Livewire\Project;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Str;

class Create extends Component
{
    public $name, $code, $client, $start_date, $end_date, $budget, $status;

    public function mount()
    {
        $this->generateProjectCode();
    }

    public function generateProjectCode()
    {
        $year = now()->format('Y');
        $prefix = "PROJ-{$year}";

        // Find the highest existing code for this year
        $lastProject = Project::where('company_id', auth()->user()->company_id)
            ->where('code', 'LIKE', $prefix . '%')
            ->orderByRaw("CAST(SUBSTRING(code, LENGTH('{$prefix}-') + 1) AS UNSIGNED) DESC")
            ->first();

        if ($lastProject) {
            $lastNumber = (int) substr($lastProject->code, strlen($prefix) + 1); // extract number after prefix
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Format with leading zeros (e.g., 001, 012)
        $this->code = $prefix . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
    
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

        return redirect()->route('project.index')->with('success', 'Project created successfully!');
    }

    public function render()
    {
        return view('livewire.project.create');
    }
}

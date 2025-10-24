<?php

namespace App\Livewire\Company;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Company;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($slug)
    {
        $company = Company::whereSlug($slug)->first();
        $company->users()->delete(); // Delete associated users
        $company->delete();

        session()->flash('success', 'Company and its admin deleted successfully.');
    }

    public function render()
    {
        $companies = Company::with('users')
            ->where('name', 'like', "%{$this->search}%")
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.company.index', compact('companies'));
    }
}

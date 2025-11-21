<?php

namespace App\Livewire\Account;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

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
    
    public function delete($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        session()->flash('message', 'User deleted successfully.');
    }

    public function render()
    {
        if(auth()->user()->role == 'Super Admin')
        {

            $users = User::with('roles')
                        ->whereDoesntHave('roles', function ($query) {
                            $query->where('name', 'Super Admin');
                        })
                        ->where(function ($query) {
                            $query->where('name', 'like', "%{$this->search}%")
                                ->orWhere('email', 'like', "%{$this->search}%")
                                ->orWhereHas('roles', function ($roleQuery) {
                                    $roleQuery->where('name', 'like', "%{$this->search}%");
                                });
                        })
                        ->where('id', '!=', auth()->id())
                        ->latest()
                        ->paginate($this->perPage);
        }
        else{
                 $users = User::with('roles')
                        ->whereDoesntHave('roles', function ($query) {
                            $query->where('name', 'Super Admin');
                        })
                        ->where(function ($query) {
                            $query->where('name', 'like', "%{$this->search}%")
                                ->orWhere('email', 'like', "%{$this->search}%")
                                ->orWhereHas('roles', function ($roleQuery) {
                                    $roleQuery->where('name', 'like', "%{$this->search}%");
                                });
                        })
                        ->where('id', '!=', auth()->id())
                        ->where('company_id',auth()->user()->company_id)
                        ->latest()
                        ->paginate($this->perPage);
        }
        return view('livewire.account.index', compact('users'));
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Business as BusinessModel;
use Illuminate\Support\Facades\Auth;

class Business extends Component
{
    public $businesses;
    public ?BusinessModel $confirmingDelete = null;
    public bool $showDeleteModal = false;

    public function mount()
    {
        $this->loadBusinesses();
    }

    public function loadBusinesses()
    {
        $this->businesses = Auth::user()->businesses()->withPivot('role')->get();
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = BusinessModel::findOrFail($id);
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if (! $this->confirmingDelete) return;

        abort_unless(
            Auth::user()->businesses()->wherePivot('role', 'admin')->where('businesses.id', $this->confirmingDelete->id)->exists(),
            403
        );

        $this->confirmingDelete->delete();
        session()->flash('success', 'Business deleted successfully.');

        $this->confirmingDelete = null;
        $this->showDeleteModal = false;
        $this->loadBusinesses();
    }



    public function render()
    {
        return view('livewire.business.business-index');
    }
}

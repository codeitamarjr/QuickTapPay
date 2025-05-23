<?php

namespace App\Livewire\Members;

use App\Models\User;
use Livewire\Component;
use App\Models\Business;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BusinessTeamInvitationMail;

class BusinessTeam extends Component
{
    public $business;
    public $members;
    public ?User $confirmingDelete = null;
    public bool $showDeleteModal = false;

    public function mount(Business $business)
    {
        abort_unless(Auth::user()->businesses->contains($business), 403);
        $this->business = $business;
        $this->loadUsers();
    }

    public function loadUsers()
    {
        $this->members = $this->business->users()->withPivot('role')->get();
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = User::findOrFail($id);
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if (! $this->confirmingDelete) return;

        abort_unless(
            Auth::user()->isAdmin($this->business),
            403
        );

        $this->business->users()->detach($this->confirmingDelete->id);

        session()->flash('success', 'User deleted successfully.');

        $this->confirmingDelete = null;
        $this->showDeleteModal = false;
        $this->loadUsers();
    }

    public function resendInvite($userId)
    {
        $user = User::findOrFail($userId);

        abort_unless(Auth::user()->isAdmin($this->business), 403);

        if (empty($user->invitation_token)) {
            session()->flash('error', 'This user has already accepted the invitation.');
            return;
        }

        $url = route('invitation.accept', ['token' => $user->invitation_token]);

        Mail::to($user->email)->send(new BusinessTeamInvitationMail(
            inviter: Auth::user(),
            business: $this->business,
            role: $user->pivot->role ?? 'member',
            actionUrl: $url,
        ));

        session()->flash('success', 'Invitation resent to ' . $user->email);
    }

    public function render()
    {
        return view('livewire.members.business-team');
    }
}

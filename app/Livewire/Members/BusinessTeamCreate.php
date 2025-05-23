<?php

namespace App\Livewire\Members;

use Livewire\Component;
use App\Models\Business;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BusinessTeamInvitationMail;

class BusinessTeamCreate extends Component
{
    public $business;
    public $name = '';
    public $email = '';
    public string $role = 'member';


    public function mount(Business $business)
    {
        abort_unless(Auth::user()->businesses->contains($business), 403);
        $this->business = $business;
    }

    public function invite()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|in:admin,member',
        ]);

        $user = \App\Models\User::firstOrCreate(
            ['email' => $this->email],
            [
                'name' => $this->name,
                'password' => bcrypt(Str::random(16)),
                'invitation_token' => Str::uuid(),
            ]
        );

        if (! $user->invitation_token) {
            $user->invitation_token = Str::uuid();
            $user->save();
        }

        $this->business->users()->syncWithoutDetaching([
            $user->id => ['role' => $this->role],
        ]);

        Mail::to($user->email)->send(new BusinessTeamInvitationMail(
            inviter: Auth::user(),
            business: $this->business,
            role: $this->role,
            actionUrl: route('invitation.accept', ['token' => $user->invitation_token]),
        ));

        $this->reset(['name', 'email', 'role']);
        session()->flash('success', 'User invited successfully.');
        return redirect()->route('business.team', ['business' => $this->business]);
    }

    public function render()
    {
        return view('livewire.members.business-team-create');
    }
}

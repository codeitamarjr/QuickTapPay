<?php

namespace App\Livewire\Settings;

use App\Models\User;
use CodeItamarJr\Attachments\Services\AttachmentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public string $name = '';

    public string $email = '';

    public $photoUpload = null;

    public ?string $photoUrl = null;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->photoUrl = Auth::user()->avatar_url;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(AttachmentService $attachments): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
            'photoUpload' => ['nullable', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        if ($this->photoUpload) {
            $photo = $attachments->replace($user, $this->photoUpload, 'avatar', $user->getKey());
            $this->photoUrl = $photo->url();
            $this->photoUpload = null;
        }

        $this->dispatch('profile-updated', name: $user->name);
    }

    public function removeProfilePhoto(AttachmentService $attachments): void
    {
        $user = Auth::user();

        $attachments->delete($user, 'avatar');

        $this->photoUpload = null;
        $this->photoUrl = null;

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}

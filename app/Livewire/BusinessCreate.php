<?php

namespace App\Livewire;

use App\Models\Business;
use App\Services\Attachments\AttachmentService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class BusinessCreate extends Component
{
    use WithFileUploads;

    public bool $onboarding = false;
    public ?string $redirectTo = null;
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $address_line1 = '';
    public string $address_line2 = '';
    public string $address_line3 = '';
    public string $address_line4 = '';
    public string $postal_code = '';
    public string $city = '';
    public string $country = '';
    public string $website = '';
    public string $vat_number = '';
    public string $tax_number = '';
    public string $currency = 'EUR';
    public $logoUpload = null;

    public function mount(bool $onboarding = false, ?string $redirectTo = null): void
    {
        $this->onboarding = $onboarding;
        $this->redirectTo = $redirectTo;
    }

    public function save(AttachmentService $attachments)
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:businesses,email',
            'currency' => 'required|string|max:3',
            'logoUpload' => 'nullable|mimes:jpg,jpeg,png,svg,webp|max:4096',
        ]);

        $business = Business::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address_line1' => $this->address_line1,
            'address_line2' => $this->address_line2,
            'address_line3' => $this->address_line3,
            'address_line4' => $this->address_line4,
            'postal_code' => $this->postal_code,
            'city' => $this->city,
            'country' => $this->country,
            'website' => $this->website,
            'vat_number' => $this->vat_number,
            'tax_number' => $this->tax_number,
            'currency' => $this->currency,
        ]);

        $business->users()->attach(Auth::id(), ['role' => 'admin']);

        if ($this->logoUpload) {
            $logo = $attachments->store($business, $this->logoUpload, 'logo', Auth::id());
            $business->forceFill(['logo' => $logo->path])->save();
        }

        session()->flash('success', $this->onboarding
            ? __('Business created successfully! Next, connect your Stripe account.')
            : __('Business created successfully!')
        );

        return redirect()->to($this->redirectTo ?? route('business.index'));
    }

    public function render()
    {
        return view(
            $this->onboarding
                ? 'livewire.onboarding.business-create'
                : 'livewire.business.business-create'
        );
    }
}

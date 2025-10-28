<?php

namespace App\Livewire;

use App\Models\Business;
use QuickTapPay\Attachments\Services\AttachmentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class BusinessEdit extends Component
{
    use WithFileUploads;

    public Business $business;

    public string $name;
    public string $email;
    public ?string $phone = null;
    public ?string $address_line1 = null;
    public ?string $address_line2 = null;
    public ?string $address_line3 = null;
    public ?string $address_line4 = null;
    public ?string $postal_code = null;
    public ?string $city = null;
    public ?string $country = null;
    public ?string $website = null;
    public ?string $vat_number = null;
    public ?string $tax_number = null;
    public string $currency = 'EUR';
    public $logoUpload = null;
    public ?string $logoUrl = null;


    public function mount(Business $business)
    {
        abort_unless(Auth::user()->businesses->contains($business), 403);

        $this->business = $business;
        $this->fill($business->only([
            'name',
            'email',
            'phone',
            'address_line1',
            'address_line2',
            'address_line3',
            'address_line4',
            'postal_code',
            'city',
            'country',
            'website',
            'vat_number',
            'tax_number',
            'currency'
        ]));

        $this->logoUrl = $business->logo_url;
    }

    public function update(AttachmentService $attachments)
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:businesses,email,' . $this->business->id,
            'currency' => 'required|string|max:3',
            'logoUpload' => 'nullable|mimes:jpg,jpeg,png,svg,webp|max:4096',
        ]);

        $this->business->update([
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

        if ($this->logoUpload) {
            $logo = $attachments->replace($this->business, $this->logoUpload, 'logo', Auth::id());
            $this->business->forceFill(['logo' => $logo->path])->save();
            $this->logoUrl = $logo->url();
        }

        $this->dispatch('saved');
        session()->flash('success', 'Business updated successfully.');
        return redirect()->route('business.index');
    }

    public function removeLogo(AttachmentService $attachments): void
    {
        $attachments->delete($this->business, 'logo');

        if ($legacyLogo = $this->business->logo) {
            Storage::disk('public')->delete($legacyLogo);
        }

        $this->business->forceFill(['logo' => null])->save();
        $this->logoUpload = null;
        $this->logoUrl = null;

        session()->flash('success', __('Business logo removed.'));
    }

    public function render()
    {
        return view('livewire.business.business-edit');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Business;
use Illuminate\Support\Facades\Auth;

class BusinessEdit extends Component
{
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
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:businesses,email,' . $this->business->id,
            'currency' => 'required|string|max:3',
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

        $this->dispatch('saved');
        session()->flash('success', 'Business updated successfully.');
        return redirect()->route('business.index');
    }

    public function render()
    {
        return view('livewire.business.business-edit');
    }
}

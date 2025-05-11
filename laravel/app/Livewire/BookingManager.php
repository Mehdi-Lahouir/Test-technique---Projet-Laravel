<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Property;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingManager extends Component
{
    public $propertyId;
    public $start_date;
    public $end_date;
    public $properties;

    protected $rules = [
        'propertyId'  => 'required|exists:properties,id',
        'start_date'  => 'required|date|after_or_equal:today',
        'end_date'    => 'required|date|after:start_date',
    ];

    public function mount()
    {
        $this->properties = Property::all();
    }

    public function book()
    {
        $this->validate([
            'propertyId' => ['required', 'exists:properties,id'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date'   => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        Booking::create([
            'user_id'     => Auth::id(),
            'property_id' => $this->propertyId,
            'start_date'  => $this->start_date,
            'end_date'    => $this->end_date,
        ]);

        session()->flash('success', 'Réservation enregistrée !');
        $this->reset(['start_date','end_date']);
    }

    public function render()
    {
        return view('livewire.booking-manager');
    }
}

<?php

namespace App\Livewire;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
#[Layout('layouts.app')]
class MyBookings extends Component
{
    public function render()
    {
        $bookings = Auth::user()
            ->bookings()
            ->with('property')
            ->orderByDesc('start_date')
            ->get();

        return view('livewire.my-bookings', [
            'bookings' => $bookings,
        ]);
    }
}

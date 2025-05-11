<div class="overflow-x-auto">
    <h2 class="text-xl font-semibold mb-4">Mes réservations</h2>

    @if($bookings->isEmpty())
        <p class="text-gray-600">Vous n’avez encore aucune réservation.</p>
    @else
        <table class="min-w-full bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Bien</th>
                    <th class="px-4 py-2 text-left">Début</th>
                    <th class="px-4 py-2 text-left">Fin</th>
                    <th class="px-4 py-2 text-left">Total&nbsp;(€)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $b)
                    @php
                        $nights = \Illuminate\Support\Carbon::parse($b->start_date)
                                ->diffInDays($b->end_date);
                        $total  = $b->property->price_per_night * $nights;
                    @endphp
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $b->property->name }}</td>
                        <td class="px-4 py-2">{{ $b->start_date->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">{{ $b->end_date->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">{{ number_format($total, 2, ',', ' ') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

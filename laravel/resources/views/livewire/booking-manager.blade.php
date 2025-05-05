<div class="max-w-lg mx-auto space-y-4">
  @if (session()->has('success'))
    <div class="p-3 bg-green-100 text-green-800 rounded">
      {{ session('success') }}
    </div>
  @endif

  <div>
    <label for="property" class="block font-medium mb-1">Bien à réserver</label>
    <select id="property" wire:model="propertyId" class="w-full border rounded p-2">
      <option value="">-- Choisir un bien --</option>
      @foreach($properties as $p)
        <option value="{{ $p->id }}">
          {{ $p->name }} — {{ number_format($p->price_per_night, 2) }} €/nuit
        </option>
      @endforeach
    </select>
    @error('propertyId') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
  </div>

  <div class="grid grid-cols-2 gap-4">
    <div>
      <label for="start_date" class="block font-medium mb-1">Date de début</label>
      <input id="start_date" type="date" wire:model="start_date" class="w-full border rounded p-2" />
      @error('start_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
      <label for="end_date" class="block font-medium mb-1">Date de fin</label>
      <input id="end_date" type="date" wire:model="end_date" class="w-full border rounded p-2" />
      @error('end_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>
  </div>

  <button wire:click="book" class="w-full px-4 py-2 bg-secondary text-white rounded hover:bg-secondary/90">
    Réserver
  </button>
</div>


@extends('layouts.app')

@section('content')
  <h1 class="text-3xl font-bold mb-6 text-primary">Page de Test UI</h1>

  <div class="space-y-4">
    <p class="text-gray-700">Voici un paragraphe pour vérifier la typo et les couleurs.</p>

    <x-button>Réserver maintenant</x-button>

    <a href="#" class="inline-block px-4 py-2 rounded border border-primary text-primary hover:bg-primary hover:text-white transition">
      Lien personnalisé
    </a>

    <div class="p-4 bg-white rounded shadow">
      <h2 class="text-xl font-semibold text-secondary">Carte : Propriété</h2>
      <p class="mt-2 text-gray-600">Description courte du bien.</p>
      <p class="mt-1 font-bold">120 €/nuit</p>
      <x-button class="mt-4">Voir le détail</x-button>
    </div>
  </div>
@endsection

<button {{ $attributes->merge(['class' => 'px-4 py-2 rounded bg-primary text-white hover:bg-primary/90']) }}>
  {{ $slot }}
</button>

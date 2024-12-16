<div>
    <div class="mb-4">
        <input
                wire:model.live.debounce.300ms="search"
                type="text"
                placeholder="Search products..."
                class="focus:ring-blue-500 w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2"
        />
    </div>
    <ul>
        @forelse($products as $product)
            <li>{{ $product->title }}</li>
        @empty
            <div class="rounded-lg bg-white p-4 text-center shadow">No products found.</div>
        @endforelse
    </ul>
</div>
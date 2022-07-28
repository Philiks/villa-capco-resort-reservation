<x-app-layout>
    <div class="grid grid-cols-1 lg:grid-cols-2 justify-around m-10 gap-10">
        @foreach ($accommodations as $accommodation)
            <article class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 bg-primary-bg border rounded-lg overflow-hidden">
                <div class="relative pb-3/2 rounded-lg h-2/5-screen">
                    @php
                        $images = $accommodation->images()->get()
                            ->map(fn ($item, $key) => [
                                'image_path' => $item->file_path
                            ])->toArray();
                        $alt = $accommodation->name;
                    @endphp
                    <x-static-swiper :images="$images" :alt="$alt"
                        class="absolute top-0 object-cover w-full h-full" />
                </div>

                <div class="p-4">
                    <x-card-title :value="$accommodation->name" />
                    <x-card-details :value="$accommodation->details" />
                </div>
                <x-package-table class="col-span-1 md:col-span-2 lg:col-span-1 xl:col-span-2"
                    :packages="$accommodation->packages" :accommodation_id="$accommodation->id" />
            </article>
        @endforeach
    </div>
</x-app-layout>

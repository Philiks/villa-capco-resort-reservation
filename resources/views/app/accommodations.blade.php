<x-app-layout>
    <div class="grid grid-cols-1 lg:grid-cols-2 justify-around m-10 gap-10">
        @foreach ($accommodations as $index=>$accommodation)
            <article class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 bg-white border rounded-lg transition duration-700 ease-in-out hover:scale-105 overflow-hidden">
                <div class="relative pb-3/2 rounded-lg h-2/5-screen">
                    @php
                        $images = $accommodation->images()->get()
                            ->map(fn ($item, $key) => [
                                'image_path' => $item->file_path
                            ])->toArray();
                        $alt = $accommodation->name;
                    @endphp
                    <x-swiper :images="$images" :alt="$alt"
                        class="absolute top-0 object-cover w-full h-full" />
                </div>

                <div class="p-4">
                    <x-card-title :value="$accommodation->name" />
                    <x-card-details :value="$accommodation->details" />
                </div>
            </article>
        @endforeach
    </div>
</x-app-layout>

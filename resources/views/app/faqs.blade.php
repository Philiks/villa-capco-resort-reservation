<x-app-layout>
    <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 justify-around m-10 gap-10">
        @foreach ($faqs as $faq)
            <article class="bg-primary-bg border rounded-lg transition duration-700 ease-in-out hover:scale-105 overflow-hidden">
                <div class="p-4">
                    <x-card-title :value="$faq->question" />
                    <x-card-description :value="$faq->answer" />
                </div>
            </article>
        @endforeach
    </div>
</x-app-layout>
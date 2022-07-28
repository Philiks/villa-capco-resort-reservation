<x-app-layout>
    <div class="flex flex-col justify-center items-center gap-4 h-1/2-screen">
        <x-application-logo class="block h-40 w-auto" />
        <p class="text-center text-lg w-3/4 pt-5 border-t-4 border-secondary-fg">
            Looking for elegant yet affordable venue. Perfect venue for Corporate events and private occasions.
            Express the youthful soul inside you and enjoy the amazing treats that villa capco prepare for you.
        </p>
    </div>

    <article class="mx-20 my-5 bg-primary-bg border rounded-lg overflow-hidden">
        <img src="{{ asset('storage/images/accommodations/pool_1.jpg') }}" alt="First Pool" class="float-left object-cover w-[33.3333vw] h-auto mr-5">
        <div class="mr-5 mt-3">
            <h1 class="text-start text-2xl w-3/4 text-primary-fg font-bold pt-5">
                The first Pool of Villa Capco
            </h1>
            <p class="text-start text-lg">
                We started just like how any resorts did. We start from one pool until we reach where we are now.
                The place was just right; not too far from the street to find and navigate but not too close so that 
                visitors can still feel the freedom away from the busy city. Our first pool is our constant reminder
                of our big vision with even greater passion. Where we are now started from that tiny little pool.
            </p>
        </div>
    </article>

    <article class="mx-20 my-10 bg-primary-bg border rounded-lg overflow-hidden">
        <img src="{{ asset('storage/images/addons/function_hall.jpg') }}" alt="Function Hall" class="float-right object-cover w-[33.3333vw] h-auto ml-5">
        <div class="ml-5 mt-5">
            <h1 class="text-end text-2xl w-3/4 text-primary-fg font-bold pt-5">
                Our undying commitment
            </h1>
            <p class="text-end text-lg">
                We believe that everyone has the right for affordable place to celebrate. Villa Capco caters those
                people who would want the best of two worlds. Being gorgeous at the right expense. We commited our
                passion and love for giving services to the people and making their moments memorable. We have the
                right accommodations for you!
            </p>
        </div>
    </article>

    <div class="flex flex-col justify-center items-center mt-20">
        <h1 class="text-center text-3xl w-3/4 font-bold border-b-2 pb-5 text-secondary-fg border-secondary-fg">
            What do People thinks about our Service?
        </h1>
    </div>

    <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 justify-around m-10 gap-10">
        @foreach ($ratings as $rating)
            <article class="bg-primary-bg border rounded-lg transition duration-700 ease-in-out hover:scale-105 overflow-hidden">
                <div class="p-4">
                    <div class="flex items-center">
                        <x-ratings :value="$rating->rating_score" />
                        <x-card-title :value="number_format($rating->rating_score, 1)" class="inline font-extrabold ml-3 pt-0.5 text-primary-fg" />
                    </div>
                    <x-tag :value="'Written by: ' . $rating->user->getFullname()" class="bg-secondary-bg" />
                    <x-card-description :value="$rating->comment" />
                </div>
            </article>
        @endforeach
    </div>
</x-app-layout>
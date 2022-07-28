<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form x-data="{ open: false }" method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- First Name -->
            <div>
                <x-label for="first_name" :value="__('First Name')" />

                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="$user->first_name" required autofocus />
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <x-label for="last_name" :value="__('Last Name')" />

                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="$user->last_name" required />
            </div>

            <!-- Contact Number -->
            <div class="mt-4">
                <x-label for="contact_number" :value="__('Contact Number')" />

                <x-input id="contact_number" class="block mt-1 w-full" type="text" name="contact_number" :value="$user->contact_number" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" required />
            </div>

            <div @click="open = ! open" class="mt-6 cursor-pointer">
                <template x-if="open">
                    <div class="flex items-center">
                        {{ __('Close Password') }}
                        <x-heroicon-s-chevron-up class="ml-1 w-6 h-5" />
                    </div>
                </template>

                <template x-if="! open">
                    <div class="flex items-center">
                        {{ __('Change Password') }}
                        <x-heroicon-s-chevron-down class="ml-1 w-6 h-5" />
                    </div>
                </template>
            </div>

            <div x-bind:class="! open ? 'hidden' : ''" class="mt-4">
                <!-- Old Password -->
                <div class="mt-4">
                    <x-label for="old_password" :value="__('Old Password')" />

                    <x-input id="old_password" class="block mt-1 w-full"
                                    type="password"
                                    name="old_password"
                                    autocomplete="old-password" />
                </div>

                <!-- New Password -->
                <div class="mt-4">
                    <x-label for="new_password" :value="__('New Password')" />

                    <x-input id="new_password" class="block mt-1 w-full"
                                    type="password"
                                    name="new_password"
                                    autocomplete="new-password" />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ url()->previous() }}">
                    {{ __('Cancel') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Update') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>

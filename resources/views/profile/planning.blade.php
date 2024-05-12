<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Rencana Membership') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
                @include('profile.partials.plan-user')
        </div>
    </div>
</x-app-layout>

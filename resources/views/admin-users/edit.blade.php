<x-app-layout>
    <x-slot name="header">
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{route('users.index')}}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <x-heroicon-o-user-circle class="w-4 h-4 mr-1"/>
                        Users
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="javascript:void()"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                        {{request()->routeIs('users.edit') ? 'Edit User' : 'Create User'}}

                        </a>
                    </div>
                </li>
            </ol>
        </nav>

        <h2 class="font-semibold text-xl leading-tight">
            {{ !empty($L_user->name) ? 'Edit User' : 'Create User' }}
        </h2>

        @if (session('status') === 'user-created')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
            class="text-sm text-green-600 dark:text-green-400">
            {{ __('User Berhasil Ditambah.') }}
        </p>
    @endif
    </x-slot>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-xl">
                @if (!empty($user->name))
                @include('profile.partials.update-profile-information-form')
                @else
                @include('profile.partials.create-profile-information')
                @endif
            </div>
        </div>

        @if (!empty($L_user->name))
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>
        @endif

    </div>

    @push('scripts')
    @if (!empty($L_user->name))
    <script>
        document.getElementById("role").addEventListener("change", function() {
        var selectedValue = this.value;
        var paragraph1 = document.getElementById("clientProfile");
        var warnText = document.getElementById('warnText');
    
        paragraph1.style.display = "none";
        warnText.style.display = "none";
        
        if (selectedValue === "client") {
            paragraph1.style.display = "block";
        }
        if (selectedValue === "admin" && '{{$L_user->role}}' === 'client'){
            warnText.style.display = "block";
        }
    });
    </script>
    @else
    <script src="{{URL::asset ('js/createUser.js')}}"></script>
    @endif
    @endpush
</x-app-layout>

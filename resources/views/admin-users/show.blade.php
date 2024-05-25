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
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Detail User</a>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="flex flex-row justify-between">
                <div class="flex flex-row items-center mb-4">
                    <x-heroicon-o-user-circle class="w-7 h-7 mr-2" />
                    <span class="">Detail User</span>
                </div>
            </div>
            <div class="flex flex-row items-center">
                <table class="w-2/3 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <tbody>
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-3 py-2 w-1/3"><span class="font-bold">Nama</span></td>
                            <td class="px-3 py-2 w-2/3">: {{$user->name}}</td>
                        </tr>
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-3 py-2 w-1/3"><span class="font-bold">Email</span></td>
                            <td class="px-3 py-2 w-2/3">: {{$user->email}}</td>
                        </tr>
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-3 py-2 w-1/3"><span class="font-bold">Role</span></td>
                            <td class="px-3 py-2 w-2/3">: {{$user->role}}</td>
                        </tr>
                        @if ($user->role == 'client')
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-3 py-2 w-1/3"><span class="font-bold">Tanggal Lahir</span></td>
                            <td class="px-3 py-2 w-2/3">: {{Carbon\Carbon::parse($user->customer->tgl_lahir)->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y')}}</td>
                        </tr>
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-3 py-2 w-1/3"><span class="font-bold">Jenis Kelamin</span></td>
                            <td class="px-3 py-2 w-2/3">: {{$user->customer->jekel}}</td>
                        </tr>
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-3 py-2 w-1/3"><span class="font-bold">Tipe Aktivitas</span></td>
                            <td class="px-3 py-2 w-2/3">: {{$user->customer->tipe_aktivitas}}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <x-heroicon-o-user class="w-1/4 text-gray-700 bg-gray-50 rounded-full stroke-1 ml-10"/>
            </div>
            
        </div>
    </div>
</x-app-layout>

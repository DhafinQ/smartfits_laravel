<x-app-layout>
    <x-slot name="header">


        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{route('foodnote.index',['jadwal' => $tgl ?? request()->jadwal ?? ''])}}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <x-heroicon-o-clock class="w-4 h-4 mr-1"/>
                        Jadwal Makan
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
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">{{!empty($foodNote) ? 'Edit' : 'Tambah'}} Makan</a>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-bold leading-tight flex flex-row items-center">
                <x-heroicon-o-clipboard-list class="w-7 h-7 mr-2" />
                {{ (!empty($foodNote) ? 'Edit' : 'Tambah') . ' Makan ' . ucfirst($kategori) }}
            </h2>
        </div>
    </x-slot>

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
        <div class="max-w-xl">
            @include('foodnote.partials.create-foodnote')
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Hello ') . Auth::user()->name }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-screen-2xl pb-6">
        @if (checkRole())
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
                <div class="rounded-md border-2 border-teal-500 bg-white px-7 py-6 shadow-default  dark:bg-dark-eval-1">
                    <div class="flex h-11.5 w-11.5 items-center justify-start rounded-full bg-meta-2 dark:bg-meta-4">
                        <x-heroicon-o-user-group aria-hidden="true" class="w-5 h-5" />
                        <span class="font-semibold ml-1">Jumlah Customer</span>
                    </div>

                    <div class="mt-4 flex items-end justify-between">
                        <div>
                            <h4 class="text-title-md font-bold text-black dark:text-white">
                                {{$customerCount}} Customer
                            </h4>
                            <span class="text-sm font-medium">Jumlah User (Customer)</span>
                        </div>
                    </div>
                </div>
                <div class="rounded-md border-2 border-teal-500 bg-white px-7 py-6 shadow-default  dark:bg-dark-eval-1">
                    <div class="flex h-11.5 w-11.5 items-center justify-start rounded-full bg-meta-2 dark:bg-meta-4">
                        <x-heroicon-o-chat-alt aria-hidden="true" class="w-5 h-5" />
                        <span class="font-semibold ml-1">Jumlah Feedback</span>
                    </div>

                    <div class="mt-4 flex items-end justify-between">
                        <div>
                            <h4 class="text-title-md font-bold text-black dark:text-white">
                                {{$feedbackCount}} Feedback
                            </h4>
                            <span class="text-sm font-medium">Jumlah Feedback User</span>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">

                <div class="rounded-md border-2 border-teal-500 bg-white px-7 py-6 shadow-default  dark:bg-dark-eval-1">
                    <div class="flex h-11.5 w-11.5 items-center justify-start rounded-full bg-meta-2 dark:bg-meta-4">
                        <x-heroicon-o-badge-check aria-hidden="true" class="w-5 h-5" />
                        <span class="font-semibold ml-1">Konsumsi Kalori</span>
                    </div>

                    <div class="mt-4 flex items-end justify-between">
                        <div>
                            <h4 class="text-title-md font-bold text-black dark:text-white">
                                {{ Auth::user()->customer->getCalories() }} KKal
                            </h4>
                            <span class="text-sm font-medium">Konsumsi Kalori Ideal</span>
                        </div>
                    </div>
                </div>

                <div class="rounded-md border-2 border-teal-500 bg-white px-7 py-6 shadow-default  dark:bg-dark-eval-1">
                    <div class="flex h-11.5 w-11.5 items-center justify-start rounded-full bg-meta-2 dark:bg-meta-4">
                        <x-heroicon-o-clipboard-check aria-hidden="true" class="w-5 h-5" />
                        <span class="font-semibold ml-1">Jumlah Kalori</span>
                    </div>

                    <div class="mt-4 flex items-end justify-between">
                        <div>
                            <h4 class="text-title-md font-bold text-black dark:text-white">
                                {{ $totalKal }} Kkal
                            </h4>
                            <span class="text-sm font-medium">Jumlah Kalori Hari Ini</span>
                        </div>
                    </div>
                </div>

                <div class="rounded-md border-2 border-teal-500 bg-white px-7 py-6 shadow-default  dark:bg-dark-eval-1">
                    <div class="flex h-11.5 w-11.5 items-center justify-start rounded-full bg-meta-2 dark:bg-meta-4">
                        <x-heroicon-o-calculator aria-hidden="true" class="w-5 h-5" />
                        <span class="font-semibold ml-1">Sisa Kalori</span>
                    </div>

                    <div class="mt-4 flex items-end justify-between">
                        <div>
                            <h4 class="text-title-md font-bold text-black dark:text-white center">
                                {{ Auth::user()->customer->getCalories() - $totalKal > 0 ? Auth::user()->customer->getCalories() - $totalKal : '0' }}
                                Kkal
                            </h4>
                            <span class="text-sm font-medium">Sisa Kalori Hari Ini</span>
                        </div>
                        @if (Auth::user()->customer->getCalories() - $totalKal > 0)
                            <x-button href="{{ route('foodnote.index') }}" size="sm">
                                <x-heroicon-o-plus-circle aria-hidden="true" class="w-4 h-4 mr-1" />
                                Tambah
                            </x-button>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="xl:flex-row xl:flex">
        @if (checkRole())
        @else
            <div class="p-6 my-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 xl:w-2/3">
                <div class="flex flex-row items-center">
                    <x-heroicon-o-presentation-chart-line class="w-7 h-7 mr-1" />
                    <span class="">Analisis Pola Makan</span>
                </div>
                {!! $chart->container() !!}
            </div>

            <div class="mx-3 p-6 my-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 xl:w-1/3">
                <div class="flex flex-row items-center">
                    <x-heroicon-o-chart-pie class="w-7 h-7 mr-1" />
                    <span class="">Jumlah Kalori Hari Ini</span>
                </div>
                {!! $chart2->container() !!}
            </div>
        @endif

    </div>

    @if (checkRole())
    <div
        class="p-6 my-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 
                @if (checkRole()) w-full
                @else
                xl:w-2/3 @endif
    ">
            <div class="flex flex-row items-center mb-4">
                <x-heroicon-o-presentation-chart-line class="w-7 h-7 mr-1" />
                <span class="">Feedback Terbaru</span>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-3 py-2">Subjek</th>
                        <th scope="col" class="px-3 py-2">Nama</th>
                        <th scope="col" class="px-3 py-2">Tanggal</th>
                        <th scope="col" class="px-3 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($feedbackCount  > 0)
                    @foreach ($feedbacks as $feedback)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td class="px-3 py-2 w-1/3">{{$feedback->subjek}}</td>
                        <td class="px-3 py-2 w-1/5">{{$feedback->user->name}}</td>
                        <td class="px-3 py-2 w-1/4">{{Carbon\Carbon::parse($feedback->created_at)->format('Y-m-d')}}</td>
                        <td class="px-3 py-2">
                            <div class="flex flex-row items-center space-x-2 justify-center">
                                <x-button href="{{route('feedback.show',['feedback'=>$feedback->id])}}" size="sm" variant="success">
                                    <x-heroicon-s-eye aria-hidden="true" class="w-4 h-4" />
                                </x-button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr class="bg-white dark:bg-gray-900 ">
                        <td colspan="4" class="text-center px-3 py-2">Belum Terdapat Feedback.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        @endif
        @if (!checkRole())
            @push('scripts')
                {!! $chart->script() !!}
                {!! $chart2->script() !!}
            @endpush
        @endif

</x-app-layout>

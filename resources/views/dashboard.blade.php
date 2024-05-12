<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Hello ') . Auth::user()->name }}
            </h2>
            {{-- <x-button target="_blank" href="https://github.com/kamona-wd/kui-laravel-breeze" variant="black"
                class="justify-center max-w-xs gap-2">
                <x-icons.github class="w-6 h-6" aria-hidden="true" />
                <span>Star on Github</span>
            </x-button> --}}
        </div>
    </x-slot>

    <div class="max-w-screen-2xl pb-6">
        <div
          class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5"
        >
        
        <div
        class="rounded-md border-2 border-teal-500 bg-white px-7 py-6 shadow-default  dark:bg-dark-eval-1"
      >
        <div
          class="flex h-11.5 w-11.5 items-center justify-start rounded-full bg-meta-2 dark:bg-meta-4"
        >
        <x-heroicon-o-badge-check aria-hidden="true" class="w-5 h-5" />
          <span class="font-semibold ml-1">Konsumsi Kalori</span>
        </div>

        <div class="mt-4 flex items-end justify-between">
          <div>
            <h4
              class="text-title-md font-bold text-black dark:text-white"
            >
              {{Auth::user()->customer->getCalories()}} KKal
            </h4>
            <span class="text-sm font-medium">Konsumsi Kalori Ideal</span>
          </div>
        </div>
      </div>

       <div
        class="rounded-md border-2 border-teal-500 bg-white px-7 py-6 shadow-default  dark:bg-dark-eval-1"
      >
        <div
          class="flex h-11.5 w-11.5 items-center justify-start rounded-full bg-meta-2 dark:bg-meta-4"
        >
        <x-heroicon-o-clipboard-check aria-hidden="true" class="w-5 h-5" />
          <span class="font-semibold ml-1">Jumlah Kalori</span>
        </div>

        <div class="mt-4 flex items-end justify-between">
          <div>
            <h4
              class="text-title-md font-bold text-black dark:text-white"
            >
              {{$totalKal}} Kkal
            </h4>
            <span class="text-sm font-medium">Jumlah Kalori Hari Ini</span>
          </div>
        </div>
      </div>

       <div
        class="rounded-md border-2 border-teal-500 bg-white px-7 py-6 shadow-default  dark:bg-dark-eval-1"
      >
        <div
          class="flex h-11.5 w-11.5 items-center justify-start rounded-full bg-meta-2 dark:bg-meta-4"
        >
        <x-heroicon-o-calculator aria-hidden="true" class="w-5 h-5" />
          <span class="font-semibold ml-1">Sisa Kalori</span>
        </div>

        <div class="mt-4 flex items-end justify-between">
          <div>
            <h4
              class="text-title-md font-bold text-black dark:text-white center"
            >
              {{(Auth::user()->customer->getCalories() - $totalKal) > 0 ? Auth::user()->customer->getCalories() - $totalKal : '0'}} Kkal
            </h4>
            <span class="text-sm font-medium">Sisa Kalori Hari Ini</span>
          </div>
          @if (Auth::user()->customer->getCalories() - $totalKal > 0)
          <x-button href="{{route('foodnote.index')}}" size="sm">
            <x-heroicon-o-plus-circle aria-hidden="true" class="w-4 h-4 mr-1" />  
            Tambah
          </x-button>
          @endif
        </div>
      </div>

        </div>
    </div>

    <div class="xl:flex-row xl:flex">
        <div class="p-6 my-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 xl:w-2/3">
          <div class="flex flex-row items-center">
            <x-heroicon-o-presentation-chart-line class="w-7 h-7 mr-1"/>
            <span class="">Analisis Pola Makan</span>
        </div>
            {!! $chart->container() !!}
        </div>
    
        <div class="mx-3 p-6 my-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 xl:w-1/3">
          <div class="flex flex-row items-center">
            <x-heroicon-o-chart-pie class="w-7 h-7 mr-1"/>
            <span class="">Jumlah Kalori Hari Ini</span>
        </div>
            {!! $chart2->container() !!}
        </div>
    </div>
    

    @push('scripts')
    {!! $chart->script() !!}
    {!! $chart2->script() !!}
    @endpush

</x-app-layout>

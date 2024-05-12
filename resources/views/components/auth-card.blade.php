<main class="flex flex-col items-center flex-1 px-4 pt-6 sm:justify-center">
    <div class="">
        <a href="/">
            <x-application-logo class="block ml-6 w-20 h-20 -mb-6" />
        </a>
        <span class="font-semibold text-xl">SmartFits</span>
    </div>

    <div class="w-full px-6 py-4 my-6 overflow-hidden bg-white rounded-md shadow-md sm:max-w-md dark:bg-dark-eval-1">
        {{ $slot }}
    </div>
</main>
<footer class="flex-shrink-0 px-6 py-4">
    @auth
    @if (!checkRole())
    <p class="flex items-center justify-center gap-1 text-sm text-gray-600 dark:text-gray-400">
        Give us
        <a href="javascript:void()" class="text-blue-600 hover:underline" x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            Feedback
        </a>
    </p>
    @if (session('status') === 'feedback-created')
    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
        class="text-sm text-green-600 dark:text-green-400 flex flex-row items-center my-2 justify-center">
        <x-heroicon-o-check class="h-5 w-5" />
        {{ __('Feedback Berhasil Dikirim.') }}
    </p>
    @endif
    
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Berikan Feedback Anda!
            </h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" x-on:click="$dispatch('close')">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <form method="post" action="{{route('feedback.store')}}" class="p-6">
            @csrf
            <p>Bantu kami agar dapat membuat aplikasi lebih baik.</p>
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
            <div class="grid gap-4 mb-4 grid-cols-2 mt-2">
                <div class="col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subjek</label>
                    <input type="text" name="subjek" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ketik Judul Subjek" required="">
                </div>
                
                <div class="col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                    <textarea name="deskripsi" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ketik Deskripsi Feedback"></textarea>                    
                </div>
            </div>
            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <x-heroicon-o-paper-airplane class="w-5 h-5 rotate-45 nl-1"/>
                Kirim
            </button>
        </form>
    </x-modal>
    @endif
    @endauth
    <p class="flex items-center justify-center gap-1 text-sm text-gray-600 dark:text-gray-400">
        <span>Made with</span>

        <span>
            <x-heroicon-s-heart class="w-6 h-6 text-red-500" />
        </span>

        <span>by</span>

        <a href="https://github.com/DhafinQ" target="_blank" class="hover:underline">
            Dhafin Qinthara Khalish
        </a>
    </p>


</footer>

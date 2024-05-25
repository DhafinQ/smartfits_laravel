<x-app-layout>

    <x-slot name="header">
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{route('feedback.index')}}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <x-heroicon-o-chat-alt class="w-4 h-4 mr-1"/>
                        Feedback
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
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Detail Feedback</a>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="flex flex-row justify-between">
                <div class="flex flex-row items-center mb-4">
                    <x-heroicon-o-chat-alt class="w-7 h-7 mr-2" />
                    <span class="">Detail Feedback</span>
                </div>
            </div>
            <x-form.error :messages="$errors->first()" />
            @if (session('status') === 'feedback-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-600 dark:text-green-400 flex flex-row items-center my-2">
                <x-heroicon-o-check class="h-5 w-5" />
                {{ __('Status Feedback Berhasil Diubah.') }}
            </p>
            @endif
            <div class="flex flex-row items-center">
                <table class="w-2/3 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <tbody>
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-3 py-2 w-1/3"><span class="font-bold">Name</span></td>
                            <td class="px-3 py-2 w-2/3">: {{$feedback->user->name}}</td>
                        </tr>
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-3 py-2 w-1/3"><span class="font-bold">Subjek</span></td>
                            <td class="px-3 py-2 w-2/3">: {{$feedback->subjek}}</td>
                        </tr>
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-3 py-2 w-1/3"><span class="font-bold">Keterangan</span></td>
                            <td class="px-3 py-2 w-2/3">: {{$feedback->keterangan}}</td>
                        </tr>
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-3 py-2 w-1/3"><span class="font-bold">Tanggal Submit</span></td>
                            <td class="px-3 py-2 w-2/3">: {{Carbon\Carbon::parse($feedback->created_date)->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y')}}</td>
                        </tr>
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-3 py-2 w-1/3"><span class="font-bold">Status</span></td>
                            <td class="px-3 py-2 w-2/3">
                                <form action="{{route('feedback.update',['feedback' => $feedback->id])}}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="flex flex-row items-start">
                                    <x-form.select id="status" name="status" class="block w-1/3 mr-2">
                                        <option value="" >- Pilih -</option>
                                        <option value="Pending" {{$feedback->status == 'Pending' ? 'selected' : ''}}>Pending</option>
                                        <option value="Urgent" {{$feedback->status == 'Urgent' ? 'selected' : ''}}>Urgent</option>
                                        <option value="Proses" {{$feedback->status == 'Proses' ? 'selected' : ''}}>Proses</option>
                                        <option value="Selesai" {{$feedback->status == 'Selesai' ? 'selected' : ''}}>Selesai</option>
                                    </x-form.select>
                                    <x-button style="display: none" id="btnSubmit"> Update </x-button>
                                </div>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <x-heroicon-o-chat-alt-2 class="w-1/4 text-gray-700 bg-gray-50 dark:bg-gray-800 dark:text-gray-50 rounded-md stroke-1 ml-10"/>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.getElementById("status").addEventListener("change", function() {
            var selectedValue = this.value;
            var submitBtn = document.getElementById("btnSubmit");
        
            submitBtn.style.display = "block";

            if (selectedValue === "{{$feedback->status}}") {
                submitBtn.style.display = "none";
            }
        });
        </script>
    @endpush
</x-app-layout>

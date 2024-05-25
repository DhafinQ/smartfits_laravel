<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Feedback') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="flex flex-row justify-between">
                <div class="flex flex-row items-center mb-4">
                    <x-heroicon-o-user-group class="w-7 h-7 mr-2" />
                    <span class="">List Feedback</span>
                </div>
                <form action="{{route('feedback.index')}}" method="get">
                <div class="flex flex-row items-center justify-end mb-4">
                        <x-form.input
                        id="subject"
                        name="subject"
                        type="text"
                        class="block w-2/3 mr-2"
                        placeholder="Search Subject..."
                        />
                        <x-button :variant="'success'" type="submit">
                            <x-heroicon-o-search class="w-6 h-6"/>
                        </x-button>
                    </div>
                </form>
            </div>
            <div >
                @if (session('status') === 'feedback-deleted')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-green-600 dark:text-green-400 flex flex-row items-center my-2">
                        <x-heroicon-o-check class="h-5 w-5" />
                        {{ __('Feedback Berhasil Dihapus.') }}
                    </p>
                @elseif(session('status') === 'user-delete-error')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-red-600 dark:text-red-400 flex flex-row items-center my-2">
                        <x-heroicon-o-check class="h-5 w-5" />
                        {{ __('Feedback Gagal Dihapus.') }}
                    </p>
                @endif
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-3 py-2">Subjek</th>
                        <th scope="col" class="px-3 py-2">Nama</th>
                        <th scope="col" class="px-3 py-2">Status</th>
                        <th scope="col" class="px-3 py-2">Tanggal</th>
                        <th scope="col" class="px-3 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                        @if ($feedbacks->first())
                        @foreach ($feedbacks as $key => $feedback)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-3 py-2 w-1/3">{{$feedback->subjek}}</td>
                            <td class="px-3 py-2 w-1/5">{{$feedback->user->name}}</td>
                            <td class="px-3 py-2 w-1/6"><span class="@if($feedback->status == "Pending") bg-gray-600 @elseif($feedback->status == "Urgent") bg-red-600 @elseif($feedback->status == "Proses") bg-yellow-600 @elseif($feedback->status == "Selesai") bg-green-600 @endif text-white px-2 py-1 rounded-md">{{$feedback->status}}</span></td>
                            <td class="px-3 py-2 w-1/6">{{Carbon\Carbon::parse($feedback->created_at)->format('Y-m-d')}}</td>
                            <td class="px-3 py-2 w-1/5">
                                <div class="flex flex-row items-center space-x-2 justify-center">
                                    <x-button href="{{ route('feedback.show', ['feedback' => $feedback->id]) }}"
                                        size="sm" variant="success">
                                        <x-heroicon-s-eye aria-hidden="true" class="w-4 h-4" />
                                    </x-button>
                                    <x-button variant="danger" x-data="" size="sm"
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-feedback-deletion_{{ $key }}')">
                                    <x-heroicon-s-trash aria-hidden="true" class="w-4 h-4" />
                                </x-button>

                                <x-modal name="confirm-feedback-deletion_{{ $key }}" focusable>
                                    <form method="post"
                                        action="{{ route('feedback.destroy', ['feedback' => $feedback->id]) }}"
                                        class="p-6">
                                        @csrf
                                        @method('delete')

                                        <h2 class="text-lg font-medium">
                                            {{ __('Anda yakin untuk menghapus feedback?') }}
                                        </h2>

                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            {{ __('Setelah penghapusan, semua data feedback akan terhapus.') }}
                                        </p>

                                        <div class="mt-6 flex justify-end">
                                            <x-button type="button" variant="secondary"
                                                x-on:click="$dispatch('close')">
                                                {{ __('Batal') }}
                                            </x-button>

                                            <x-button variant="danger" class="ml-3">
                                                {{ __('Hapus') }}
                                            </x-button>
                                        </div>
                                    </form>
                                </x-modal>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="bg-white dark:bg-gray-900 ">
                            <td colspan="5" class="text-center px-3 py-2">Belum Terdapat Feedback.

                            </td>
                        </tr>
                        @endif
                        
                </tbody>
            </table>
            
        </div>
    </div>
</x-app-layout>

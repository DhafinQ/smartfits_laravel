<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="flex flex-row justify-between">
                <div class="flex flex-row items-center mb-4">
                    <x-heroicon-o-user-group class="w-7 h-7 mr-2" />
                    <span class="">List User</span>
                </div>
                <form action="{{route('users.index')}}" method="get">
                <div class="flex flex-row items-center justify-end mb-4">
                        <x-form.input
                        id="name"
                        name="name"
                        type="text"
                        class="block w-2/3 mr-2"
                        placeholder="Search Name..."
                        />
                        <x-button :variant="'success'" type="submit">
                            <x-heroicon-o-search class="w-6 h-6"/>
                        </x-button>
                    </div>
                </form>
            </div>
            <div class="flex flex-row justify-end mb-4">
                <x-button href="{{ route('users.create')}}"
                    size="sm" variant="success">
                    <x-heroicon-s-plus aria-hidden="true" class="w-4 h-4 mr-2" />
                    Tambah User
                </x-button>
            </div>
            <div >
                @if (session('status') === 'user-deleted')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-green-600 dark:text-green-400 flex flex-row items-center my-2">
                        <x-heroicon-o-check class="h-5 w-5" />
                        {{ __('Data User Berhasil Dihapus.') }}
                    </p>
                @elseif(session('status') === 'user-delete-error')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-red-600 dark:text-red-400 flex flex-row items-center my-2">
                        <x-heroicon-o-check class="h-5 w-5" />
                        {{ __('Data User Gagal Dihapus.') }}
                    </p>
                @endif
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-3 py-2">Nama</th>
                        <th scope="col" class="px-3 py-2">Email</th>
                        <th scope="col" class="px-3 py-2">Role</th>
                        <th scope="col" class="px-3 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->first())
                    @foreach ($users as $key=> $user)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td class="px-3 py-2 w-1/3">{{$user->name}}</td>
                        <td class="px-3 py-2 w-1/5">{{$user->email}}</td>
                        <td class="px-3 py-2 w-1/4">{{$user->role}}</td>
                        <td class="px-3 py-2">
                            <div class="flex flex-row items-center space-x-2 justify-center">
                                <x-button href="{{route('users.show', ['user' => $user->id])}}"
                                    size="sm" variant="info">
                                    <x-heroicon-s-eye aria-hidden="true" class="w-4 h-4" />
                                </x-button>
                                <x-button href="{{ route('users.edit', ['user' => $user->id]) }}"
                                    size="sm" variant="warning">
                                    <x-heroicon-s-pencil aria-hidden="true" class="w-4 h-4" />
                                </x-button>
                                <x-button variant="danger" x-data="" size="sm"
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-jadwalpagi-deletion_{{ $key }}')">
                                    <x-heroicon-s-trash aria-hidden="true" class="w-4 h-4" />
                                </x-button>

                                <x-modal name="confirm-jadwalpagi-deletion_{{ $key }}" focusable>
                                    <form method="post"
                                        action="{{ route('users.delete', ['user' => $user->id]) }}"
                                        class="p-6">
                                        @csrf
                                        @method('delete')

                                        <h2 class="text-lg font-medium">
                                            {{ __('Anda yakin untuk menghapus user?') }}
                                        </h2>

                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            {{ __('Setelah penghapusan, semua data user akan terhapus.') }}
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
                        <td colspan="4" class="text-center px-3 py-2">Tidak ada user.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            
        </div>
    </div>
</x-app-layout>

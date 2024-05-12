<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-bold leading-tight flex flex-row items-center">
                <x-heroicon-o-clock class="w-7 h-7 mr-2" />
                {{ __('Jadwal Makan') }}
            </h2>
            <div class="flex flex-row items-center">
                <span class="text-md font-semibold mr-2">Tanggal Jadwal :</span>
                <x-form.input id="tgl_note" class="block w-44 dark:[color-scheme:dark]" name="tgl_note"
                    placeholder="{{ request()->jadwal ?? 'Hari Ini' }}"
                    onfocus="(this.type='date', this.value='{{ request()->jadwal ?? now()->format('Y-m-d') }}')"
                    onblur="(this.type='text')"
                    onchange="(window.location = '{{ route('foodnote.index') }}/' + this.value)" />
            </div>
        </div>
        <div>
            @if (session('status') === 'foodnote-deleted')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400 flex flex-row items-center">
                    <x-heroicon-o-check class="h-5 w-5" />
                    {{ __('Jadwal Makan Berhasil Dihapus.') }}
                </p>
            @elseif(session('status') === 'foodnote-delete-error')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-red-600 dark:text-red-400 flex flex-row items-center">
                    <x-heroicon-o-check class="h-5 w-5" />
                    {{ __('Jadwal Makan Gagal Dihapus.') }}
                </p>
            @endif
        </div>
    </x-slot>



    <div class="flex-row flex">
        <div class="grid w-2/3 gap-4">
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 max-h-64">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-2">
                    <div class="flex flex-row items-center">
                        <x-heroicon-o-star class="w-5 h-5 mr-2" stroke="#FF9800" />
                        <span class="font-semibold">Makan Pagi</span>
                    </div>
                    <x-button
                        href="{{ route('foodnote.create', ['kategori' => 'pagi', 'jadwal' => request()->jadwal ?? '']) }}"
                        size="sm">
                        <x-heroicon-o-plus-circle aria-hidden="true" class="w-4 h-4 mr-1" />
                        Tambah
                    </x-button>
                </div>
                <div class="relative overflow-x-auto overflow-y-auto shadow-md sm:rounded-lg max-h-44">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-3 py-2">Makanan</th>
                                <th scope="col" class="px-3 py-2">Qty</th>
                                <th scope="col" class="px-3 py-2">Kalori</th>
                                <th scope="col" class="px-3 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($makanPagi->first())
                                @foreach ($makanPagi as $key=>$m)
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <td class="px-3 py-2 w-1/3">{{ $m->nama_makanan }}</td>
                                        <td class="px-3 py-2 w-1/5">{{ $m->qty . ' ' . $m->satuan }}</td>
                                        <td class="px-3 py-2 w-1/4">{{ $m->kalori }} KKal</td>
                                        <td class="px-3 py-2">
                                            <div class="flex flex-row items-center space-x-2 justify-center">
                                                <x-button href="{{ route('foodnote.edit', ['foodNote' => $m->id]) }}"
                                                    size="sm" variant="warning">
                                                    <x-heroicon-s-pencil aria-hidden="true" class="w-4 h-4" />
                                                </x-button>
                                                <x-button variant="danger" x-data="" size="sm"
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-jadwalpagi-deletion_{{ $key }}')">
                                                    <x-heroicon-s-trash aria-hidden="true" class="w-4 h-4" />
                                                </x-button>

                                                <x-modal name="confirm-jadwalpagi-deletion_{{ $key }}" focusable>
                                                    <form method="post"
                                                        action="{{ route('foodnote.delete', ['foodNote' => $m->id]) }}"
                                                        class="p-6">
                                                        @csrf
                                                        @method('delete')

                                                        <h2 class="text-lg font-medium">
                                                            {{ __('Anda yakin untuk menghapus jadwal makan?') }}
                                                        </h2>

                                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                            {{ __('Setelah penghapusan, semua data jadwal makan akan hilang.') }}
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
                                    <td colspan="4" class="text-center px-3 py-2">Jadwal Makan Kosong</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 max-h-64">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-2">
                    <div class="flex flex-row items-center">
                        <x-heroicon-o-sun class="w-6 h-6 mr-1.5" stroke="#FF9800" />
                        <span class="font-semibold">Makan Siang</span>
                    </div>
                    <x-button href="{{ route('foodnote.create', ['kategori' => 'siang']) }}" size="sm">
                        <x-heroicon-o-plus-circle aria-hidden="true" class="w-4 h-4 mr-1" />
                        Tambah
                    </x-button>
                </div>
                <div class="relative overflow-x-auto overflow-y-auto shadow-md sm:rounded-lg max-h-44">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-3 py-2">Makanan</th>
                                <th scope="col" class="px-3 py-2">Qty</th>
                                <th scope="col" class="px-3 py-2">Kalori</th>
                                <th scope="col" class="px-3 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($makanSiang->first())
                                @foreach ($makanSiang as $key => $m)
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <td class="px-3 py-2 w-1/3">{{ $m->nama_makanan }}</td>
                                        <td class="px-3 py-2 w-1/5">{{ $m->qty . ' ' . $m->satuan }}</td>
                                        <td class="px-3 py-2 w-1/4">{{ $m->kalori }} KKal</td>
                                        <td class="px-3 py-2">
                                            <div class="flex flex-row items-center space-x-2 justify-center">
                                                <x-button href="{{ route('foodnote.edit', ['foodNote' => $m->id]) }}"
                                                    size="sm" variant="warning">
                                                    <x-heroicon-s-pencil aria-hidden="true" class="w-4 h-4" />
                                                </x-button>

                                                <x-button variant="danger" x-data="" size="sm"
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-jadwalsiang-deletion_{{ $key }}')">
                                                    <x-heroicon-s-trash aria-hidden="true" class="w-4 h-4" />
                                                </x-button>

                                                <x-modal name="confirm-jadwalsiang-deletion_{{ $key }}" focusable>
                                                    <form method="post"
                                                        action="{{ route('foodnote.delete', ['foodNote' => $m->id]) }}"
                                                        class="p-6">
                                                        @csrf
                                                        @method('delete')

                                                        <h2 class="text-lg font-medium">
                                                            {{ __('Anda yakin untuk menghapus jadwal makan?') }}
                                                        </h2>

                                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                            {{ __('Setelah penghapusan, semua data jadwal makan akan hilang.') }}
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
                                    <td colspan="4" class="text-center px-3 py-2">Jadwal Makan Kosong</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 max-h-64">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-2">
                    <div class="flex flex-row items-center">
                        <x-heroicon-o-moon class="w-5 h-5 mr-2" stroke="#FF9800" />
                        <span class="font-semibold">Makan Malam</span>
                    </div>
                    <x-button href="{{ route('foodnote.create', ['kategori' => 'malam']) }}" size="sm">
                        <x-heroicon-o-plus-circle aria-hidden="true" class="w-4 h-4 mr-1" />
                        Tambah
                    </x-button>
                </div>
                <div class="relative overflow-x-auto overflow-y-auto shadow-md sm:rounded-lg max-h-44">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-3 py-2">Makanan</th>
                                <th scope="col" class="px-3 py-2">Qty</th>
                                <th scope="col" class="px-3 py-2">Kalori</th>
                                <th scope="col" class="px-3 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($makanMalam->first())
                                @foreach ($makanMalam as $key=>$m)
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <td class="px-3 py-2 w-1/3">{{ $m->nama_makanan }}</td>
                                        <td class="px-3 py-2 w-1/5">{{ $m->qty . ' ' . $m->satuan }}</td>
                                        <td class="px-3 py-2 w-1/4">{{ $m->kalori }} KKal</td>
                                        <td class="px-3 py-2">
                                            <div class="flex flex-row items-center space-x-2 justify-center">
                                                <x-button href="{{ route('foodnote.edit', ['foodNote' => $m->id]) }}"
                                                    size="sm" variant="warning">
                                                    <x-heroicon-s-pencil aria-hidden="true" class="w-4 h-4" />
                                                </x-button>
                                                <x-button variant="danger" x-data="" size="sm"
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-jadwalmalam-deletion_{{ $key }}')">
                                                <x-heroicon-s-trash aria-hidden="true" class="w-4 h-4" />
                                            </x-button>

                                            <x-modal name="confirm-jadwalmalam-deletion_{{ $key }}" focusable>
                                                <form method="post"
                                                    action="{{ route('foodnote.delete', ['foodNote' => $m->id]) }}"
                                                    class="p-6">
                                                    @csrf
                                                    @method('delete')

                                                    <h2 class="text-lg font-medium">
                                                        {{ __('Anda yakin untuk menghapus jadwal makan?') }}
                                                    </h2>

                                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                        {{ __('Setelah penghapusan, semua data jadwal makan akan hilang.') }}
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
                                    <td colspan="4" class="text-center px-3 py-2">Jadwal Makan Kosong</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


        <div class="ml-3 p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 xl:w-1/3 h-1/4">
            <div class="flex flex-row items-center">
                <x-heroicon-o-chart-pie class="w-7 h-7 mr-1" />
                <span class="">Jumlah Kalori Hari Ini</span>
            </div>
            {!! $donutChart->container() !!}
            <div class="space-x-4 mt-3 text-left">
                <table>
                    <tr>
                        <td class="w-14">Target</td>
                        <td class='px-1'>:</td>
                        <td class="text-right"><span
                                class="font-semibold">{{ Auth::user()->customer->getCalories() }} Kkal</span></td>
                    </tr>
                    <tr>
                        <td class="w-14">Total</td>
                        <td class='px-1'>:</td>
                        <td class="text-right"><span class="font-semibold">{{ $totalKal }} Kkal</span></td>
                    </tr>
                    <tr class="border-t border-gray-700 dark:border-gray-300">
                        <td class="w-14">Sisa</td>
                        <td class='px-1'>:</td>
                        <td class="text-right"><span
                                class="font-semibold">{{ Auth::user()->customer->getCalories() - $totalKal > 0 ? Auth::user()->customer->getCalories() - $totalKal : '0' }}
                                Kkal</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        {!! $donutChart->script() !!}
    @endpush
</x-app-layout>

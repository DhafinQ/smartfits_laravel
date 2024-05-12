<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Informasi Makanan') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ (!empty($foodNote) ? 'Edit' : 'Tambah') . (" Menu Makan ") . ucfirst($kategori) . (" Sesuai Yang Anda Rencanakan.") }}
        </p>
    </header>
    </form>

    <form
        method="post"
        action="{{!empty($foodNote) ? route('foodnote.update', ['foodNote' => $foodNote->id]) : route('foodnote.store', ['kategori' => $kategori])  }}"
        class="mt-6 space-y-6"
    >
        @csrf
        @if (!empty($foodNote))
            @method('PATCH')
        @endif
        <input type="hidden" name="tgl_note" value="{{$jadwal ?? request()->jadwal ?? now()->format('Y-m-d')}}">
        <div class="space-y-2">
            <x-form.label
                for="nama_makanan"
                :value="__('Nama Makanan')"
            />

            <x-form.input
                id="nama_makanan"
                name="nama_makanan"
                type="text"
                class="block w-2/3"
                :value="old('nama_makanan', (!empty($foodNote) ? $foodNote->nama_makanan : ''))"
                    autocomplete="nama_makanan"
            />

            <x-form.error :messages="$errors->get('nama_makanan')" />
        </div>

        <div class="space-y-2">
            <x-form.label
                for="kalori"
                :value="__('Jumlah Kalori per Porsi (Kkal)')"
            />

            <x-form.input
                id="kalori"
                name="kalori"
                type="number"
                class="block w-1/3"
                :value="old('kalori',(!empty($foodNote) ? ($foodNote->kalori/$jmlh) : ''))"
                autocomplete="kalori"
            />

            <x-form.error :messages="$errors->get('kalori')" />

            
        </div>

        <div class="space-y-2">
            <x-form.label
                for="qty"
                :value="__('Jumlah Porsi')"
            />

            <x-form.input
                id="porsi"
                name="porsi"
                type="number"
                class="block w-1/3"
                :value="old('porsi',(!empty($foodNote) ? $jmlh : ''))"
                autocomplete="porsi"
            />

            <x-form.error :messages="$errors->get('porsi')" />

            
        </div>

        <div class="space-y-2">
            <x-form.label
                for="satuan"
                :value="__('Satuan Porsi')"
            />

            <x-form.select id="satuan" name="satuan" class="block w-2/3">
                <option value="">- Pilih -</option>
                <option value="Mangkuk" {{old('satuan',(!empty($foodNote) ? ($satuan == 'Mangkuk' ? 'selected' : '') : ''))}}>Mangkuk</option>
                <option value="Piring" {{old('satuan',(!empty($foodNote) ? ($satuan == 'Piring' ? 'selected' : '') : ''))}}>Piring</option>
                <option value="Gelas" {{old('satuan',(!empty($foodNote) ? ($satuan == 'Gelas' ? 'selected' : '') : ''))}}>Gelas</option>
                <option value="Potong" {{old('satuan',(!empty($foodNote) ? ($satuan == 'Potong' ? 'selected' : '') : ''))}}>Potong</option>
                <option value="Biji" {{old('satuan',(!empty($foodNote) ? ($satuan == 'Biji' ? 'selected' : '') : ''))}}>Biji</option>
            </x-form.select>

            <x-form.error :messages="$errors->get('satuan')" />

            
        </div>

        <div class="flex items-center gap-4">
            <x-button :variant="!empty($foodNote) ? 'warning' : 'success'">
                {{ !empty($foodNote) ? 'Edit' : 'Tambah' }}
            </x-button>

            @if (session('status') === 'foodnote-created')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400 flex flex-row items-center"
                >
                    <x-heroicon-o-check class="h-5 w-5"/>
                    {{ __('Jadwal Makan Berhasil Ditambah.') }}
                </p>
            @elseif(session('status') === 'foodnote-updated')
            <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400 flex flex-row items-center"
                >
                    <x-heroicon-o-check class="h-5 w-5"/>
                    {{ __('Jadwal Makan Berhasil Diubah.') }}
                </p>
            @endif
        </div>
    </form>
</section>

<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Informasi User') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            @if (!empty($L_user->name))
                {{'Update Profile User Sesuai Data Yang Anda Ingin Diubah.'}}
            @else
                {{'Buat Profile User Sesuai Data Yang Anda Ingin Buat.'}}
            @endif
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ !empty($L_user->name) ? route('users.update', ['user' => $L_user->id]) : route('users.store') }}" class="mt-6 space-y-6">
        @csrf
        @if (!empty($L_user->name))
            @method('PATCH')
        @endif
        <div class="space-y-2">
            <x-form.label for="name" :value="__('Name')" />

            <x-form.input id="name" name="name" type="text" class="block w-full" :value="old('name', !empty($L_user->name) ? $L_user->name :  '')"
                autofocus autocomplete="name" />

            <x-form.error :messages="$errors->get('name')" />
        </div>

        <div class="space-y-2">
            <x-form.label for="email" :value="__('Email')" />


            <x-form.input id="email" name="email" type="email" class="block w-full" :value="old('email', !empty($L_user->email) ? $L_user->email :  '')"
                autocomplete="email" />

            <x-form.error :messages="$errors->get('email')" />

        </div>

        @if (empty($L_user->name))
        <div class="space-y-2">
            <x-form.label
                for="password"
                :value="__('Password')"
            />

            <x-form.input
                id="password"
                name="password"
                type="password"
                class="block w-full"
                autocomplete="new-password"
            />

            <x-form.error :messages="$errors->get('password')" />
            
        </div>

        <div class="space-y-2">
            <x-form.label
                for="password_confirmation"
                :value="__('Confirm Password')"
            />

            <x-form.input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="block w-full"
                autocomplete="new-password"
            />

            <x-form.error :messages="$errors->updatePassword->get('password_confirmation')" />
                
        </div>
        @endif

        <div class="space-y-2">
            <x-form.label
                for="role"
                :value="__('Role')"
            />
            <x-form.select id="role" name="role" class="block w-1/2">
                <option value="">- Pilih -</option>
                <option value="admin" @if(old('role') == 'admin') selected @elseif(!empty($L_user->role) && $L_user->role == 'admin') selected @endif>Admin</option>
                <option value="client" @if(old('role') == 'client') selected @elseif(!empty($L_user->role) && $L_user->role == 'client') selected @endif>Client</option>
            </x-form.select>

            <x-form.error :messages="$errors->get('role')" />
            <p class="text-yellow-600 text-sm" id="warnText" style="display: none">Peringatan : Perubahan Role Akan Menghapus Semua Catatan Makanan Customer.</p>
        </div>

        <div id="clientProfile" style="@if(old('role') == 'admin') display: none @elseif(old('role') == 'client') display: block;  @elseif(!empty($L_user->name) && $L_user->role == 'client') display: block @else display: none @endif">
            <div class="space-y-2 mb-4">
                <x-form.label for="tgl_lahir" :value="__('Tanggal Lahir')" />
                <x-form.input id="tgl_lahir" class="block w-1/3 dark:[color-scheme:dark]" type="date" name="tgl_lahir"
                    value="{{ old('tgl_lahir', !empty($L_user->customer->tgl_lahir) ? Carbon\Carbon::parse($L_user->customer->tgl_lahir)->format('Y-m-d') : '') }}" />
    
                <x-form.error :messages="$errors->get('tgl_lahir')" />
            </div>
            <div class="my-1">
                <x-form.label for="jekel" class="mb-1" :value="__('Jenis Kelamin')" />
    
                <x-form.radio-selectbox id="gender_laki" type="radio" name="jekel" value="Laki-Laki"
                    :checked="(old('jekel') == 'Laki-Laki' || (!empty($L_user->customer->jekel) && $L_user->customer->jekel == 'Laki-Laki')) ? true : false" />
                <span>Laki-Laki</span>
                <br>
                <x-form.radio-selectbox id="gender_perempuan" type="radio" name="jekel" value="Perempuan"
                    :checked="(old('jekel') == 'Perempuan' || (!empty($L_user->customer->jekel) && $L_user->customer->jekel == 'Perempuan')) ? true : false" />
                <span>Perempuan</span>
    
    
                <x-form.error :messages="$errors->get('jekel')" />
            </div>
            <!-- Tipe Aktivitas -->
            <div class="space-y-2 mt-4">
                <x-form.label for="tipe_aktivitas" :value="__('Tipe Aktivitas')" />
                <x-form.select id="tipe_aktivitas" name="tipe_aktivitas" class="block w-1/2">
                    <option value="" >- Pilih -</option>
                    <option value="Sangat Aktif" @if(old('tipe_aktivitas') == 'Sangat Aktif') selected @elseif(!empty($L_user->customer->tipe_aktivitas) && $L_user->customer->tipe_aktivitas == 'Sangat Aktif') selected @endif>Sangat Aktif</option>
                    <option value="Aktif" @if(old('tipe_aktivitas') == 'Aktif') selected @elseif(!empty($L_user->customer->tipe_aktivitas) && $L_user->customer->tipe_aktivitas == 'Aktif') selected @endif>Aktif</option>
                    <option value="Sedikit Aktif" @if(old('tipe_aktivitas') == 'Sedikit Aktif') selected @elseif(!empty($L_user->customer->tipe_aktivitas) && $L_user->customer->tipe_aktivitas == 'Sedikit Aktif') selected @endif>Sedikit Aktif</option>
                </x-form.select>
                <x-form.error :messages="$errors->get('tipe_aktivitas')" />
            </div>
        </div>



        <div class="flex items-center gap-4">
            <x-button>
                {{ __('Save') }}
            </x-button>

            @if (session('status') === 'user-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-600 dark:text-green-400">
                    {{ __('User Berhasil Diubah.') }}
                </p>
            @endif
        </div>
    </form>
</section>

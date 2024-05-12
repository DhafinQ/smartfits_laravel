<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Informasi User') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update Profile Akun Sesuai Data Yang Anda Miliki.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="space-y-2">
            <x-form.label for="name" :value="__('Name')" />

            <x-form.input id="name" name="name" type="text" class="block w-full" :value="old('name', $user->name)"
                autofocus autocomplete="name" />

            <x-form.error :messages="$errors->get('name')" />
        </div>

        <div class="space-y-2">
            <x-form.label for="email" :value="__('Email')" />

            <x-form.input id="email" name="email" type="email" class="block w-full" :value="old('email', $user->email)"
                autocomplete="email" />

            <x-form.error :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-300">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500  dark:text-gray-400 dark:hover:text-gray-200 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="space-y-2">
            <x-form.label for="tgl_lahir" :value="__('Tanggal Lahir')" />
            <x-form.input id="tgl_lahir" class="block w-1/3 dark:[color-scheme:dark]" type="date" name="tgl_lahir"
                value="{{ Carbon\Carbon::parse($user->customer->tgl_lahir)->format('Y-m-d') }}" />

            <x-form.error :messages="$errors->get('tgl_lahir')" />
        </div>

        <div class="my-1">
            <x-form.label for="jekel" class="mb-1" :value="__('Jenis Kelamin')" />

            <x-form.radio-selectbox id="gender_laki" type="radio" name="jekel" value="Laki-Laki"
                :checked="$user->customer->jekel == 'Laki-Laki' ? true : false" />
            <span>Laki-Laki</span>
            <br>
            <x-form.radio-selectbox id="gender_perempuan" type="radio" name="jekel" value="Perempuan"
                :checked="$user->customer->jekel == 'Perempuan' ? true : false" />
            <span>Perempuan</span>


            <x-form.error :messages="$errors->get('jekel')" />
        </div>

        <!-- Tipe Aktivitas -->
        <div class="space-y-2">
            <x-form.label for="tipe_aktivitas" :value="__('Tipe Aktivitas')" />
            <x-form.select id="tipe_aktivitas" name="tipe_aktivitas" class="block w-1/2">
                <option value="" >- Pilih -</option>
                <option value="Sangat Aktif" {{$user->customer->tipe_aktivitas == 'Sangat Aktif' ? 'selected' : ''}}>Sangat Aktif</option>
                <option value="Aktif" {{$user->customer->tipe_aktivitas == 'Aktif' ? 'selected' : ''}}>Aktif</option>
                <option value="Sedikit Aktif" {{$user->customer->tipe_aktivitas == 'Sedikit Aktif' ? 'selected' : ''}}>Sedikit Aktif</option>
            </x-form.select>
            <p class="space-y-2 text-gray-400 text-justify" id="text_aktivitas1" style="{{$user->customer->tipe_aktivitas == 'Sedikit Aktif' ? '' : 'display:none;'}}">
                {{ __('Kegiatan sehari-hari yang membutuhkan upaya seperti berdiri secara berkala, pekerjaaan rumah, atau latihan ringan') }}
            </p>
            <p class="space-y-2 text-gray-400 text-justify" id="text_aktivitas2" style="{{$user->customer->tipe_aktivitas == 'Aktif' ? '' : 'display:none;'}}">
                {{ __('Kegiatan sehari-hari yang membutuhkan upaya yang wajar seperti berdiri, kerja fisik, olahraga secara teratur') }}
            </p>
            <p class="space-y-2 text-gray-400 text-justify" id="text_aktivitas3" style="{{$user->customer->tipe_aktivitas == 'Sangat Aktif' ? '' : 'display:none;'}}">
                {{ __('Kegiatan sehari-hari yang membutuhkan upaya fisik yang tinggi seperti pekerjaan kontruksi atau olahraga berat secara teratur') }}
            </p>
        </div>

        <div class="flex items-center gap-4">
            <x-button>
                {{ __('Save') }}
            </x-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>

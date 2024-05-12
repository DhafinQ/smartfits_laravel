<x-guest-layout>
    <x-auth-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="grid gap-6">
                <!-- Name -->
                <div class="space-y-2">
                    <x-form.label
                        for="name"
                        :value="__('Name')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="name"
                            class="block w-full"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus
                            placeholder="{{ __('Name') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Email Address -->
                <div class="space-y-2">
                    <x-form.label
                        for="email"
                        :value="__('Email')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="email"
                            class="block w-full"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            placeholder="{{ __('Email') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <x-form.label
                        for="password"
                        :value="__('Password')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="password"
                            class="block w-full"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="{{ __('Password') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <x-form.label
                        for="password_confirmation"
                        :value="__('Confirm Password')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="password_confirmation"
                            class="block w-full"
                            type="password"
                            name="password_confirmation"
                            required
                            placeholder="{{ __('Confirm Password') }}"
                        />
                    </x-form.input-with-icon-wrapper>

                </div>

                <div class="space-y-2">
                    <x-form.label
                        for="tgl_lahir"
                        :value="__('Tanggal Lahir')"
                    />
                    <x-form.input
                        id="tgl_lahir"
                        class="block w-full dark:[color-scheme:dark]"
                        type="date"
                        name="tgl_lahir"
                        required
                    />

                </div>

                <div class="my-1">
                    <x-form.label 
                        for="jenis_kelamin"
                        class="mb-1"
                        :value="__('Jenis Kelamin')"
                    />

                    <x-form.radio-selectbox
                            id="gender_laki"
                            type="radio"
                            name="jenis_kelamin"
                            value="Laki-Laki"
                            />
                    <span>Laki-Laki</span>  
                    <br>
                    <x-form.radio-selectbox
                            id="gender_perempuan"
                            type="radio"
                            name="jenis_kelamin"
                            value="Perempuan"
                            />
                    <span>Perempuan</span>
                </div>
                
                <!-- Tipe Aktivitas -->
                <div class="space-y-2">
                    <x-form.label
                        for="tipe_aktivitas"
                        :value="__('Tipe Aktivitas')"
                    />
                    <x-form.select id="tipe_aktivitas" name="tipe_aktivitas" class="block w-full">
                        <option value="">- Pilih -</option>
                        <option value="Sangat Aktif">Sangat Aktif</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Sedikit Aktif">Sedikit Aktif</option>
                    </x-form.select>
                    <p class="space-y-2 text-gray-400 text-justify" id="text_aktivitas1" style="display: none">
                        {{ __('Kegiatan sehari-hari yang membutuhkan upaya seperti berdiri secara berkala, pekerjaaan rumah, atau latihan ringan') }}
                    </p>
                    <p class="space-y-2 text-gray-400 text-justify" id="text_aktivitas2" style="display: none">
                        {{ __('Kegiatan sehari-hari yang membutuhkan upaya yang wajar seperti berdiri, kerja fisik, olahraga secara teratur') }}
                    </p>
                    <p class="space-y-2 text-gray-400 text-justify" id="text_aktivitas3" style="display: none">
                        {{ __('Kegiatan sehari-hari yang membutuhkan upaya fisik yang tinggi seperti pekerjaan kontruksi atau olahraga berat secara teratur') }}
                    </p>
                </div>

                


                <div>
                    <x-button class="justify-center w-full gap-2">
                        <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />

                        <span>{{ __('Register') }}</span>
                    </x-button>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Already registered?') }}
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">
                        {{ __('Login') }}
                    </a>
                </p>
            </div>
        </form>
    </x-auth-card>
    @push('scripts')
    <script src="{{URL::asset ('js/register.js')}}"></script>
    @endpush
</x-guest-layout>


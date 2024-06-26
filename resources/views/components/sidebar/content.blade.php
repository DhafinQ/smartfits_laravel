<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>

    <x-sidebar.link
        title="Dashboard"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')"
    >
        <x-slot name="icon">
            <x-heroicon-o-home class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    @if (checkRole())
    <x-sidebar.link
        title="Users"
        href="{{ route('users.index') }}"
        :isActive="request()->routeIs('users.index') || request()->routeIs('users.edit') || request()->routeIs('users.show') || request()->routeIs('users.create')"
    >
        <x-slot name="icon">
            <x-heroicon-o-user-group class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    <x-sidebar.link
        title="Feedback"
        href="{{ route('feedback.index') }}"
        :isActive="Str::startsWith(request()->route()->uri(), 'feedback')"
    >
        <x-slot name="icon">
            <x-heroicon-o-chat-alt class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    @else
    <x-sidebar.link
        title="Jadwal Makan"
        href="{{ route('foodnote.index') }}"
        :isActive="request()->routeIs('foodnote.index') || request()->routeIs('foodnote.create')"
    >
        <x-slot name="icon">
            <x-heroicon-o-clock class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    @endif
    

    @if (checkRole())
    <x-sidebar.link
        title="Profile"
        href="{{ route('profile.edit') }}"
        :isActive="request()->routeIs('profile.edit')"
    >
        <x-slot name="icon">
            <x-heroicon-o-user-circle class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    @else
    <x-sidebar.dropdown
        title="User"
        :active="Str::startsWith(request()->route()->uri(), 'profile')"
    >
        <x-slot name="icon">
            <x-heroicon-o-user class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Profile"
            href="{{ route('profile.edit') }}"
            :active="request()->routeIs('profile.edit')"
        />
        <x-sidebar.sublink
            title="Plan"
            href="{{ route('profile.plan') }}"
            :active="request()->routeIs('profile.plan')"
        />
    </x-sidebar.dropdown>
    @endif
    

    {{-- <div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="text-sm text-gray-500"
    >
        Support
    </div>

    <x-sidebar.link title="FeedBack" href="#" >
        <x-slot name="icon">
            <x-heroicon-o-flag class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link> --}}

</x-perfect-scrollbar>

<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="lni lni-grid-alt"></i>
        </button>
        <div class="sidebar-logo">
            <a href="#">IPBNet</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="{{route('dashboard')}}" class="sidebar-link">
                <i class="lni lni-home"></i>
                <span>Home</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link" data-toggle="modal" data-target="#searchModal">
                <i class="lni lni-search"></i>
                <span>Search</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="fas fa-bell"></i>
                <span>Notification</span>
            </a>
        </li>

        <div class="container">
            <x-dropdown align="right" width="64" contentClasses="py-2 bg-white dark:bg-gray-800 ml-400">
                <x-slot name="trigger">
                    <button @click="hover = !open" class="text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out">
                        <i class="lni lni-plus"></i>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <div>
                        <x-dropdown-link href="#" data-toggle="modal" data-target="#modalPost">Post</x-dropdown-link>
                        <x-dropdown-link href="#" data-toggle="modal" data-target="#modalEvent">Event</x-dropdown-link>
                        <x-dropdown-link href="#" data-toggle="modal" data-target="#modalNews">News</x-dropdown-link>
                    </div>
                </x-slot>
            </x-dropdown>
        </div>
        
        
        <li class="sidebar-item">
            <a href="{{route('profile.edit')}}" class="sidebar-link">
                <i class="fal fa-user"></i>
                <span>Profile</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="lni lni-cog"></i>
                <span>Setting</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="https://wa.me/6282172755847" class="sidebar-link" target="_blank" rel="noopener noreferrer">
            <i class="far fa-address-card"></i>
            <span>Admin</span>
        </a>                
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" class="sidebar-link"
               onclick="event.preventDefault(); this.closest('form').submit();">
                <i class="lni lni-exit"></i>
                <span>{{ __('Log Out') }}</span>
            </a>
        </form>
    </div>
</aside>

@include('components.modal-post')
@include('components.modal-event')
@include('components.modal-news')
@include('components.modal-search')

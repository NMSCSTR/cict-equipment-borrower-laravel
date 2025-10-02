<!-- Sidebar Overlay -->
<div class="sidebar-overlay fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden" style="display: none;"></div>

<!-- Sidebar -->
<div class="sidebar bg-gray-900 text-white w-80 fixed inset-y-0 left-0 z-50 flex flex-col">
    <!-- Header -->
    <div class="p-6 border-b border-gray-700">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center">
                <i class="fas fa-laptop-code text-white text-lg"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold text-white">CICT Equipment</h1>
                <p class="text-gray-400 text-sm">Management System</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2">
        <a href="{{ route('admin.equipment') }}" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 hover:bg-gray-800 hover:text-white {{ request()->is('equipment*') ? 'active bg-gray-800 text-white' : 'text-gray-300' }}">
            <div class="w-6 text-center">
                <i class="fas fa-tools {{ request()->is('equipment*') ? 'text-blue-400' : 'text-gray-400' }}"></i>
            </div>
            <span class="font-medium">Equipment</span>
        </a>

        <a href="{{ url('users.php') }}" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 hover:bg-gray-800 hover:text-white {{ request()->is('users*') ? 'active bg-gray-800 text-white' : 'text-gray-300' }}">
            <div class="w-6 text-center">
                <i class="fas fa-users {{ request()->is('users*') ? 'text-blue-400' : 'text-gray-400' }}"></i>
            </div>
            <span class="font-medium">Users</span>
        </a>

        <a href="{{ url('transaction.php') }}" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 hover:bg-gray-800 hover:text-white {{ request()->is('transaction*') ? 'active bg-gray-800 text-white' : 'text-gray-300' }}">
            <div class="w-6 text-center">
                <i class="fas fa-exchange-alt {{ request()->is('transaction*') ? 'text-blue-400' : 'text-gray-400' }}"></i>
            </div>
            <span class="font-medium">Transactions</span>
        </a>

        <a href="{{ url('request.php') }}" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 hover:bg-gray-800 hover:text-white {{ request()->is('request*') ? 'active bg-gray-800 text-white' : 'text-gray-300' }}">
            <div class="w-6 text-center">
                <i class="fas fa-clipboard-list {{ request()->is('request*') ? 'text-blue-400' : 'text-gray-400' }}"></i>
            </div>
            <span class="font-medium">Requests</span>
            <span class="ml-auto bg-blue-500 text-white text-xs rounded-full px-2 py-1">12</span>
        </a>

        <a href="{{ url('notification.php') }}" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 hover:bg-gray-800 hover:text-white {{ request()->is('notification*') ? 'active bg-gray-800 text-white' : 'text-gray-300' }}">
            <div class="w-6 text-center">
                <i class="fas fa-bell {{ request()->is('notification*') ? 'text-blue-400' : 'text-gray-400' }}"></i>
            </div>
            <span class="font-medium">Notifications</span>
            <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1">3</span>
        </a>
    </nav>

    <!-- User Profile -->
    <div class="p-4 border-t border-gray-700">
        <div class="flex items-center space-x-3 p-3 rounded-xl bg-gray-800">
            <img class="h-10 w-10 rounded-xl object-cover border-2 border-blue-500" src="https://ui-avatars.com/api/?name=Admin+User&background=0D8ABC&color=fff&bold=true" alt="Admin">
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-white truncate">Admin User</p>
                <p class="text-xs text-gray-400 truncate">admin@cict.com</p>
            </div>
            <div class="relative">
                <button id="settingsBtn" class="text-gray-400 hover:text-white transition-colors duration-200 focus:outline-none">
                    <i class="fas fa-cog"></i>
                </button>
                <div id="logoutDropdown" class="hidden absolute right-0 mt-2 w-40 bg-gray-800 rounded-xl shadow-lg z-50">
                    <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="button" id="logoutBtn" class="block w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-xl">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    document.getElementById('settingsBtn').addEventListener('click', function() {
        var dropdown = document.getElementById('logoutDropdown');
        dropdown.classList.toggle('hidden');
    });
    document.addEventListener('click', function(e) {
        var btn = document.getElementById('settingsBtn');
        var dropdown = document.getElementById('logoutDropdown');
        if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
    document.getElementById('logoutBtn').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will be logged out!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    });
</script>
@endpush

@extends("components.default")

@section("title", "Dashboard - CICT Equipment Borrower System")

@section("content")
    @include('components.admin.navbar')
<div class="min-h-screen bg-gray-50 md:ml-80">
    <!-- Top Header -->
    <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
        <div class="flex items-center justify-between px-6 py-4">
            <div class="flex items-center space-x-4">
                <button id="menu-toggle" class="text-gray-500 hover:text-gray-700 md:hidden">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                    <p class="text-gray-500 text-sm">Welcome back, Admin! Here's your overview.</p>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Search Bar -->
                <div class="hidden md:block relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" class="pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64" placeholder="Search...">
                </div>

                <!-- Notifications -->
                <div class="relative">
                    <button class="relative p-2 text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                    </button>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-3">
                    <img class="h-9 w-9 rounded-xl object-cover border-2 border-blue-500" src="https://ui-avatars.com/api/?name=Admin+User&background=0D8ABC&color=fff&bold=true" alt="Admin">
                    <div class="hidden md:block">
                        <p class="text-sm font-semibold text-gray-900">Admin User</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="p-6">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stats-card rounded-2xl border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Equipment</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">142</p>
                        <div class="flex items-center mt-2">
                            <span class="text-green-500 text-sm font-medium flex items-center">
                                <i class="fas fa-arrow-up mr-1 text-xs"></i>
                                12% increase
                            </span>
                            <span class="text-gray-400 text-sm ml-2">from last month</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-tools text-blue-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="stats-card rounded-2xl border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Active Users</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">256</p>
                        <div class="flex items-center mt-2">
                            <span class="text-green-500 text-sm font-medium flex items-center">
                                <i class="fas fa-arrow-up mr-1 text-xs"></i>
                                8% increase
                            </span>
                            <span class="text-gray-400 text-sm ml-2">from last month</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-green-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="stats-card rounded-2xl border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Active Transactions</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">38</p>
                        <div class="flex items-center mt-2">
                            <span class="text-red-500 text-sm font-medium flex items-center">
                                <i class="fas fa-arrow-down mr-1 text-xs"></i>
                                5% decrease
                            </span>
                            <span class="text-gray-400 text-sm ml-2">from last week</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-exchange-alt text-purple-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="stats-card rounded-2xl border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Pending Requests</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">18</p>
                        <div class="flex items-center mt-2">
                            <span class="text-green-500 text-sm font-medium flex items-center">
                                <i class="fas fa-arrow-up mr-1 text-xs"></i>
                                15% increase
                            </span>
                            <span class="text-gray-400 text-sm ml-2">from yesterday</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clipboard-list text-orange-500 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Activity Section -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">


            <!-- Recent Activity -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
                    <a href="#" class="text-blue-500 text-sm font-medium hover:text-blue-700">View All</a>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-exchange-alt text-blue-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Projector borrowed</p>
                            <p class="text-xs text-gray-500">John Doe • 2 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-green-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Request approved</p>
                            <p class="text-xs text-gray-500">Sarah Wilson • 5 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-tools text-purple-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">New equipment added</p>
                            <p class="text-xs text-gray-500">System • Yesterday</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-user-plus text-orange-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">New user registered</p>
                            <p class="text-xs text-gray-500">Michael Brown • 2 days ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & System Status -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Quick Actions</h3>
                <div class="grid grid-cols-2 gap-4">
                    <button class="flex flex-col items-center justify-center p-4 border border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition-all duration-200 group">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mb-2 group-hover:bg-blue-500 transition-colors duration-200">
                            <i class="fas fa-plus text-blue-500 group-hover:text-white"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Add Equipment</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-4 border border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition-all duration-200 group">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mb-2 group-hover:bg-blue-500 transition-colors duration-200">
                            <i class="fas fa-user-plus text-blue-500 group-hover:text-white"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Add User</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-4 border border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition-all duration-200 group">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mb-2 group-hover:bg-blue-500 transition-colors duration-200">
                            <i class="fas fa-clipboard-check text-blue-500 group-hover:text-white"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Process Request</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-4 border border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition-all duration-200 group">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mb-2 group-hover:bg-blue-500 transition-colors duration-200">
                            <i class="fas fa-chart-bar text-blue-500 group-hover:text-white"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">View Reports</span>
                    </button>
                </div>
            </div>

            <!-- System Status -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">System Status</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Server Uptime</span>
                            <span class="text-sm font-medium text-gray-900">99.8%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 99.8%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Database Performance</span>
                            <span class="text-sm font-medium text-gray-900">98%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 98%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Storage Usage</span>
                            <span class="text-sm font-medium text-gray-900">65%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: 65%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Active Sessions</span>
                            <span class="text-sm font-medium text-gray-900">42</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.sidebar-overlay');

        // Mobile menu toggle
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            overlay.style.display = sidebar.classList.contains('active') ? 'block' : 'none';
            document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
        });

        // Close sidebar when clicking overlay
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.style.display = 'none';
            document.body.style.overflow = '';
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('active');
                overlay.style.display = 'none';
                document.body.style.overflow = '';
            }
        });
    });
</script>
    <style>
        .sidebar {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-item {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 24px;
            background: #3b82f6;
            border-radius: 0 2px 2px 0;
        }

        .stats-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
        }
    </style>
@endsection



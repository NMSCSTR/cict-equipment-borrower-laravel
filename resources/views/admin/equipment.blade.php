@extends('components.default')

@section('title', 'Equipment - CICT Equipment Borrower System')

@section('content')
    @include('components.admin.navbar')

    <div class="min-h-screen bg-gray-50 md:ml-80">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center space-x-4">
                    <button id="menu-toggle" class="text-gray-500 hover:text-gray-700 md:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Equipment Management</h1>
                        <p class="text-gray-500 text-sm">Manage all equipment and inventory</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Add Equipment Button -->
                <button id="open-add-modal"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl font-medium transition-colors duration-200 flex items-center space-x-2">
                    <i class="fas fa-plus"></i>
                    <span>Add Equipment</span>
                </button>

                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="p-6">
            <!-- Stats Overview -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Equipment Table -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                <!-- Table Header -->
                <!-- Table -->
                <div class="overflow-x-auto py-4">
                    <table id="equipment-table" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Equipment Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Available</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($equipment as $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->equipment_name }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500 max-w-xs truncate">{{ $item->description }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $item->quantity }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $item->available_quantity }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'Available' => 'bg-green-100 text-green-800',
                                                'Unavailable' => 'bg-red-100 text-red-800',
                                            ];
                                            $statusColor = $statusColors[$item->status] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                            {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <!-- Edit Button -->
                                            <button
                                                class="edit-btn text-blue-600 hover:text-blue-900 transition-colors duration-200"
                                                data-id="{{ $item->id }}" data-name="{{ $item->equipment_name }}"
                                                data-description="{{ $item->description }}"
                                                data-quantity="{{ $item->quantity }}"
                                                data-available="{{ $item->available_quantity }}"
                                                data-status="{{ $item->status }}">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Delete Button -->
                                            <button
                                                class="delete-btn text-red-600 hover:text-red-900 transition-colors duration-200"
                                                data-id="{{ $item->id }}" data-name="{{ $item->equipment_name }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer -->
                <div
                    class="px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="text-sm text-gray-500 mb-4 sm:mb-0">
                        Showing <span id="showing-count">{{ $equipment->count() }}</span> of <span
                            id="total-count">{{ $equipment->count() }}</span> results
                    </div>

                    <!-- Pagination would go here if needed -->
                </div>
            </div>
        </main>
    </div>

    <!-- Edit Equipment Modal -->
    <div id="edit-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Edit Equipment</h3>
            </div>

            <form id="edit-form" action="{{ route('admin.equipment.update') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <input type="hidden" id="edit-id" name="id">

                <div>
                    <label for="edit-name" class="block text-sm font-medium text-gray-700 mb-1">Equipment Name</label>
                    <input type="text" id="edit-name" name="equipment_name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="edit-description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="edit-description" name="description" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="edit-quantity" class="block text-sm font-medium text-gray-700 mb-1">Total
                            Quantity</label>
                        <input type="number" id="edit-quantity" name="quantity"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="edit-available" class="block text-sm font-medium text-gray-700 mb-1">Available
                            Quantity</label>
                        <input type="number" id="edit-available" name="available_quantity"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label for="edit-status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="edit-status" name="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="Available">Available</option>
                        <option value="Unavailable">Unavailable</option>
                    </select>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                    <button type="button" id="cancel-edit"
                        class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium">Cancel</button>
                    <button type="submit" id="save-edit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 font-medium transition-colors duration-200">Save
                        Changes</button>
                </div>
            </form>


        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Delete Equipment</h3>
            </div>

            <div class="p-6">
                <p class="text-gray-600">Are you sure you want to delete <span id="delete-item-name"
                        class="font-semibold"></span>? This action cannot be undone.</p>
            </div>
            <form id="delete-form" method="POST" action="">
                @csrf
                @method('DELETE')
            </form>


            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button type="button" id="cancel-delete"
                    class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium">Cancel</button>
                <button type="button" id="confirm-delete"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 font-medium transition-colors duration-200">Delete</button>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable
            const table = $('#equipment-table').DataTable({
                responsive: true,
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                language: {
                    search: "",
                    searchPlaceholder: "Search equipment...",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "Showing 0 to 0 of 0 entries",
                    infoFiltered: "(filtered from _MAX_ total entries)"
                },
                dom: '<"flex flex-col lg:flex-row lg:items-center lg:justify-between"<"mb-4 lg:mb-0"l><"mb-4 lg:mb-0"f>>rt<"flex flex-col lg:flex-row lg:items-center lg:justify-between"<"mb-4 lg:mb-0"i><"mb-4 lg:mb-0"p>>',
                initComplete: function() {
                    $('.dataTables_filter input').addClass(
                        'pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full lg:w-64'
                    );
                    $('.dataTables_length select').addClass(
                        'border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500'
                    );
                }
            });

            // Update showing count
            table.on('draw', function() {
                const info = table.page.info();
                $('#showing-count').text(info.recordsDisplay);
            });

            // Search functionality
            $('#search-input').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Status filter functionality
            $('#status-filter').on('change', function() {
                const status = this.value;
                if (status) {
                    table.column(4).search(status).draw();
                } else {
                    table.column(4).search('').draw();
                }
            });

            // Edit button functionality
            $(document).ready(function() {
                $('.edit-btn').on('click', function() {
                    const id = $(this).data('id');
                    const name = $(this).data('name');
                    const description = $(this).data('description');
                    const quantity = $(this).data('quantity');
                    const available = $(this).data('available');
                    const status = $(this).data('status');

                    $('#edit-id').val(id);
                    $('#edit-name').val(name);
                    $('#edit-description').val(description);
                    $('#edit-quantity').val(quantity);
                    $('#edit-available').val(available);
                    $('#edit-status').val(status);

                    $('#edit-modal').removeClass('hidden');
                });
            });


            // Delete button functionality
            $('.delete-btn').on('click', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');

                $('#delete-item-name').text(name);
                $('#delete-form').attr('action', '/admin/equipment/' + id);
                $('#delete-modal').removeClass('hidden');
            });

            // Modal close functionality
            $('#cancel-edit, #cancel-delete').on('click', function() {
                $('#edit-modal, #delete-modal').addClass('hidden');
            });

            // Save edit functionality
            $('#save-edit').on('click', function() {
                // Here you would typically make an AJAX call to update the equipment
                const formData = $('#edit-form').serialize();

                // Simulate API call
                console.log('Updating equipment:', formData);

                // Show success message and close modal
                // alert('Equipment updated successfully!');
                $('#edit-modal').addClass('hidden');

                // In a real application, you would refresh the table data
                // table.ajax.reload();
            });

            // Confirm delete functionality
            $('.delete-btn').on('click', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');

                $('#delete-item-name').text(name);
                // Set form action dynamically, e.g. /admin/equipment/{id}
                $('#delete-form').attr('action', `/admin/equipment/${id}`);

                $('#delete-modal').removeClass('hidden');
            });

            $('#confirm-delete').on('click', function() {
                $('#delete-form').submit();
            });


            // Close modals when clicking outside
            $('#edit-modal, #delete-modal').on('click', function(e) {
                if (e.target === this) {
                    $(this).addClass('hidden');
                }
            });
        });
    </script>

    <style>
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            padding: 0.5rem 2.5rem 0.5rem 0.75rem;
            margin-left: 0;
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            padding: 0.5rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            margin: 0 0.125rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #3b82f6;
            color: white !important;
            border-color: #3b82f6;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #e5e7eb;
            border-color: #d1d5db;
        }
    </style>
@endsection

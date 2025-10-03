@extends('components.default')

@section('title', 'Instructor - CICT Equipment Borrower System')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="sticky top-0 z-40 bg-white border-b border-gray-200 shadow-sm">
        <div class="flex items-center justify-between px-6 py-4">
            <div class="flex items-center space-x-4">
                <button id="menu-toggle" class="text-gray-500 hover:text-gray-700 md:hidden">
                    <i class="text-xl fas fa-bars"></i>
                </button>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Equipment Management</h1>
                    <p class="text-sm text-gray-500">Manage all equipment and inventory</p>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Add Equipment Button -->
                <button id="open-add-modal"
                    class="flex items-center px-4 py-2 space-x-2 font-medium text-white transition bg-blue-500 rounded-lg shadow hover:bg-blue-600">
                    <i class="fas fa-plus"></i>
                    <span>Request Item</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="p-6">
        @if (session('success'))
            <div class="px-4 py-3 mb-6 text-green-800 bg-green-100 border-l-4 border-green-500 rounded-lg shadow-sm" role="alert">
                <div class="flex items-center">
                    <i class="mr-2 fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Equipment Table -->
        <div class="mb-10">
            <h2 class="mb-4 text-xl font-semibold text-gray-700">My Equipment Requests</h2>
            <div class="p-4 overflow-x-auto bg-white rounded-lg shadow">
                <table id="requestTable" class="w-full text-sm">
                    <thead class="text-left text-gray-700 bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Equipment Name</th>
                            <th class="px-4 py-2">Quantity</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Remarks</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                            <tr class="transition-colors duration-150 hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $request->equipment->equipment_name }}</td>
                                <td class="px-4 py-2">{{ $request->quantity }}</td>
                                <td class="px-4 py-2">
                                    @php
                                        $statusColors = [
                                            'Approved' => 'bg-green-100 text-green-800',
                                            'Declined' => 'bg-red-100 text-red-800',
                                        ];
                                        $statusColor = $statusColors[$request->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-2 inline-flex text-xs font-semibold rounded-full {{ $statusColor }}">
                                        {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">{{ $request->remarks ?? '---' }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex items-center space-x-2">
                                        <button class="px-3 py-1 text-white bg-blue-600 rounded hover:bg-blue-700 edit-btn"
                                            data-id="{{ $request->id }}"
                                            data-equipment-name="{{ $request->equipment->equipment_name }}"
                                            data-quantity="{{ $request->quantity }}"
                                            data-status="{{ $request->status }}"
                                            data-remarks="{{ $request->remarks }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="px-3 py-1 text-white bg-red-600 rounded hover:bg-red-700 delete-btn"
                                            data-id="{{ $request->id }}"
                                            data-equipment-name="{{ $request->equipment->equipment_name }}">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Borrow Transactions Table -->
        <div>
            <h2 class="mb-4 text-xl font-semibold text-gray-700">My Borrow Transactions</h2>
            <div class="p-4 overflow-x-auto bg-white rounded-lg shadow">
                <table id="transactionTable" class="w-full text-sm">
                    <thead class="text-left text-gray-700 bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Equipment</th>
                            <th class="px-4 py-2">Quantity</th>
                            <th class="px-4 py-2">Borrow Date</th>
                            <th class="px-4 py-2">Return Date</th>
                            <th class="px-4 py-2">Purpose</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $tx)
                            <tr class="transition-colors duration-150 hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $tx->equipment->equipment_name ?? '---' }}</td>
                                <td class="px-4 py-2">{{ $tx->quantity }}</td>
                                <td class="px-4 py-2">{{ $tx->borrow_date }}</td>
                                <td class="px-4 py-2">{{ $tx->return_date ?? '---' }}</td>
                                <td class="px-4 py-2">{{ $tx->purpose }}</td>
                                <td class="px-4 py-2">
                                    @php
                                        $txColors = [
                                            'Borrowed' => 'bg-yellow-100 text-yellow-800',
                                            'Returned' => 'bg-green-100 text-green-800',
                                            'Overdue' => 'bg-red-100 text-red-800',
                                        ];
                                        $txColor = $txColors[$tx->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-2 inline-flex text-xs font-semibold rounded-full {{ $txColor }}">
                                        {{ $tx->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">{{ $tx->remarks ?? '---' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

{{-- Include Modals (Add, Edit, Delete) --}}
@include('components.instructor.request-item-modal')
@include('components.instructor.update-request-modal')
@include('components.instructor.delete-request-modal')

{{-- DataTables & Script --}}
<script>
    $(document).ready(function () {
        $('#requestTable, #transactionTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            language: {
                search: "🔍 ",
                searchPlaceholder: "Search..."
            }
        });

        // Edit modal
        $('.edit-btn').on('click', function() {
            $('#edit-id').val($(this).data('id'));
            $('#edit-equipment-name').text($(this).data('equipment-name'));
            $('#edit-quantity').val($(this).data('quantity'));
            $('#edit-status').val($(this).data('status'));
            $('#edit-remarks').val($(this).data('remarks'));
            $('#edit-modal').removeClass('hidden');
        });

        // Delete modal
        $('.delete-btn').on('click', function () {
            const id = $(this).data('id');
            const name = $(this).data('equipment-name');
            $('#delete-item-name').text(name);
            $('#delete-form').attr('action', '/instructor/item-request/' + id);
            $('#delete-modal').removeClass('hidden');
        });

        $('#confirm-delete').on('click', function () {
            $('#delete-form').submit();
        });

        // Add modal
        $('#open-add-modal').on('click', function() {
            $('#add-modal').removeClass('hidden');
        });

        // Cancel buttons
        $('#cancel-add, #cancel-edit, #cancel-delete').on('click', function() {
            $('#add-modal, #edit-modal, #delete-modal').addClass('hidden');
        });

        // Close when clicking outside
        $('#add-modal, #edit-modal, #delete-modal').on('click', function(e) {
            if (e.target === this) $(this).addClass('hidden');
        });
    });
</script>

<style>
    /* DataTable Styling */
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        padding: 0.5rem 0.75rem;
        margin-left: 0.5rem;
    }

    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        padding: 0.25rem 0.5rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.4rem 0.75rem;
        margin: 0 0.125rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #3b82f6;
        color: white !important;
        border-color: #3b82f6;
    }
</style>
@endsection

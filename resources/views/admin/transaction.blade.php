@extends('components.default')

@section('title', 'Borrow Transactions - CICT Equipment Borrower System')

@section('content')
@include('components.admin.navbar')

<div class="min-h-screen bg-gray-50 md:ml-80">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 shadow-sm">
        <div class="flex items-center justify-between px-6 py-4">
            <h1 class="text-xl font-bold text-gray-800">Borrow Transactions</h1>
            <button id="open-add-modal" class="px-4 py-2 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700">
                + Add Transaction
            </button>
        </div>
    </header>

    <main class="p-6">
        <!-- DataTable -->
        <div class="p-4 bg-white rounded-lg shadow">
            <table id="transactions-table" class="w-full display nowrap">
                <thead class="bg-gray-50">
                    <tr>
                        <th>User</th>
                        <th>Equipment</th>
                        <th>Borrow Date</th>
                        <th>Return Date</th>
                        <th>Quantity</th>
                        <th>Purpose</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Class Schedule</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $tx)
                        <tr class="transition-colors duration-150 hover:bg-blue-50">
                            <td>{{ $tx->user->name }}</td>
                            <td>{{ $tx->equipment->equipment_name }}</td>
                            <td>{{ $tx->borrow_date }}</td>
                            <td>{{ $tx->return_date ?? 'N/A' }}</td>
                            <td>{{ $tx->quantity }}</td>
                            <td>{{ $tx->purpose }}</td>
                            <td>
                                @php
                                    $statusColors = [
                                        'Borrowed' => 'bg-yellow-100 text-yellow-800',
                                        'Returned' => 'bg-green-100 text-green-800',
                                        'Overdue' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$tx->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $tx->status }}
                                </span>
                            </td>
                            <td>{{ $tx->remarks ?? '—' }}</td>
                            <td>{{ $tx->classSchedule->name ?? '—' }}</td>
                            <td>
                                <div class="flex items-center space-x-2">
                                    <button class="text-blue-600 edit-btn hover:text-blue-900"
                                        data-id="{{ $tx->id }}"
                                        data-user="{{ $tx->user_id }}"
                                        data-equipment="{{ $tx->equipment_id }}"
                                        data-borrow="{{ $tx->borrow_date }}"
                                        data-return="{{ $tx->return_date }}"
                                        data-quantity="{{ $tx->quantity }}"
                                        data-purpose="{{ $tx->purpose }}"
                                        data-status="{{ $tx->status }}"
                                        data-remarks="{{ $tx->remarks }}"
                                        data-class="{{ $tx->class_schedule_id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 delete-btn hover:text-red-900"
                                        data-id="{{ $tx->id }}"
                                        data-name="{{ $tx->user->name }} - {{ $tx->equipment->equipment_name }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>

<!-- Modals -->
@include('transactions.modals.add')
@include('transactions.modals.edit')
@include('transactions.modals.delete')

@endsection

@section('scripts')
<script>
$(document).ready(function () {
    let table = $('#transactions-table').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        language: {
            search: "🔍 ",
            searchPlaceholder: "Search transactions..."
        }
    });

    // Add modal
    $('#open-add-modal').on('click', function() {
        $('#add-modal').removeClass('hidden');
    });

    // Edit modal
    $('.edit-btn').on('click', function() {
        $('#edit-id').val($(this).data('id'));
        $('#edit-user').val($(this).data('user'));
        $('#edit-equipment').val($(this).data('equipment'));
        $('#edit-borrow').val($(this).data('borrow'));
        $('#edit-return').val($(this).data('return'));
        $('#edit-quantity').val($(this).data('quantity'));
        $('#edit-purpose').val($(this).data('purpose'));
        $('#edit-status').val($(this).data('status'));
        $('#edit-remarks').val($(this).data('remarks'));
        $('#edit-class').val($(this).data('class'));
        $('#edit-modal').removeClass('hidden');
    });

    // Delete modal
    $('.delete-btn').on('click', function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        $('#delete-item-name').text(name);
        $('#delete-form').attr('action', '/admin/transactions/' + id);
        $('#delete-modal').removeClass('hidden');
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
@endsection

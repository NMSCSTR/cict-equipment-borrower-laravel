@extends('components.default')

@section('title', 'Transactions - CICT Equipment Borrower System')

@section('content')
@include('components.admin.navbar')

<div class="min-h-screen bg-gray-50 md:ml-80">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 shadow-sm">
        <div class="flex items-center justify-between px-6 py-4">
            <h1 class="text-xl font-semibold text-gray-800">Borrow Transactions</h1>
        </div>
    </header>

    <!-- Main -->
    <main class="p-6">
        <div class="p-6 bg-white rounded-lg shadow-sm">
            <div class="overflow-x-auto">
                <table id="transactions-table" class="w-full display nowrap">
                    <thead class="bg-gray-50">
                        <tr>
                            <th>User</th>
                            <th>Equipment</th>
                            <th>Quantity</th>
                            <th>Borrow Date</th>
                            <th>Return Date</th>
                            <th>Purpose</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Class</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr class="transition-colors hover:bg-gray-50">
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->equipment->equipment_name }}</td>
                                <td>{{ $transaction->quantity }}</td>
                                <td>{{ $transaction->borrow_date }}</td>
                                <td>{{ $transaction->return_date ?? 'N/A' }}</td>
                                <td>{{ $transaction->purpose }}</td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'Pending' => 'bg-yellow-100 text-yellow-800',
                                            'Approved' => 'bg-green-100 text-green-800',
                                            'Rejected' => 'bg-red-100 text-red-800',
                                            'Returned' => 'bg-blue-100 text-blue-800',
                                        ];
                                        $statusColor = $statusColors[$transaction->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                        {{ $transaction->status }}
                                    </span>
                                </td>
                                <td>{{ $transaction->remarks ?? '—' }}</td>
                                <td>{{ $transaction->classSchedule->class_name ?? 'N/A' }}</td>
                                <td>
                                    <div class="flex items-center space-x-2">
                                        <!-- Approve -->
                                        <button class="text-green-600 approve-btn hover:text-green-800"
                                            data-id="{{ $transaction->id }}">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <!-- Reject -->
                                        <button class="text-red-600 reject-btn hover:text-red-800"
                                            data-id="{{ $transaction->id }}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <!-- Return -->
                                        <button class="text-blue-600 return-btn hover:text-blue-800"
                                            data-id="{{ $transaction->id }}">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- Modals -->
<div id="status-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
        <h2 class="mb-4 text-lg font-semibold">Update Transaction</h2>
        <form id="status-form" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="transaction-id" name="transaction_id">
            <input type="hidden" id="status-action" name="status">

            <div class="mb-4">
                <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
                <textarea id="remarks" name="remarks" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"></textarea>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" id="cancel-status" class="px-4 py-2 bg-gray-200 rounded-md">Cancel</button>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md">Confirm</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // DataTables
    $('#transactions-table').DataTable({
        responsive: true,
        pageLength: 10,
        language: {
            search: "🔍 ",
            searchPlaceholder: "Search transactions..."
        }
    });

    // Open modal
    $('.approve-btn, .reject-btn, .return-btn').on('click', function() {
        let id = $(this).data('id');
        let action = $(this).hasClass('approve-btn') ? 'Approved' :
                     $(this).hasClass('reject-btn') ? 'Rejected' : 'Returned';

        $('#transaction-id').val(id);
        $('#status-action').val(action);
        $('#status-modal').removeClass('hidden');
    });

    // Cancel modal
    $('#cancel-status').on('click', function() {
        $('#status-modal').addClass('hidden');
    });

    // Close on outside click
    $('#status-modal').on('click', function(e) {
        if (e.target === this) $(this).addClass('hidden');
    });
});
</script>
@endpush

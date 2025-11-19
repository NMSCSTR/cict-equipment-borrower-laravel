@extends('components.default')

@section('title', 'Borrow Transactions - CICT Equipment Borrower System')

@section('content')
@include('components.admin.navbar')

<div class="min-h-screen bg-gray-50 md:ml-80">

    <!-- Header -->
    <header class="bg-white border-b border-gray-200 shadow-sm">
        <div class="flex items-center justify-between px-6 py-4">
            <h1 class="text-xl font-bold text-gray-800">BORROW TRANSACTIONS</h1>
            <button id="open-add-modal" class="px-4 py-2 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700">
                + Add Transaction
            </button>
        </div>
    </header>

    <main class="p-6">
        @if ($errors->any())
        <div class="px-4 py-3 mb-6 text-red-800 bg-red-100 border-l-4 border-red-500 rounded shadow-sm" role="alert">
            <div class="flex items-center">
                <i class="mr-2 fas fa-exclamation-circle"></i>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        @if (session('success'))
        <div class="px-4 py-3 mb-6 text-green-800 bg-green-100 border-l-4 border-green-500 rounded shadow-sm"
            role="alert">
            <div class="flex items-center">
                <i class="mr-2 fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif
        <!-- DataTable -->
        <div class="p-4 overflow-x-auto bg-white rounded-lg shadow">
            <table id="transactions-table" class="w-full border-collapse display nowrap stripe hover responsive">
                <thead class="bg-gray-50">
                    <tr>
                        <th>USER</th>
                        <th>EQUIPMENT</th>
                        <th>BORROW DATE</th>
                        <th>RETURN DATE</th>
                        <th>QUANTITY</th>
                        <th>PURPOSE</th>
                        <th>STATUS</th>
                        <th>REMARKS</th>
                        <th>CLASS SCHED</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $tx)
                    <tr class="transition-colors duration-150 hover:bg-blue-50">
                        <td>{{ $tx->user->name ?? 'Deleted User' }}</td>
                        <td>{{ $tx->equipment->equipment_name ?? 'Deleted Equipment' }}</td>
                        <td>{{ \Carbon\Carbon::parse($tx->borrow_date)->format('Y-m-d') }}</td>
                        <td>{{ $tx->return_date ? \Carbon\Carbon::parse($tx->return_date)->format('Y-m-d') : 'N/A' }}
                        </td>
                        <td>{{ $tx->quantity }}</td>
                        <td>{{ $tx->purpose }}</td>
                        <td>
                            <select
                                class="px-3 py-2 text-sm font-medium transition border border-gray-300 rounded-full status-dropdown focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                data-id="{{ $tx->id }}">
                                <option value="Borrowed" {{ $tx->status === 'Borrowed' ? 'selected' : '' }}>Borrowed
                                </option>
                                <option value="Returned" {{ $tx->status === 'Returned' ? 'selected' : '' }}>Returned
                                </option>
                                <option value="Overdue" {{ $tx->status === 'Overdue' ? 'selected' : '' }}>Overdue
                                </option>
                            </select>
                        </td>
                        <td>{{ $tx->remarks ?? '—' }}</td>
                        <td>
                            @if ($tx->classSchedule)
                            {{ $tx->classSchedule->schedule_time }}
                            - {{ $tx->classSchedule->instructor?->name ?? 'No Instructor' }}
                            - {{ $tx->classSchedule->room }}
                            @else
                            No Schedule
                            @endif
                        </td>
                        <td>
                            <div class="flex items-center space-x-2">
                                <button
                                    class="px-4 py-1 text-xs text-white bg-blue-600 md:text-sm hover:bg-blue-700 edit-btn"
                                    data-id="{{ $tx->id }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                {{-- <button
                                    class="px-4 py-1 text-xs text-white bg-red-600 md:text-sm hover:bg-red-700 delete-btn"
                                    data-id="{{ $tx->id }}">
                                    <i class="fas fa-trash"></i> Delete
                                </button> --}}
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
<!-- Return Log Modal -->
<div id="returnLogModal" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="p-6 bg-white rounded-lg shadow-lg w-96">
        <h2 class="mb-4 text-lg font-bold">Return Equipment</h2>

        <form id="returnLogForm">
            <input type="hidden" id="return-transaction-id">

            <!-- Condition -->
            <label class="block mb-1 text-sm font-medium text-gray-700">Condition</label>
            <select id="return-condition" class="w-full p-2 mb-4 border rounded">
                <option value="Good">Good</option>
                <option value="Damaged">Damaged</option>
                <option value="Needs Repair">Needs Repair</option>
            </select>

            <!-- Remarks -->
            <label class="block mb-1 text-sm font-medium text-gray-700">Remarks</label>
            <textarea id="return-remarks" class="w-full p-2 mb-4 border rounded"
                placeholder="Optional remarks..."></textarea>

            <div class="flex justify-end space-x-2">
                <button type="button" id="cancelReturn" class="px-3 py-1 bg-gray-300 rounded">Cancel</button>
                <button type="submit" class="px-3 py-1 text-white bg-gray-900 rounded">Confirm</button>
            </div>
        </form>
    </div>
</div>

@include('components.admin.transaction.add-modal')
@include('components.admin.transaction.edit-modal')
@include('components.admin.transaction.delete-modal')
<script>
    // Ensure that the data is properly passed into JavaScript
    const equipmentData = @json($equipment->where('status', 'Available')->where('available_quantity', '>', 0)->pluck('equipment_name', 'id')->toArray());

    // Listen for changes on the equipment select dropdown
    document.getElementById('equipment-select').addEventListener('change', function() {
        const equipmentIds = Array.from(this.selectedOptions).map(option => option.value);
        const quantitiesDiv = document.getElementById('equipment-quantities');

        // Clear any existing quantity fields
        quantitiesDiv.innerHTML = '';

        // Generate a quantity input field for each selected equipment
        equipmentIds.forEach(function(equipmentId) {
            const equipmentName = equipmentData[equipmentId];  // Get the equipment name from the JSON object

            const quantityField = document.createElement('div');
            quantityField.classList.add('space-y-2');
            quantityField.innerHTML = `
                <label class="block text-sm font-medium text-gray-700">Quantity for ${equipmentName}</label>
                <input type="number" name="quantities[${equipmentId}]" min="1" required
                    class="w-full px-3 py-2 mt-1 transition border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
            `;
            quantitiesDiv.appendChild(quantityField);
        });
    });
</script>



<script>
    $(document).ready(function () {
    let table = $('#transactions-table').DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        scrollX: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: -1 },
            ],
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

<script>
    $(document).ready(function () {
    $('.status-dropdown').change(function () {
        let status = $(this).val();
        let id = $(this).data('id');

        if (status === "Returned") {
            $('#return-transaction-id').val(id);
            $('#returnLogModal').removeClass('hidden');
        } else {
            updateStatus(id, status);
        }
    });

    // Cancel modal
    $('#cancelReturn').click(function () {
        $('#returnLogModal').addClass('hidden');
    });

    // Submit modal
    $('#returnLogForm').submit(function (e) {
        e.preventDefault();

        let id = $('#return-transaction-id').val();
        let condition = $('#return-condition').val();
        let remarks = $('#return-remarks').val();

        updateStatus(id, "Returned", condition, remarks);
        $('#returnLogModal').addClass('hidden');
    });

    function updateStatus(id, status, condition = null, remarks = null) {
        $.ajax({
            url: "{{ route('transactions.inlineUpdate') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                status: status,
                condition: condition,
                remarks: remarks
            },
            success: function (res) {
                Swal.fire({
                    title: 'Success!',
                    text: res.message,
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#10B981'
                }).then(() => {
                    location.reload();
                });
            },
            error: function (xhr) {
                alert("Error: " + xhr.responseText);
            }
        });
    }
});

</script>


{{-- Enhanced Styles for DataTables --}}
<style>
    .dataTables_filter input {
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        padding: 0.5rem;
        margin-left: 0.5rem;
    }

    .dataTables_length select {
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        padding: 0.5rem;
        margin-left: 0.5rem;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding: 0;
        margin: 0;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        margin-left: 0.25rem;
        font-size: 0.875rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #e5e7eb;
        border-color: #d1d5db;
        color: #374151;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #2563eb;
        border-color: #2563eb;
        color: white;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
        background: #f9fafb;
        color: #9ca3af;
        border-color: #d1d5db;
        cursor: not-allowed;
    }

    /* Custom spacing for table footer */
    #pagination-container {
        min-height: 2.5rem;
        display: flex;
        align-items: center;
    }

    /* Ensure proper spacing in table footer */
    .dataTables_wrapper .dataTables_info {
        padding: 0;
        margin: 0;
    }

    /* Modal content styling */
    .modal-content {
        pointer-events: auto;
    }
</style>
@endsection

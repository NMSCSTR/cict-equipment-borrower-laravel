<!-- Add Transaction Modal -->
<div id="add-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="w-full max-w-2xl p-6 bg-white rounded-lg shadow-lg">
        <h2 class="mb-4 text-lg font-semibold text-gray-800">Add Transaction</h2>

        <form action="{{ route('admin.transaction.store') }}" method="POST" class="space-y-4">
            @csrf
            <!-- User -->
            <div>
                <label class="block text-sm font-medium text-gray-700">User</label>
                <select name="user_id" required class="w-full mt-1 border-gray-300 rounded">
                    <option value="" disabled selected>-- Select User --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Equipment -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Equipment</label>
                <select name="equipment_id" required class="w-full mt-1 border-gray-300 rounded">
                    <option value="" disabled selected>-- Select Equipment --</option>
                    @foreach ($equipment as $eq)
                        <option value="{{ $eq->id }}">{{ $eq->equipment_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dates -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Borrow Date</label>
                    <input type="date" name="borrow_date" required class="w-full mt-1 border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Return Date</label>
                    <input type="date" name="return_date" required class="w-full mt-1 border-gray-300 rounded">
                </div>
            </div>

            <!-- Quantity -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" name="quantity" min="1" required class="w-full mt-1 border-gray-300 rounded">
            </div>

            <!-- Purpose -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Purpose</label>
                <input type="text" name="purpose" required class="w-full mt-1 border-gray-300 rounded">
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" required class="w-full mt-1 border-gray-300 rounded">
                    <option value="Borrowed">Borrowed</option>
                    <option value="Returned">Returned</option>
                    <option value="Overdue">Overdue</option>
                </select>
            </div>

            <!-- Remarks -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Remarks</label>
                <textarea name="remarks" rows="2" class="w-full mt-1 border-gray-300 rounded"></textarea>
            </div>

            <!-- Class Schedule -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Class Schedule (Optional)</label>
                <select name="class_schedule_id" class="w-full mt-1 border-gray-300 rounded">
                    <option value="" selected>-- None --</option>
                        @foreach ($classSchedules as $schedule)
                            <option value="{{ $schedule->id }}">
                                {{ \Carbon\Carbon::parse($schedule->schedule_time)->format('g:i A') }} - {{ $schedule->instructor?->name ?? 'No Instructor' }} - {{ $schedule->room }}
                            </option>
                        @endforeach
                </select>
            </div>

            <!-- Actions -->
            <div class="flex justify-end mt-4 space-x-2">
                <button type="button" id="cancel-add" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>

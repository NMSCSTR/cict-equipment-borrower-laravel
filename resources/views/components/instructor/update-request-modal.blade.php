<!-- Edit Modal -->
<div id="edit-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-lg">
        <h2 class="mb-4 text-xl font-semibold">Edit Item Request</h2>
        <form id="edit-form" method="POST" action="{{ route('instructor.request.update') }}">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" id="edit-id">

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Equipment</label>
                <p id="edit-equipment-name" class="font-semibold text-gray-900"></p>
            </div>

            <div class="mb-4">
                <label for="edit-quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" name="quantity" id="edit-quantity" required
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="edit-status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="edit-status"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="pending">Pending</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="edit-remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
                <textarea name="remarks" id="edit-remarks" rows="3"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Requested Date</label>
                <p id="edit-requested-date" class="font-semibold text-gray-900"></p>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" id="cancel-edit"
                    class="px-4 py-2 text-gray-800 bg-gray-300 rounded hover:bg-gray-400">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

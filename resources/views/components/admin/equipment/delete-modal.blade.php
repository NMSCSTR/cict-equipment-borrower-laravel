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



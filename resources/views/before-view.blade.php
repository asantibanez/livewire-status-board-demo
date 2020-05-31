<div class="flex justify-between items-center">
    <input
        wire:model="searchTerm"
        placeholder="Search Sales Orders"
        class="bg-white rounded border p-2 mt-3 mb-6 w-1/2"
    />
    <button
        wire:click.stop="addSalesOrder"
        class="border border-green-600 p-2 bg-green-500 rounded-lg text-white">
        Add Sales Order
    </button>
</div>

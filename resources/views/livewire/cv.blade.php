<div>
    <div>
        @if (session()->has('message'))
            <div class="bg-green-200 text-green-700 p-4 mb-4 rounded">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="generatePdf">
            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Generate CV
                </button>
            </div>
        </form>
    </div>
</div>

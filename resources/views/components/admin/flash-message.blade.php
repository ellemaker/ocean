<div>
    @if (session('flash_message'))
        <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
            {{ session('flash_message') }}
        </div>
    @endif
</div>
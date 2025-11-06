<div class="container-fluid py-4">
    <div class="card shadow-sm border-0" style="border-radius: 16px;">
        <div class="card-header bg-warning text-dark d-flex justify-content-between" style="border-radius: 16px 16px 0 0;">
            <h4 class="mb-0">Edit Purchase #{{ $purchase->purchase_number }}</h4>
            <a href="{{route('purchase.index')}}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
            </a>
        </div>
        <div class="card-body p-4">
            <form wire:submit="save">
                <!-- Same as create.blade.php -->
                @include('livewire.purchase.create')
            </form>
        </div>
    </div>
</div>
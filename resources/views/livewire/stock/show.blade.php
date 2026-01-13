<div class="container-fluid py-4">
   
    <div class="row g-4">

        <!-- Main Stock Card -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Stock Details</h5>
                        <a href="{{ route('stock.index') }}" class="btn btn-primary btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                    </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-4 align-items-center">

                        <div class="col-md-6">
                            <label class="form-label text-muted small mb-1">Item</label>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light rounded-circle p-3 d-flex align-items-center justify-content-center"
                                    style="width:60px;height:60px;">
                                    <i class="bi bi-box-seam text-primary" style="font-size:1.8rem;"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 fw-semibold">{{ $stock->item->name }}</h4>
                                    <small class="text-muted">
                                        Unit: {{ $stock->item->unit ?? 'pcs' }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 text-md-end">
                            <label class="form-label text-muted small mb-1">Current Stock</label>
                            <div
                                class="display-5 fw-bold {{ $stock->total_stock > 0 ? 'text-primary' : 'text-danger' }}">
                                {{ number_format($stock->total_stock) }}
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label text-muted small mb-1">Last Movement</label>
                            <p class="mb-0 fw-medium">
                                {{ \Carbon\Carbon::parse($stock->last_updated)->format('d M Y • h:i A') }}
                            </p>
                        </div>

                    </div>
                </div>
                <div class="card-header bg-white border-bottom">
                    <h6 class="mb-0">Usage History (Approved Logs)</h6>
                </div>
                <div class="card-body p-0">
                    @if($usageLogs->isEmpty())
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-clock-history fs-1 mb-3 d-block"></i>
                        No usage recorded yet for this item{{ $stock->project ? ' in this project' : '' }}.
                    </div>
                    @else
                    <div class="timeline-container px-4 py-3">
                        @foreach($usageLogs as $log)
                        <div class="timeline-item position-relative mb-4 ps-4">
                            <div class="timeline-dot position-absolute start-0 translate-middle-x bg-primary rounded-circle"
                                style="width:12px;height:12px;top:8px;"></div>
                            <div class="timeline-content border-start border-3 border-light ps-4 pb-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <strong>{{ \Carbon\Carbon::parse($log->date)->format('d M Y') }}</strong>
                                        <small class="text-muted ms-2">({{ $log->hours ?? '?' }} hours • {{
                                            $log->manpower_count ?? '?' }} people)</small>
                                    </div>
                                    <span class="badge bg-success">Approved</span>
                                </div>

                                @if(!empty($log->items_used))
                                <div class="small mt-2">
                                    Items used in this log:
                                    <ul class="mb-1 ps-4">
                                        @foreach($log->items_used as $used)
                                        @if($used['item_id'] == $stock->item_id)
                                        <li class="text-danger fw-medium">
                                            − {{ $used['quantity'] }} {{ $stock->item->unit ?? 'pcs' }}
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                @if($log->tasks)
                                <div class="small text-muted mt-2">
                                    Tasks: {{ implode(', ', $log->tasks) }}
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- Sidebar Quick Info -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Summary</h6>
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Total Stock</span>
                        <strong class="{{ $stock->total_stock > 0 ? 'text-primary' : 'text-danger' }}">
                            {{ number_format($stock->total_stock) }}
                        </strong>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Unit</span>
                        <strong>{{ $stock->item->unit ?? 'pcs' }}</strong>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Project</span>
                        <strong>{{ $stock->project?->name ?? 'Global' }}</strong>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Last Updated</span>
                        <strong>{{ \Carbon\Carbon::parse($stock->last_updated)->format('d M Y') }}</strong>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Usage Records</span>
                        <strong>{{ $usageLogs->count() }}</strong>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <style>
        .timeline-container {
            position: relative;
        }

        .timeline-item:last-child .timeline-content {
            border-bottom: none !important;
        }

        .timeline-dot {
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15);
        }
    </style>
</div>
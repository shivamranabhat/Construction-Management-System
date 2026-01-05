<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">
                Daily Log Details
                <span class="badge bg-{{ $log->status === 'approved' ? 'success' : ($log->status === 'rejected' ? 'danger' : 'warning') }} ms-2">
                    {{ ucfirst($log->status) }}
                </span>
            </div>
            <a href="{{ route('log.index') }}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
                Back
            </a>
        </div>

        <div class="card-body">
            <!-- Basic Info -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-muted mb-1">Log ID</h6>
                    <p class="fw-semibold">#{{ $log->slug }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted mb-1">Project</h6>
                    <p class="fw-semibold">{{ $log->project->name ?? '—' }}</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted mb-1">Date</h6>
                    <p class="fw-semibold">{{ \Carbon\Carbon::parse($log->date)->format('d F Y') }}</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted mb-1">Manpower Count</h6>
                    <p class="fw-semibold">{{ $log->manpower_count }} workers</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted mb-1">Total Hours</h6>
                    <p class="fw-semibold">{{ $log->hours }} hours</p>
                </div>
            </div>

            <hr>

            <!-- Tasks Completed -->
            <div class="mb-4">
                <h5 class="card-title mb-3">Tasks Completed</h5>
                @if($log->tasks && count($log->tasks) > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($log->tasks as $task)
                            <li class="list-group-item px-0">{{ $task }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No tasks recorded.</p>
                @endif
            </div>

            <hr>

            <!-- Items Used -->
            <div class="mb-4">
                <h5 class="card-title mb-3">Items Used from Stock</h5>

                @if($log->items_used && count($log->items_used) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th>S.N.</th>
                                    <th>Item</th>
                                    <th>Quantity Used</th>
                                    @if($log->status === 'approved')
                                        <th>Status</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($log->items_used as $index => $item)
                                    @php
                                        $stockItem = \App\Models\Item::find($item['item_id']);
                                    @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $stockItem->name ?? 'Unknown Item' }}</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        @if($log->status === 'approved')
                                            <td>
                                                <span class="badge bg-success">
                                                    <i class="ri-check-line"></i> Deducted
                                                </span>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($log->status === 'approved')
                        <div class="alert alert-success mt-3">
                            <i class="ri-checkbox-circle-line"></i>
                            Stock has been successfully deducted from inventory.
                        </div>
                    @elseif($log->status === 'pending')
                        <div class="alert alert-warning mt-3">
                            <i class="ri-time-line"></i>
                            Stock deduction pending admin approval.
                        </div>
                    @elseif($log->status === 'rejected')
                        <div class="alert alert-danger mt-3">
                            <i class="ri-close-circle-line"></i>
                            This log was rejected. No stock was deducted.
                        </div>
                    @endif
                @else
                    <p class="text-muted">No materials were used in this log.</p>
                @endif
            </div>

            <hr>

            <!-- Photos (Future-proof) -->
            <div class="mb-4">
                <h5 class="card-title mb-3">Photos</h5>
                @if($log->photos && count($log->photos) > 0)
                    <div class="row g-3">
                        @foreach($log->photos as $photo)
                            <div class="col-md-4 col-sm-6">
                                <img src="{{ asset('storage/' . $photo) }}" alt="Log Photo"
                                     class="img-fluid rounded shadow-sm">
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No photos uploaded.</p>
                @endif
            </div>

            <!-- Timestamps -->
            <div class="row mt-5 text-muted small">
                <div class="col-md-6">
                    Created: {{ \Carbon\Carbon::parse($log->created_at)->format('d M Y, h:i A') }}
                </div>
                <div class="col-md-6 text-end">
                    Last Updated: {{ \Carbon\Carbon::parse($log->updated_at)->format('d M Y, h:i A') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm">
        <!-- Header -->
        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 text-primary">
                    Requisition #{{ $requisition->requisition_number }}
                </h5>
                <small class="text-muted">
                    Project: {{ $requisition->project->name }} • Requested by: {{ $requisition->requester->name }}
                </small>
            </div>
            <a href="{{ route('requisition.index') }}" class="btn btn-outline-secondary btn-sm">
                ← Back
            </a>
        </div>

        <div class="card-body">
            <!-- Requisition Info -->
            <div class="row mb-5">
                <div class="col-md-6">
                    <p class="mb-2"><strong>Required By:</strong> {{
                        \Carbon\Carbon::parse($requisition->required_date)->format('d F Y') }}</p>
                    <p class="mb-2"><strong>Purpose:</strong> {{ $requisition->purpose }}</p>
                </div>
            </div>

            <!-- Horizontal Stepper - Perfect Progress & Tick Logic -->
            <div class="stepper-container">
                <div class="stepper-wrapper">
                    <!-- Background Line (Gray) -->
                    <div class="stepper-line"></div>

                    <!-- Progress Line (Purple → Fills based on status) -->
                    <div class="stepper-progress" style="width: {{ $progress }}%"></div>
                    <div class="stepper-steps">

                        <!-- Step 1: Requisition Received (Always completed when viewing) -->
                        <div class="stepper-step completed">
                            <div class="step-circle">
                                <svg class="tick" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <div class="step-label">
                                <div class="step-title">Requisition</div>
                                <div class="step-desc">Received</div>
                            </div>
                        </div>

                        <!-- Step 2: Project Manager Approved -->
                        <div
                            class="stepper-step {{ in_array($requisition->status, ['pm_approved', 'procurement_approved', 'owner_approved']) ? 'completed' : '' }}">
                            <div class="step-circle">
                                @if(in_array($requisition->status, ['pm_approved', 'procurement_approved',
                                'owner_approved']))
                                <svg class="tick" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                @endif
                            </div>
                            <div class="step-label">
                                <div class="step-title">Project Manager</div>
                                <div class="step-desc">Approved</div>
                            </div>
                        </div>

                        <!-- Step 3: Best Vendor Selected -->
                        <div
                            class="stepper-step {{ in_array($requisition->status, ['procurement_approved', 'owner_approved']) ? 'completed' : '' }}">
                            <div class="step-circle">
                                @if(in_array($requisition->status, ['procurement_approved', 'owner_approved']))
                                <svg class="tick" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                @endif
                            </div>
                            <div class="step-label">
                                <div class="step-title">Best Vendor</div>
                                <div class="step-desc">Selected</div>
                            </div>
                        </div>

                        <!-- Step 4: Company Approved (Final - Green) -->
                        <div
                            class="stepper-step {{ $requisition->status === 'owner_approved' ? 'completed final' : '' }}">
                            <div class="step-circle">
                                @if($requisition->status === 'owner_approved')
                                <svg class="tick" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                @endif
                            </div>
                            <div class="step-label">
                                <div class="step-title">Company</div>
                                <div class="step-desc">Approved</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Current Status Badge -->
            <div class="text-center mt-5 mb-5">
                <span class="badge bg-primary fs-6 px-4 py-2 rounded-pill">
                    {{ $currentStatus }}
                </span>
            </div>

            <!-- Requested Materials Table -->
            <h6 class="text-primary fw-bold mb-3">Requested Materials</h6>
            <div class="table-responsive mb-5">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Item</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Unit</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requisition->items as $index => $item)
                        <tr>
                            <td class="text-center fw-medium">{{ $index + 1 }}</td>
                            <td>{{ $item->item->name }}</td>
                            <td class="text-center">{{ number_format($item->quantity, 2) }}</td>
                            <td class="text-center text-uppercase">{{ $item->unit }}</td>
                            <td class="text-muted">{{ $item->remarks ?: '—' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No items added</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Approval Section -->
            @if($showApprovalSection)
            <div class="card border-0 shadow-sm bg-light-subtle rounded-4 mt-5">
                <div class="card-body text-center py-5">
                    @if($showPMApproval)
                    <h5 class="text-primary mb-4">Project Manager Approval Required</h5>

                    <div class="mb-4 w-100" style="max-width: 500px; margin: 0 auto;">
                        <textarea wire:model="comments" class="form-control" rows="3"
                            placeholder="Add optional comments..."></textarea>
                    </div>

                    <div class="d-flex justify-content-center gap-4">
                        <button wire:click="approvePM" class="btn btn-success btn-lg px-5 shadow-sm">Approve</button>
                        <button wire:click="rejectPM" class="btn btn-danger btn-lg px-5 shadow-sm">Reject</button>
                    </div>

                    @elseif($showProcurementApproval)
                    <h5 class="text-primary mb-4">Select Best Vendor & Approve</h5>

                    <div class="mb-3">
                        <select wire:model="selectedVendor" class="form-select form-select-lg d-inline-block"
                            style="width: 350px;">
                            <option value="">Choose Vendor</option>
                            @foreach($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                            @endforeach
                        </select>
                        <button wire:click="saveVendor" class="btn btn-outline-primary ms-2">Save Vendor</button>
                    </div>

                    <div class="mb-4 w-100" style="max-width: 500px; margin: 0 auto;">
                        <textarea wire:model="comments" class="form-control" rows="3"
                            placeholder="Add optional comments (e.g. reason for vendor selection)..."></textarea>
                    </div>

                    <div class="d-flex justify-content-center gap-4">
                        <button wire:click="approveProcurement"
                            class="btn btn-primary btn-lg px-5 shadow-sm">Approve</button>
                        <button wire:click="rejectProcurement"
                            class="btn btn-danger btn-lg px-5 shadow-sm">Reject</button>
                    </div>

                    @elseif($showCompanyApproval)
                    <h5 class="text-primary mb-4">Final Review & Approval by Company</h5>

                    <div class="mb-4 w-100" style="max-width: 500px; margin: 0 auto;">
                        <textarea wire:model="comments" class="form-control" rows="3"
                            placeholder="Final comments (optional)..."></textarea>
                    </div>

                    <div class="d-flex justify-content-center gap-4">
                        <button wire:click="approveCompany" class="btn btn-primary btn-lg px-5 shadow-sm">Final
                            Approve</button>
                        <button wire:click="rejectCompany" class="btn btn-danger btn-lg px-5 shadow-sm">Reject</button>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
    <!-- Beautiful & Responsive CSS -->
    <style>
        .stepper-container {
            padding: 80px 0;
            position: relative;
        }

        .stepper-wrapper {
            position: relative;
        }

        .stepper-line {
            position: absolute;
            top: 50%;
            left: 80px;
            right: 80px;
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            transform: translateY(-50%);
            z-index: 1;
        }

        .stepper-progress {
            position: absolute;
            top: 50%;
            left: 80px;
            height: 6px;
            background: #6366f1;
            border-radius: 3px;
            transform: translateY(-50%);
            z-index: 2;
            transition: width 0.9s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stepper-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            z-index: 3;
        }

        .stepper-step {
            flex: 1;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .step-circle {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: #e2e8f0;
            border: 7px solid #fff;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s ease;
        }

        .stepper-step.completed .step-circle {
            background: #6366f1;
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.35);
        }

        .stepper-step.completed.final .step-circle {
            background: #16a34a !important;
            box-shadow: 0 10px 30px rgba(22, 163, 74, 0.4);
        }

        .tick {
            width: 28px;
            height: 28px;
            fill: none;
            stroke: white;
            stroke-width: 4;
            stroke-linecap: round;
            stroke-linejoin: round;
            opacity: 0;
            transform: scale(0);
            transition: all 0.3s ease;
        }

        .stepper-step.completed .tick {
            opacity: 1;
            transform: scale(1);
        }

        .step-label {
            margin-top: 20px;
        }

        .step-title {
            font-weight: 700;
            font-size: 1.05rem;
            color: #1e293b;
        }

        .step-desc {
            font-size: 0.875rem;
            color: #64748b;
            margin-top: 4px;
        }

        /* Responsive */
        @media (max-width: 768px) {

            .stepper-line,
            .stepper-progress {
                left: 50px;
                right: 50px;
            }

            .step-circle {
                width: 56px;
                height: 56px;
                border-width: 6px;
            }

            .tick {
                width: 22px;
                height: 22px;
                stroke-width: 3.5;
            }

            .step-title {
                font-size: 0.95rem;
            }
        }
    </style>
</div>
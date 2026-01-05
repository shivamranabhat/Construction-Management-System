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
            <a href="{{ route('requisition.index') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-left"></i>
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
            {{-- <div class="stepper-container">
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
            </div> --}}
            <!-- Enhanced Stepper with Rejection Support -->
            <div class="stepper-container">
                <div class="stepper-wrapper">
                    <div class="stepper-line"></div>
                    <div class="stepper-progress" style="width: {{ $progress }}%"></div>
                    @if($rejectProgress > 0)
                    <div class="stepper-reject-line" style="width: {{ $rejectProgress }}%"></div>
                    @endif

                    <div class="stepper-steps">

                        <!-- 1. Received (Always completed) -->
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

                        <!-- 2. Project Manager -->
                        <div class="stepper-step 
                {{ $progress >= 50 ? 'completed' : '' }} 
                {{ $requisition->status === 'rejected_by_pm' ? 'rejected' : '' }}">
                            <div class="step-circle">
                                @if($progress >= 50)
                                <svg class="tick" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                @elseif($requisition->status === 'rejected_by_pm')
                                <svg class="cross" viewBox="0 0 24 24">
                                    <path d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                @endif
                            </div>
                            <div class="step-label">
                                <div class="step-title">Project Manager</div>
                                <div class="step-desc">
                                    @if($requisition->status === 'rejected_by_pm')
                                    Rejected
                                    @elseif($progress >= 50)
                                    Approved
                                    @else
                                    Pending
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- 3. Procurement Manager -->
                        <div class="stepper-step 
                {{ $progress >= 75 ? 'completed' : '' }} 
                {{ $requisition->status === 'rejected_by_procurement' ? 'rejected' : '' }}">
                            <div class="step-circle">
                                @if($progress >= 75)
                                <svg class="tick" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                @elseif($requisition->status === 'rejected_by_procurement')
                                <svg class="cross" viewBox="0 0 24 24">
                                    <path d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                @endif
                            </div>
                            <div class="step-label">
                                <div class="step-title">Procurement Manager</div>
                                <div class="step-desc">
                                    @if($requisition->status === 'rejected_by_procurement')
                                    Rejected
                                    @elseif($progress >= 75)
                                    Vendor Selected
                                    @else
                                    Pending
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- 4. Company Final -->
                        <div class="stepper-step 
                {{ $progress >= 90 ? 'completed final' : '' }} 
                {{ $requisition->status === 'rejected_by_owner' ? 'rejected' : '' }}">
                            <div class="step-circle">
                                @if($progress >= 90)
                                <svg class="tick" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                @elseif($requisition->status === 'rejected_by_owner')
                                <svg class="cross" viewBox="0 0 24 24">
                                    <path d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                @endif
                                
                            </div>
                            <div class="step-label">
                                <div class="step-title">Company</div>
                                <div class="step-desc">
                                    @if($requisition->status === 'rejected_by_owner')
                                    Rejected
                                    @elseif($progress >= 100)
                                    Approved
                                    @else
                                    Pending
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Requested Materials Table -->
            <h6 class="text-primary fw-bold mb-3">Requested Materials</h6>
            <div class="table-responsive mb-5">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>S.N.</th>
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
                            <td class="text-center text-uppercase">{{ $item->item->unit }}</td>
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
                <div class="card-body py-5">

                    <!-- Show Rejection Alert -->
                    @if(str_contains($requisition->status, 'rejected'))
                    @php
                    $rejection = $requisition->approvals()->where('status', 'rejected')->latest()->first();
                    @endphp
                    <div class="alert alert-danger mb-4">
                        <strong>Requisition Rejected</strong> at
                        {{ str_replace(['rejected_by_', '_'], [' ', ' '], $requisition->status) }} level
                        @if($rejection)
                        <br><small>By: {{ $rejection->approver->name }} |
                            Reason: {{ $rejection->comments ?: 'No comments provided' }}</small>
                        @endif
                    </div>
                    @endif

                    @if($showPMApproval)
                    <h5 class="text-primary mb-4">
                        {{ $requisition->status === 'rejected_by_pm' ? 'Re-approve' : 'Project Manager Approval
                        Required' }}
                    </h5>
                    <div class="mb-4 col-12 col-md-6">
                        <textarea wire:model="comments" class="form-control" rows="3"
                            placeholder="Add comments..."></textarea>
                    </div>
                    <div class="d-flex gap-4">
                        <button wire:click="approvePM" class="btn btn-primary shadow-sm"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-check-lg" viewBox="0 0 16 16">
                                <path
                                    d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                            </svg>Approve</button>
                        <button wire:click="rejectPM" class="btn btn-danger shadow-sm"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-x" viewBox="0 0 16 16">
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg>Reject</button>
                    </div>

                    @elseif($showProcurementApproval)
                    <h5 class="text-primary mb-4">
                        {{ $requisition->status === 'rejected_by_procurement' ? 'Re-select & Approve Vendor' : 'Select
                        Best Vendor & Approve' }}
                    </h5>
                    <div class="mb-3 col-12 col-md-6">
                        <select wire:model="selectedVendor" class="form-select">
                            <option value="">Choose Vendor</option>
                            @foreach($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4 col-12 col-md-6">
                        <textarea wire:model="comments" class="form-control" rows="3"
                            placeholder="Reason for selection..."></textarea>
                    </div>
                    <div class="d-flex gap-4">
                        <button wire:click="approveProcurement" class="btn btn-primary shadow-sm"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-check-lg" viewBox="0 0 16 16">
                                <path
                                    d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                            </svg>Approve</button>
                        <button wire:click="rejectProcurement" class="btn btn-danger shadow-sm"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-x" viewBox="0 0 16 16">
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg>Reject</button>
                    </div>

                    @elseif($showCompanyApproval)
                    <h5 class="text-primary mb-4">Final Approval Required</h5>
                    <div class="mb-4 col-12 col-md-6">
                        <textarea wire:model="comments" class="form-control" rows="3"
                            placeholder="Final comments..."></textarea>
                    </div>
                    <div class="d-flex gap-4">
                        <button wire:click="approveCompany" class="btn btn-primary shadow-sm"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-check-lg" viewBox="0 0 16 16">
                                <path
                                    d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                            </svg>Approve</button>
                        <button wire:click="rejectCompany" class="btn btn-danger shadow-sm"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-x" viewBox="0 0 16 16">
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg>Reject</button>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
    <style>
        :root {
            --stepper-bg-line: #e2e8f0;
            --stepper-progress: #6366f1;
            --stepper-completed: #6366f1;
            --stepper-final: #6366f1;
            --stepper-circle-bg: #f8fafc;
            --stepper-circle-size: 3.25rem;
            /* 52px */
            --stepper-circle-border: 0.375rem;
            /* 6px */
            --stepper-line-height: 0.25rem;
            /* 4px */
            --stepper-transition-fast: 180ms ease-out;
            --stepper-transition-slow: 320ms cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Container keeps layout stable */
        .stepper-container {
            padding: 2.5rem 0;
            position: relative;
        }

        /* Rejection line - red overlay */
        .stepper-reject-line {
            position: absolute;
            top: 50%;
            left: 5rem;
            height: var(--stepper-line-height);
            background: #ef4444;
            border-radius: 999px;
            transform: translateY(-50%);
            z-index: 3;
            opacity: 0.9;
            transition: width var(--stepper-transition-slow);
        }

        /* Cross icon for rejected steps */
        .cross {
            width: 1.5rem;
            height: 1.5rem;
            fill: none;
            stroke: white;
            stroke-width: 4;
            stroke-linecap: round;
            stroke-linejoin: round;
            opacity: 0;
            transform: scale(0.4);
            transition: all var(--stepper-transition-fast);
        }

        .stepper-step.rejected .cross {
            opacity: 1;
            transform: scale(1);
        }

        .stepper-step.rejected .step-circle {
            background: #ef4444 !important;
            border-color: #ef4444 !important;
            box-shadow: 0 10px 26px rgba(239, 68, 68, 0.4) !important;
        }

        .stepper-step.rejected .step-title,
        .stepper-step.rejected .step-desc {
            color: #dc2626 !important;
            font-weight: 600;
        }

        /* Wrapper */
        .stepper-wrapper {
            position: relative;
        }

        /* Background line */
        .stepper-line {
            position: absolute;
            top: 50%;
            left: 5rem;
            right: 5rem;
            height: var(--stepper-line-height);
            background: var(--stepper-bg-line);
            border-radius: 999px;
            transform: translateY(-50%);
            z-index: 1;
        }

        /* Progress line (animated) */
        .stepper-progress {
            position: absolute;
            top: 50%;
            left: 5rem;
            height: var(--stepper-line-height);
            background: var(--stepper-progress);
            border-radius: 999px;
            transform: translateY(-50%);
            z-index: 2;
            transition: width var(--stepper-transition-slow);
        }

        /* Steps layout */
        .stepper-steps {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            position: relative;
            z-index: 3;
            gap: 0.5rem;
        }

        /* Each step */
        .stepper-step {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            min-width: 0;
        }

        /* Make steps clearly focusable (for keyboard users) */
        .stepper-step:focus-within .step-circle,
        .stepper-step:focus-visible .step-circle {
            outline: 2px solid rgba(59, 130, 246, 0.8);
            outline-offset: 2px;
        }

        /* Circle */
        .step-circle {
            width: var(--stepper-circle-size);
            height: var(--stepper-circle-size);
            border-radius: 50%;
            background: var(--stepper-circle-bg);
            border: var(--stepper-circle-border) solid #fff;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            transition:
                background-color var(--stepper-transition-fast),
                box-shadow var(--stepper-transition-fast),
                transform var(--stepper-transition-fast);
        }

        /* States: completed / current / upcoming */
        .stepper-step.completed .step-circle {
            background: var(--stepper-completed);
            box-shadow: 0 10px 26px rgba(99, 102, 241, 0.35);
        }

        .stepper-step.completed.final .step-circle {
            background: var(--stepper-final);
            box-shadow: 0 10px 26px rgba(22, 163, 74, 0.4);
        }

        /* Optional "current" state if you add a class from backend */
        .stepper-step.current .step-circle {
            background: #eef2ff;
            box-shadow: 0 8px 22px rgba(79, 70, 229, 0.25);
            transform: scale(1.02);
        }

        /* Check icon */
        .tick {
            width: 1.5rem;
            height: 1.5rem;
            fill: none;
            stroke: #fff;
            stroke-width: 3.2;
            stroke-linecap: round;
            stroke-linejoin: round;
            opacity: 0;
            transform: scale(0.4);
            transition:
                opacity var(--stepper-transition-fast),
                transform var(--stepper-transition-fast);
        }

        .stepper-step.completed .tick {
            opacity: 1;
            transform: scale(1);
        }

        /* Labels */
        .step-label {
            margin-top: 0.75rem;
            max-width: 7.5rem;
        }

        .step-title {
            font-weight: 600;
            font-size: 0.95rem;
            color: #0f172a;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .step-desc {
            font-size: 0.8rem;
            color: #64748b;
            margin-top: 0.1rem;
        }


        /* Small screens */
        @media (max-width: 768px) {
            .stepper-container {
                padding: 1.75rem 0 2.25rem;
            }

            .stepper-line,
            .stepper-progress {
                left: 3.5rem;
                right: 3.5rem;
            }

            .stepper-steps {
                gap: 0.25rem;
            }

            .step-circle {
                width: 2.75rem;
                height: 2.75rem;
                border-width: 0.3rem;
            }

            .tick {
                width: 1.25rem;
                height: 1.25rem;
                stroke-width: 2.8;
            }

            .step-label {
                max-width: 5.5rem;
            }

            .step-title {
                font-size: 0.85rem;
            }

            .step-desc {
                font-size: 0.75rem;
            }
        }

        /* Very small screens: allow wrapping and avoid overlap */
        @media (max-width: 480px) {

            .stepper-line,
            .stepper-progress {
                top: 40%;
                left: 2.5rem;
                right: 2.5rem;
            }

            .step-label {
                margin-top: 0.5rem;
                max-width: 4.5rem;
            }

            .step-title {
                white-space: normal;
            }
        }
    </style>
</div>
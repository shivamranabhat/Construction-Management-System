<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <p class="text-muted mb-0">{{ $project->name }}</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('boq.edit', $slug) }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-pencil"></i> Edit
                    </a>

                    <button onclick="window.print()" class="btn btn-success btn-sm">
                        <i class="bi bi-printer"></i> Print
                    </button>
                    <a href="{{ route('boq.index') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>
            </div>

            <!-- Project Info Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="row text-sm">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Client:</strong> {{ $project->client }}</p>
                            <p class="mb-1"><strong>Start Date:</strong> {{
                                \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p class="mb-1"><strong>Status:</strong>
                                <span class="badge rounded-pill
                                    @if($project->status === 'ongoing') bg-info
                                    @elseif($project->status === 'completed') bg-success
                                    @elseif($project->status === 'pending') bg-warning
                                    @else bg-secondary @endif">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </p>
                            @if($tax)
                            <p class="mb-1"><strong>Tax:</strong> {{ $tax->name }} ({{ $tax->rate }}%)</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- BOQ Items -->
            @foreach($boqs as $main)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light border-0 py-3">
                    <h5 class="mb-0 fw-semibold">
                        {{ $main->serial_number }}. {{ $main->name }}
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($main->children->whereNull('item_description')->isNotEmpty())
                    <!-- Sub BOQs -->
                    @foreach($main->children->whereNull('item_description') as $sub)
                    <div class="border-bottom px-4 py-3">
                        <h6 class="text-primary fw-semibold mb-3">
                            {{ $sub->serial_number }}. {{ $sub->name }}
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" style="width: 8%">Serial No.</th>
                                        <th style="width: 45%">Description</th>
                                        <th class="text-center" style="width: 10%">Unit</th>
                                        <th class="text-center" style="width: 12%">Qty</th>
                                        <th class="text-end" style="width: 12%">Rate</th>
                                        <th class="text-end" style="width: 13%">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sub->children as $item)
                                    <tr>
                                        <td class="text-center fw-medium">{{ $item->serial_number }}</td>
                                        <td>
                                            <div>{{ $item->item_description }}</div>
                                            @if($item->summary)
                                            <small class="text-muted">Summary: {{ $item->summary }}</small>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $item->unit }}</td>
                                        <td class="text-center">{{ number_format($item->quantity, 2) }}</td>
                                        <td class="text-end">{{ number_format($item->unit_rate, 2) }}</td>
                                        <td class="text-end fw-semibold">{{ number_format($item->amount, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <!-- Direct Items -->
                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 8%">Serial No.</th>
                                    <th style="width: 45%">Description</th>
                                    <th class="text-center" style="width: 10%">Unit</th>
                                    <th class="text-center" style="width: 12%">Qty</th>
                                    <th class="text-end" style="width: 12%">Rate</th>
                                    <th class="text-end" style="width: 13%">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($main->children as $item)
                                <tr>
                                    <td class="text-center fw-medium">{{ $item->serial_number }}</td>
                                    <td>
                                        <div>{{ $item->item_description }}</div>
                                        @if($item->summary)
                                        <small class="text-muted">Summary: {{ $item->summary }}</small>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item->unit }}</td>
                                    <td class="text-center">{{ number_format($item->quantity, 2) }}</td>
                                    <td class="text-end">{{ number_format($item->unit_rate, 2) }}</td>
                                    <td class="text-end fw-semibold">{{ number_format($item->amount, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach

            <!-- Totals -->
            @php
            $subtotal = $boqs->sum(fn($m) => $m->children->sum('amount'));
            $taxAmount = $tax ? $subtotal * $tax->rate / 100 : 0;
            $total = $subtotal + $taxAmount;
            @endphp

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col-md-5 col-lg-4">
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td class="text-end fw-semibold pe-3">Subtotal:</td>
                                    <td class="text-end fw-bold">{{ number_format($subtotal, 2) }}</td>
                                </tr>
                                @if($tax)
                                <tr>
                                    <td class="text-end pe-3">Tax ({{ $tax->rate }}%):</td>
                                    <td class="text-end">{{ number_format($taxAmount, 2) }}</td>
                                </tr>
                                @endif
                                <tr class="border-top">
                                    <td class="text-end h5 fw-bold pe-3">Total:</td>
                                    <td class="text-end h5 fw-bold text-primary">{{ number_format($total, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Print Styles -->
@push('styles')
<style>
    @media print {
        body {
            background: white;
        }

        .no-print {
            display: none !important;
        }

        .card {
            box-shadow: none !important;
            border: 1px solid #dee2e6 !important;
        }

        .table {
            font-size: 12px;
        }

        .table th,
        .table td {
            border-color: #000 !important;
        }

        .text-primary {
            color: #000 !important;
        }
    }
</style>
@endpush
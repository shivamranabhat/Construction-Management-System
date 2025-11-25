<?php

namespace App\Livewire\Requisition;

use App\Models\Requisition;
use App\Models\RequisitionApproval;
use App\Models\Vendor;
use Livewire\Component;

class Show extends Component
{
    public $requisition;
    public $slug;
    public $vendors;
    public $selectedVendor;

    // Add this public property
    public $comments = '';
    public $currentStatus = 'Requisition Received';

    public $showApprovalSection = false;
    public $showPMApproval = false;
    public $showProcurementApproval = false;
    public $showCompanyApproval = false;
    public $progress = 0;
    public $rejectProgress = 0;

    public function mount(Requisition $requisition)
    {
        $this->requisition = $requisition->load(['items.item', 'project', 'requester']);
        $this->vendors = Vendor::all();
        $this->determineStatusAndProgress();
    }

   

    public function determineStatusAndProgress()
    {
        $status = $this->requisition->status;

        // Reset
        $this->progress = 25;        // Always show "Received"
        $this->rejectProgress = 0;
        $this->currentStatus = 'Requisition Received';

        // APPROVED FLOW
        if ($status === 'pm_approved' || $status === 'procurement_approved' || $status === 'owner_approved') {
            $this->progress = 50;
            $this->currentStatus = 'Approved by Project Manager';
        }
        if ($status === 'procurement_approved' || $status === 'owner_approved') {
            $this->progress = 75;
            $this->currentStatus = 'Best Vendor Selected';
        }
        if ($status === 'owner_approved') {
            $this->progress = 90;
            $this->currentStatus = 'Fully Approved';
        }

        // REJECTED FLOW — Only set red line at rejection point
        if ($status === 'rejected_by_pm') {
            $this->progress = 25;           // Green up to Received
            $this->rejectProgress = 50;     // Red from Received → PM
            $this->currentStatus = 'Rejected by Project Manager';
        }
        elseif ($status === 'rejected_by_procurement') {
            $this->progress = 50;           // Green up to PM
            $this->rejectProgress = 55;     // Red from PM → Procurement
            $this->currentStatus = 'Rejected by Procurement';
        }
        elseif ($status === 'rejected_by_owner') {
            $this->progress = 75;           // Green up to Procurement
            $this->rejectProgress = 80;    // Red to final
            $this->currentStatus = 'Fully Rejected by Company';
        }

        $this->checkApprovalVisibility();
    }

    protected function checkApprovalVisibility()
    {
        $user = auth()->user();
        $status = $this->requisition->status;

        // Reset all
        $this->showApprovalSection = $this->showPMApproval = $this->showProcurementApproval = $this->showCompanyApproval = false;

        // Normal flow
        if ($status === 'pending_pm' && $user->roles()->where('slug', 'project-manager')->exists()) {
            $this->showPMApproval = $this->showApprovalSection = true;
        }
        elseif ($status === 'pm_approved' && $user->roles()->where('slug', 'procurement-manager')->exists()) {
            $this->showProcurementApproval = $this->showApprovalSection = true;
        }
        elseif ($status === 'procurement_approved' && $user->type === 'Company') {
            $this->showCompanyApproval = $this->showApprovalSection = true;
        }

        // REJECTED STATES — Allow re-approval at the same level
        elseif ($status === 'rejected_by_pm' && $user->roles()->where('slug', 'project-manager')->exists()) {
            $this->showPMApproval = $this->showApprovalSection = true;
        }
        elseif ($status === 'rejected_by_procurement' && $user->roles()->where('slug', 'procurement-manager')->exists()) {
            $this->showProcurementApproval = $this->showApprovalSection = true;
        }
        elseif ($status === 'rejected_by_owner' && $user->type === 'Company') {
            $this->showCompanyApproval = $this->showApprovalSection = true;
        }
    }

    protected function logApproval(string $level, ?string $comments = null, string $action = 'approved')
    {
        $isApproved = $action === 'approved';
        $isRejected = $action === 'rejected';

        RequisitionApproval::updateOrCreate(
            [
                'requisition_id' => $this->requisition->id,
                'level'          => $level,
            ],
            [
                'company_id'   => auth()->user()->company_id,
                'approver_id'  => auth()->id(),
                'status'       => $isApproved ? 'approved' : 'rejected',
                'comments'     => $comments,
                'approved_at'  => $isApproved ? now() : null,
                'rejected_at'  => $isRejected ? now() : null,
            ]
        );
    }

    public function approvePM()
    {
        $this->requisition->update(['status' => 'pm_approved']);
        $this->logApproval('pm', $this->comments, 'approved');
        $this->reset('comments');
        $this->determineStatusAndProgress();
        $this->dispatch('toast', type: 'success', message: 'Approved by Project Manager');
    }

    public function rejectPM()
    {
        $this->requisition->update(['status' => 'rejected_by_pm']);
        $this->logApproval('pm', $this->comments, 'rejected');
        $this->reset('comments');
        $this->determineStatusAndProgress();
        $this->dispatch('toast', type: 'error', message: 'Rejected by Project Manager');
    }

    public function approveProcurement()
    {
        $this->requisition->update([
            'vendor_id' => $this->selectedVendor,
            'status'    => 'procurement_approved'
        ]);
        $this->logApproval('procurement', $this->comments, 'approved');
        $this->reset('comments');
        $this->determineStatusAndProgress();
        $this->dispatch('toast', type: 'success', message: 'Best vendor approved');
    }

    public function rejectProcurement()
    {
        $this->requisition->update(['status' => 'rejected_by_procurement']);
        $this->logApproval('procurement', $this->comments, 'rejected');
        $this->reset('comments');
        $this->determineStatusAndProgress();
        $this->dispatch('toast', type: 'error', message: 'Rejected by Procurement');
    }

    public function approveCompany()
    {
        $this->requisition->update(['status' => 'owner_approved']);
        $this->logApproval('company', $this->comments, 'approved');
        $this->reset('comments');
        $this->determineStatusAndProgress();
        $this->dispatch('toast', type: 'success', message: 'Fully approved!');
    }

    public function rejectCompany()
    {
        $this->requisition->update(['status' => 'rejected_by_owner']);
        $this->logApproval('company', $this->comments, 'rejected');
        $this->reset('comments');
        $this->determineStatusAndProgress();
        $this->dispatch('toast', type: 'error', message: 'Fully rejected by Company');
    }

    public function render()
    {
        return view('livewire.requisition.show');
    }
}
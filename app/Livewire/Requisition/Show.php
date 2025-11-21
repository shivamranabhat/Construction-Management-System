<?php

// namespace App\Livewire\Requisition;

// use App\Models\Requisition;
// use App\Models\RequisitionApproval;
// use App\Models\Vendor;
// use Livewire\Component;

// class Show extends Component
// {
//     public $requisition;
//     public $vendors;
//     public $selectedVendor;

//     public $progress = 25;
//     public $currentStatus = 'Requisition Received';

//     public $pmApproved = true;
//     public $vendorSelected = false;
//     public $companyApproved = false;

//     public $showApprovalSection = false;
//     public $showPMApproval = false;
//     public $showProcurementApproval = false;
//     public $showCompanyApproval = false;

//     public function mount($id)
//     {
//         $this->requisition = Requisition::with(['items.item', 'project', 'requester'])->findOrFail($id);
//         $this->vendors = Vendor::where('company_id', auth()->user()->company_id)->get();
//         $this->determineStatusAndProgress();
//     }

//     public function determineStatusAndProgress()
//     {
//         $status = $this->requisition->status;

//         // Default: Newly created requisition
//         $this->progress = 25;
//         $this->currentStatus = 'Requisition Received';

//         if ($status === 'pm_approved' || $status === 'procurement_approved' || $status === 'owner_approved') {
//             $this->progress = 50;
//             $this->currentStatus = 'Approved by Project Manager';
//         }

//         if ($status === 'procurement_approved' || $status === 'owner_approved') {
//             $this->progress = 75;
//             $this->currentStatus = 'Best Vendor Selected';
//         }

//         if ($status === 'owner_approved') {
//             $this->progress = 100;
//             $this->currentStatus = 'Fully Approved by Company';
//         }

//         $this->checkApprovalVisibility();
//     }

//     protected function checkApprovalVisibility()
//     {
//         $user = auth()->user();
//         $status = $this->requisition->status;

//         $this->showApprovalSection = $this->showPMApproval = $this->showProcurementApproval = $this->showCompanyApproval = false;

//         if ($status === 'pending_pm' && $user->roles()->where('slug', 'project-manager')->exists()) {
//             $this->showPMApproval = $this->showApprovalSection = true;
//         } elseif ($status === 'pm_approved' && $user->roles()->where('slug', 'procurement-manager')->exists()) {
//             $this->showProcurementApproval = $this->showApprovalSection = true;
//         } elseif ($status === 'procurement_approved' && $user->type === 'Company') {
//             $this->showCompanyApproval = $this->showApprovalSection = true;
//         }
//     }

//     protected function logApproval($level)
//     {
//         RequisitionApproval::create([
//             'company_id'     => auth()->user()->company_id,
//             'requisition_id' => $this->requisition->id,
//             'approver_id'    => auth()->id(),
//             'level'          => $level,
//             'status'         => 'approved',
//             'approved_at'    => now(),
//         ]);
//     }

//     public function approvePM() { $this->requisition->update(['status' => 'pm_approved']); $this->logApproval('pm'); $this->determineStatusAndProgress(); $this->dispatch('toast', type: 'success', message: 'Approved by PM'); }
//     public function saveVendor() { $this->requisition->update(['selected_vendor_id' => $this->selectedVendor]); $this->dispatch('toast', type: 'success', message: 'Vendor saved'); }
//     public function approveProcurement() { $this->requisition->update(['status' => 'procurement_approved']); $this->logApproval('procurement'); $this->determineStatusAndProgress(); $this->dispatch('toast', type: 'success', message: 'Vendor approved'); }
//     public function approveCompany() { $this->requisition->update(['status' => 'owner_approved']); $this->logApproval('company'); $this->determineStatusAndProgress(); $this->dispatch('toast', type: 'success', message: 'Final approval done!'); }

//     public function render()
//     {
//         return view('livewire.requisition.show');
//     }
// }


namespace App\Livewire\Requisition;

use App\Models\Requisition;
use App\Models\RequisitionApproval;
use App\Models\Vendor;
use Livewire\Component;

class Show extends Component
{
    public $requisition;
    public $vendors;
    public $selectedVendor;

    // Add this public property
    public $comments = '';
    public $progress = 25;
    public $currentStatus = 'Requisition Received';

    public $showApprovalSection = false;
    public $showPMApproval = false;
    public $showProcurementApproval = false;
    public $showCompanyApproval = false;

    public function mount($id)
    {
        $this->requisition = Requisition::with(['items.item', 'project', 'requester'])->findOrFail($id);
        $this->vendors = Vendor::where('company_id', auth()->user()->company_id)->get();
        $this->determineStatusAndProgress();
    }

    public function determineStatusAndProgress()
    {
        $status = $this->requisition->status;

        $this->progress = 25;
        $this->currentStatus = 'Requisition Received';

        if (in_array($status, ['pm_approved', 'procurement_approved', 'owner_approved'])) {
            $this->progress = 50;
            $this->currentStatus = 'Approved by Project Manager';
        }

        if (in_array($status, ['procurement_approved', 'owner_approved'])) {
            $this->progress = 75;
            $this->currentStatus = 'Best Vendor Selected';
        }

        if ($status === 'owner_approved') {
            $this->progress = 90;
            $this->currentStatus = 'Fully Approved by Company';
        }

        $this->checkApprovalVisibility();
    }

    protected function checkApprovalVisibility()
    {
        $user = auth()->user();
        $status = $this->requisition->status;

        $this->showApprovalSection = false;
        $this->showPMApproval = false;
        $this->showProcurementApproval = false;
        $this->showCompanyApproval = false;

        if ($status === 'pending_pm' && $user->roles()->where('slug', 'project-manager')->exists()) {
            $this->showPMApproval = $this->showApprovalSection = true;
        } elseif ($status === 'pm_approved' && $user->roles()->where('slug', 'procurement-manager')->exists()) {
            $this->showProcurementApproval = $this->showApprovalSection = true;
        } elseif ($status === 'procurement_approved' && $user->type === 'Company') {
            $this->showCompanyApproval = $this->showApprovalSection = true;
        }
    }

    protected function logApproval(string $level, ?string $comments = null)
    {
        RequisitionApproval::updateOrCreate(
            [
                'requisition_id' => $this->requisition->id,
                'level'          => $level,
            ],
            [
                'company_id'     => auth()->user()->company_id,
                'approver_id'    => auth()->id(),
                'status'         => 'approved',
                'comments'       => $comments,
                'approved_at'    => now(),
            ]
        );
    }

    public function approvePM()
    {
        $this->requisition->update(['status' => 'pm_approved']);
        $this->logApproval('pm', $this->comments);
        $this->reset('comments'); // Clear field after submit
        $this->determineStatusAndProgress();
        $this->dispatch('toast', type: 'success', message: 'Requisition approved by Project Manager');
    }

    public function approveProcurement()
    {
        $this->requisition->update(['status' => 'procurement_approved']);
        $this->logApproval('procurement', $this->comments);
        $this->reset('comments');
        $this->determineStatusAndProgress();
        $this->dispatch('toast', type: 'success', message: 'Best vendor approved');
    }

    public function approveCompany()
    {
        $this->requisition->update(['status' => 'owner_approved']);
        $this->logApproval('company', $this->comments);
        $this->reset('comments');
        $this->determineStatusAndProgress();
        $this->dispatch('toast', type: 'success', message: 'Requisition fully approved!');
    }

    public function saveVendor()
    {
        $this->requisition->update(['selected_vendor_id' => $this->selectedVendor]);
        $this->dispatch('toast', type: 'success', message: 'Vendor saved successfully');
    }

    public function render()
    {
        return view('livewire.requisition.show');
    }
}
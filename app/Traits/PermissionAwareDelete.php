<?php
// app/Traits/PermissionAwareDelete.php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use App\Models\Permission;

trait PermissionAwareDelete
{
    public function deleteWithPermission($modelClass, $slug, $permissionSlug = null)
    {
        $user   = Auth::user();
        $record = $modelClass::where('slug', $slug)->firstOrFail();

        /* -------------------------------------------------------------
         * 1. Super Admin (type column) → bypass permission check
         * ------------------------------------------------------------- */
        if ($user->type === 'Super Admin') {
            return $this->performDelete($record, $permissionSlug);
        }
        if ($user->type === 'Company') {
            return $this->performDelete($record, $permissionSlug);
        }

        /* -------------------------------------------------------------
         * 2. Normal user → must own a permission
         * ------------------------------------------------------------- */
        $perm = $permissionSlug ?? 'delete_' . $record->getTable();

        $hasPermission = Permission::where('slug', $perm)
            ->whereHas('roles.users', fn($q) => $q->where('users.id', $user->id))
            ->exists();

        if (! $hasPermission) {
            session()->flash('error', 'You do not have permission to delete this record.');
            return;
        }

        return $this->performDelete($record, $permissionSlug);
    }

    /** -------------------------------------------------------------
     *  Actually delete the record + cascade (module → permissions)
     * ------------------------------------------------------------- */
    // app/Traits/PermissionAwareDelete.php
    private function performDelete($record, $permissionSlug = null)
    {
        // Bypass any global scopes (like company_id from tenancy)
        if ($record instanceof \App\Models\Module && $permissionSlug !== false) {
            \App\Models\Permission::withoutGlobalScopes()
                ->where('module_id', $record->id)
                ->delete();
        }

        $record->delete();

        session()->flash('success', class_basename($record) . ' deleted successfully!');
        $this->dispatch('$refresh');
    }
}
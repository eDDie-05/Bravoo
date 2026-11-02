<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [];
        foreach (array_keys(config('bems.modules')) as $module) {
            $permissions[] = Permission::updateOrCreate(
                ['name' => $module.'.view'],
                ['module' => $module, 'label' => 'View '.str_replace('-', ' ', ucfirst($module))],
            );
        }

        $permissions[] = Permission::updateOrCreate(
            ['name' => 'employees.manage'],
            ['module' => 'people', 'label' => 'Manage employee records'],
        );

        $admin = Role::updateOrCreate(
            ['name' => 'super-administrator'],
            ['label' => 'Super Administrator', 'description' => 'Full platform access. Assign sparingly.'],
        );
        $admin->permissions()->sync(collect($permissions)->pluck('id'));

        $rolePermissions = [
            'managing-director' => 'Managing Director',
            'hr-manager' => 'Human Resource Manager',
            'it-manager' => 'IT Manager',
            'it-technician' => 'IT Technician',
            'procurement-officer' => 'Procurement Officer',
            'inventory-manager' => 'Inventory Manager',
            'receptionist' => 'Receptionist',
            'employee' => 'Regular Employee',
        ];

        foreach ($rolePermissions as $name => $label) {
            $role = Role::firstOrCreate(['name' => $name], ['label' => $label]);
            $visibleModules = match ($name) {
                'managing-director' => ['reports'],
                'hr-manager' => ['people'],
                'it-manager' => ['assets', 'helpdesk', 'infrastructure', 'security', 'reports'],
                'it-technician' => ['assets', 'helpdesk'],
                'procurement-officer' => ['procurement', 'inventory'],
                'inventory-manager' => ['inventory', 'procurement'],
                'receptionist' => ['visitors'],
                'employee' => ['helpdesk', 'documents'],
                default => [],
            };

            $role->permissions()->sync(Permission::whereIn('name', collect($visibleModules)->map(fn ($module) => $module.'.view'))->pluck('id'));
            if ($name === 'hr-manager') {
                $role->permissions()->syncWithoutDetaching(Permission::where('name', 'employees.manage')->pluck('id'));
            }
        }
    }
}

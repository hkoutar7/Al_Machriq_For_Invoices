<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            //pages
            'invoices',
            'invoice-principal', 
            'invoice-paid',
            'invoice-unpaid',
            'invoice-halfpaid',
            'invoice-archive',

            'reports',
            'report-user',
            'report-invoice',

            'users',
            'user-principal',
            'user-role',

            'settings',
            'setting-section',
            'setting-product',

            //actions
            'add-invoice',
            'exportXML-invoice',
            'detail-invoice',
            'change-payment-invoice',
            'edit-invoice',
            'print-invoice',
            'delete-invoice',
            'archive-invoice',

            'list-file-invoice',
            'add-file-invoice',
            'show-file-invoice',
            'download-file-invoice',
            'delete-file-invoice',

            'delete-archive-invoice',
            'restore-archive-invoice',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-show',
            'user-changeStatus',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'role-show',

            'section-list',
            'section-create',
            'section-edit',
            'section-delete',

            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}

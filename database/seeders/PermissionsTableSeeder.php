<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'bank_create',
            ],
            [
                'id'    => 18,
                'title' => 'bank_edit',
            ],
            [
                'id'    => 19,
                'title' => 'bank_show',
            ],
            [
                'id'    => 20,
                'title' => 'bank_delete',
            ],
            [
                'id'    => 21,
                'title' => 'bank_access',
            ],
            [
                'id'    => 22,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 23,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 24,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 25,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 26,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 27,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 28,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 29,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 30,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 31,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 32,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 33,
                'title' => 'expense_create',
            ],
            [
                'id'    => 34,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 35,
                'title' => 'expense_show',
            ],
            [
                'id'    => 36,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 37,
                'title' => 'expense_access',
            ],
            [
                'id'    => 38,
                'title' => 'income_create',
            ],
            [
                'id'    => 39,
                'title' => 'income_edit',
            ],
            [
                'id'    => 40,
                'title' => 'income_show',
            ],
            [
                'id'    => 41,
                'title' => 'income_delete',
            ],
            [
                'id'    => 42,
                'title' => 'income_access',
            ],
            [
                'id'    => 43,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 44,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 45,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 46,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 47,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 48,
                'title' => 'bank_management_access',
            ],
            [
                'id'    => 49,
                'title' => 'agency_create',
            ],
            [
                'id'    => 50,
                'title' => 'agency_edit',
            ],
            [
                'id'    => 51,
                'title' => 'agency_show',
            ],
            [
                'id'    => 52,
                'title' => 'agency_delete',
            ],
            [
                'id'    => 53,
                'title' => 'agency_access',
            ],
            [
                'id'    => 54,
                'title' => 'account_create',
            ],
            [
                'id'    => 55,
                'title' => 'account_edit',
            ],
            [
                'id'    => 56,
                'title' => 'account_show',
            ],
            [
                'id'    => 57,
                'title' => 'account_delete',
            ],
            [
                'id'    => 58,
                'title' => 'account_access',
            ],
            [
                'id'    => 59,
                'title' => 'bank_report_create',
            ],
            [
                'id'    => 60,
                'title' => 'bank_report_edit',
            ],
            [
                'id'    => 61,
                'title' => 'bank_report_show',
            ],
            [
                'id'    => 62,
                'title' => 'bank_report_delete',
            ],
            [
                'id'    => 63,
                'title' => 'bank_report_access',
            ],
            [
                'id'    => 64,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}

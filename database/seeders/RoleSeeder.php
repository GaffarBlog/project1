<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Admin role with full permissions',
            ],
            [
                'name' => 'Editor',
                'slug' => 'editor',
                'description' => 'Editor role with limited permissions',
            ],
            [
                'name' => 'Viewer',
                'slug' => 'viewer',
                'description' => 'Viewer role with read-only permissions',
            ],
            [
                'name' => 'User',
                'slug' => 'user',
                'description' => 'User role with basic permissions',
            ],
        ];


        foreach ($data as $item) {
            Role::create($item);
        }
    }
}

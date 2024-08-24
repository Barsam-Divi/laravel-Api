<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
         * Category permission
         * */
        Permission::query()->insert([
            [
               'title' => 'create-category'
            ],
            [
                'title' => 'read-category'
            ] ,
            [
                'title' => 'update-category'
            ],
            [
                'title' => 'delete-category'
            ],

        ]);

        /*
         * Artists permission
         * */
        Permission::query()->insert([
            [
                'title' => 'create-artist'
            ],
            [
                'title' => 'read-artist'
            ] ,
            [
                'title' => 'update-artist'
            ],
            [
                'title' => 'delete-artist'
            ],

        ]);
        /*
         * users permission
         * */
        Permission::query()->insert([
            [
                'title' => 'read-users'
            ] ,
            [
                'title' => 'update-users'
            ],
            [
                'title' => 'delete-users'
            ],

        ]);
        /*
         *Roles permission
         * */
        Permission::query()->insert([
            [
                'title' => 'create-role'
            ] ,
            [
                'title' => 'read-role'
            ] ,
            [
                'title' => 'update-role'
            ],
            [
                'title' => 'delete-role'
            ],

        ]);
        /*
         *Concerts permission
         * */
        Permission::query()->insert([
            [
                'title' => 'create-concert'
            ] ,
            [
                'title' => 'read-concert'
            ] ,
            [
                'title' => 'update-concert'
            ],
            [
                'title' => 'delete-concert'
            ],

        ]);
        /*
        *Halls permission
        * */
        Permission::query()->insert([
            [
                'title' => 'create-hall'
            ] ,
            [
                'title' => 'read-hall'
            ] ,
            [
                'title' => 'update-hall'
            ],
            [
                'title' => 'delete-hall'
            ],

        ]);
        /*
        * permission
        * */
        Permission::query()->insert([
            [
                'title' => 'read-permission'
            ] ,
        ]);
        /*
        *Hall Seats permission
        * */
        Permission::query()->insert([
            [
                'title' => 'create-halls-seats'
            ] ,
            [
                'title' => 'update-halls-seats'
            ] ,
            [
                'title' => 'delete-halls-seats'
            ] ,

        ]);
    }
}

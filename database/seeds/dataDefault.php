<?php

use Illuminate\Database\Seeder;

class dataDefault extends Seeder
{
    public function run()
    {
        $roles = [
            ['role_name' => 'Super Admin', 'status' => '0'],
            ['role_name' => 'Admin', 'status' => '1'],
        ];

        \DB::table('roles')->insert($roles);

        $users = [
            ['name' => 'superadmin', 'email' => 'superadmin@mail.com', 'password' => bcrypt('superadmin'), 'role_id' => 1, 'status' => '1'],
            ['name' => 'admin', 'email' => 'admin@mail.com', 'password' => bcrypt('admin'), 'role_id' => 2, 'status' => '1'],
        ];
        \DB::table('users')->insert($users);

        $settings = [
            ['key' => 'site_name', 'type' => 'site', 'value' => 'Magic Laundry', 'status' => '1'],
            ['key' => 'site_desc', 'type' => 'site', 'value' => 'Description Website', 'status' => '1'],
            ['key' => 'email', 'type' => 'site', 'value' => 'master@mail.com', 'status' => '1'],
            ['key' => 'phone', 'type' => 'site', 'value' => '', 'status' => '1'],
            ['key' => 'address', 'type' => 'site', 'value' => '', 'status' => '1'],
            ['key' => 'logo', 'type' => 'site', 'value' => '', 'status' => '1'],
            ['key' => 'email_name', 'type' => 'site', 'value' => 'Magic Laundry', 'status' => '1'],
            ['key' => 'email_address', 'type' => 'site', 'value' => 'noreplay@mail.com', 'status' => '1'],
            ['key' => 'mini', 'type' => 'handle-image', 'value' => serialize(['width' => 200, 'height' => 200]), 'status' => '1'],
            ['key' => 'avatar', 'type' => 'handle-image', 'value' => serialize(['width' => 50, 'height' => 50]), 'status' => '1'],
        ];

        \DB::table('settings')->insert($settings);
    }
}

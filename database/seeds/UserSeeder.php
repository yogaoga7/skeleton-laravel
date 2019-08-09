<?php

use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\AccessMenuAdmin;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Role::truncate();
        
        if(!Role::count()) {
            $role = Role::create([
                'name' => 'Superadmin',
                'slug' => 'superadmin',
                'description' => 'Top level for access all modules',
                'permissions' => \Permission::slugs(),
                'state' => 'active'
                // 'notifications' => \NotifyAdmin::slugs(),
                // 'dashboard_access' => []
            ]);
        }


        if(!User::count()) {
            $user = User::create([
                'name' => 'Super Admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('password'),
                'state' => 'active',
                'email_verified_at' => now()
            ]);
            $user->roles()->attach($role->id);
        }

        if(!AccessMenuAdmin::count()) {
            $role->access()->create([
                'uniqkey' => 'access.group.menu'
            ]);
            $role->access()->create([
                'uniqkey' => 'access.role.menu',
                'url' => '/administrator/access/role'
            ]);
            $role->access()->create([
                'uniqkey' => 'access.permissions.menu',
                'url' => '/administrator/access/permission'
            ]);
        }

        $this->command->info(PHP_EOL);
        $this->command->info('================ Admin =============================');
        $this->command->info('Email: admin@mail.com');
        $this->command->info('Password: password');
        $this->command->info(url('/administrator/login'));
        $this->command->info('====================================================');
        $this->command->info(PHP_EOL);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\User;

use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name'                  =>  'Admin',
            'password'              =>  bcrypt(12345678),
            'remember_token'        =>  bcrypt(12345678),
            'email'                 =>  'admin@email.com',
            'personal_clinica_id'   =>  1,
            'estado_id'             =>  2

        ]);

        /*$role = Role::create(['name' => 'Administrador']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user1->assignRole([$role->id]);*/

        $user2=User::create([
            'name'                  =>  'axel',
            'password'              =>  bcrypt(12345678),
            'remember_token'        =>  bcrypt(12345678),
            'email'                 =>  'axel@gmail.com',
            'personal_clinica_id'   =>  2,
            'estado_id'             =>  2
        ]);
        //$user2->assignRole([$role->id]);

    }
}

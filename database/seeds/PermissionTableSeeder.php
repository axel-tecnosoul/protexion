<?php


use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder

{

    /**

     * Run the database seeds.

     *

     * @return void

     */

    public function run()

    {

        $permissions = [


            'listar roles',
            'crear rol',
            'editar rol',
            'eliminar rol',

            'listar pacientes',
            'crear paciente',
            'editar paciente',
            'eliminar paciente',

            'listar usuarios',
            'crear usuario',
            'editar usuario',
            'eliminar usuario',

            'listar personal',
           'crear personal',
           'editar personal',
           'eliminar personal',

            'listar vouchers',
            'crear voucher',
            'editar voucher',
            'eliminar voucher',

            'listar declaraciones_juradas',
            'crear declaracion_jurada',
            'editar declaracion_jurada',
            'eliminar declaracion_jurada',

        ];



        foreach ($permissions as $permission) {

            Permission::create(['name' => $permission]);

        }

    }

}
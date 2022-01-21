<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(PermissionTableSeeder::class);
        $this->call(EstadoCivilSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(TipoTelefonoSeeder::class);
        $this->call(ObraSocialSeeder::class);
        $this->call(PaisSeeder::class);
        $this->call(ProvinciaSeeder::class);
        $this->call(CiudadSeeder::class);
        $this->call(DomicilioSeeder::class);
        $this->call(OrigenSeeder::class);
        $this->call(SexoSeeder::class);
        $this->call(PuestoSeeder::class);
        $this->call(EspecialidadSeeder::class);
        $this->call(PersonalClinicaSeeder::class);
        //$this->call(UserSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(PacienteSeeder::class);
        $this->call(TipoEstudioSeeder::class);
        $this->call(EstudioSeeder::class);
        //$this->call(VoucherSeeder::class);
    }
}

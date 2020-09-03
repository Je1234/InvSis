<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Reset de cache para roles y permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
         
        //Se crean los permisos
        Permission::create(['name' => 'crear-user']);
        Permission::create(['name' => 'eliminar-user']);
        Permission::create(['name' => 'editar-user']);
        Permission::create(['name' => 'crear-rol']);
        Permission::create(['name' => 'eliminar-rol']);
        Permission::create(['name' => 'editar-rol']);

        $rolA = Role::create(['name' => 'admin']);
        $rolA->givePermissionTo('crear-user','eliminar-user','editar-user','crear-rol','eliminar-rol','editar-rol');

        $rolCliente = Role::create(['name' => 'cliente']);


        $Admin = User::find(1);

        $Admin->assignRole('admin');

        $cliente = User::find(2);

        $cliente->assignRole('cliente');
    
    }
}

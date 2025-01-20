<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos
        Permission::create(['name' => 'crear entidad']);
        Permission::create(['name' => 'editar entidad']);
        Permission::create(['name' => 'añadir entidad']);
        Permission::create(['name' => 'ver entidad']);

        // Crear roles
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);
        $visorRole = Role::create(['name' => 'visor']);

        // Asignar permisos a los roles
        $adminRole->givePermissionTo(Permission::all());  // El admin tiene todos los permisos
        $editorRole->givePermissionTo(['crear entidad', 'editar entidad', 'añadir entidad']);  // El editor puede crear, editar y añadir
        $visorRole->givePermissionTo('ver entidad');  // El visor solo puede ver

        // Asignar roles a los usuarios (si es necesario)
        $user = \App\Models\User::find(1);  // Aquí puedes asignar un rol a un usuario en específico
        $user->assignRole('editor');
    }
}

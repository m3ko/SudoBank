<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\CuentaBancaria;
use App\Models\Bizum;
use App\Models\Tarjeta;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run()
    {   
        // Crear permisos
        Permission::create(['name' => 'crear entidad']);
        Permission::create(['name' => 'editar entidad']);
        Permission::create(['name' => 'añadir entidad']);
        Permission::create(['name' => 'guardar entidad']);
        Permission::create(['name' => 'eliminar entidad']);
        Permission::create(['name' => 'ver entidad']);

        // Crear roles
        $adminRole = Role::create(['name' => 'admin']);
        $visorRole = Role::create(['name' => 'visor']);

        $adminRole->givePermissionTo([
            'crear entidad',
            'editar entidad',
            'añadir entidad',
            'guardar entidad',
            'eliminar entidad',
            'ver entidad',
        ]);


        $visorRole->givePermissionTo([
            
            'ver entidad',
        ]);

        // Crear un usuario administrador de prueba
        $adminUser = User::create([
            'nombre' => 'Admin',
            'apellido' => 'Test',
            'email' => 'test@example.com',
            'direccion' => '123 Calle Falsa',
            'telefono' => '123456789',
            'rol' => 'admin',
            'password' => bcrypt('12345678'), // Contraseña encriptada
        ]);
        $adminUser->assignRole($adminRole);

        // Crear 20 usuarios adicionales
        $usuarios = User::factory(20)->create();

        // Asignar roles a los usuarios
        foreach ($usuarios as $index => $usuario) {
            if ($index % 2 === 0) {
                $usuario->assignRole($adminRole); // Asignar rol de admin a usuarios pares
            } else {
                $usuario->assignRole($visorRole); // Asignar rol de visor a usuarios impares
            }
        }

        // Crear cuentas bancarias con IBAN único para cada usuario
        foreach ($usuarios as $usuario) {
            $iban = $this->generarIBAN(); // Generar un IBAN único
            CuentaBancaria::create([
                'user_id' => $usuario->id,
                'saldo' => rand(100, 10000), // Saldo aleatorio
                'num_cuenta' => $iban, // IBAN único
                'tipo_moneda' => 'EUR', // Moneda fija
            ]);
        }

        // Crear transacciones Bizum entre usuarios
        $usuariosIds = $usuarios->pluck('id')->toArray();
        for ($i = 0; $i < 20; $i++) { // Generar 20 transacciones Bizum
            $emisorId = $usuariosIds[array_rand($usuariosIds)];
            $receptorId = $usuariosIds[array_rand($usuariosIds)];

            // Evitar que el emisor y receptor sean el mismo usuario
            while ($emisorId === $receptorId) {
                $receptorId = $usuariosIds[array_rand($usuariosIds)];
            }

            // Obtener cuentas bancarias asociadas al emisor y receptor
            $cuentaEmisor = CuentaBancaria::where('user_id', $emisorId)->inRandomOrder()->first();
            $cuentaReceptor = CuentaBancaria::where('user_id', $receptorId)->inRandomOrder()->first();

            // Crear la transacción Bizum
            Bizum::create([
                'id_emisor' => $emisorId,
                'id_receptor' => $receptorId,
                'cuenta_emisor' => $cuentaEmisor->num_cuenta,
                'cuenta_receptor' => $cuentaReceptor->num_cuenta,
                'monto' => rand(10, 500), // Monto aleatorio entre 10 y 500
                'fecha_hora' => now()->subDays(rand(0, 30))->format('Y-m-d H:i:s'), // Fecha aleatoria en los últimos 30 días
            ]);
        }
    }

    private function generarIBAN()
    {
        do {
            // Código del país (España: ES)
            $codigoPais = 'ES';

            // Código de control (2 dígitos)
            $codigoControl = str_pad(random_int(0, 99), 2, '0', STR_PAD_LEFT);

            // Número de cuenta bancaria (20 dígitos) generado en partes
            $numeroCuenta = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT) . // 8 dígitos
                            str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT) . // 8 dígitos
                            str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);      // 4 dígitos

            // Generar el IBAN completo
            $iban = $codigoPais . $codigoControl . $numeroCuenta;

        } while (CuentaBancaria::where('num_cuenta', $iban)->exists()); // Asegurarse de que sea único

        return $iban;
    }
}
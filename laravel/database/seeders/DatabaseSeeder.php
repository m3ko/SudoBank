<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\CuentaBancaria;
use App\Models\Bizum;
use App\Models\Tarjeta;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\TransaccionBancaria;
use App\Models\Deuda;
use App\Models\PagoPendiente;

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
        $usuarios = User::factory(20)->create()->each(function ($usuario, $index) use ($adminRole, $visorRole) {
            $telefono = '6' . rand(10000000, 99999999); // Número que comienza con "6"
            $usuario->update(['telefono' => $telefono]);

            if ($index % 2 === 0) {
                $usuario->assignRole($adminRole); // Asignar rol de admin a usuarios pares
            } else {
                $usuario->assignRole($visorRole); // Asignar rol de visor a usuarios impares
            }
        });

        // Crear cuentas bancarias con IBAN único para cada usuario
        foreach ($usuarios as $usuario) {
            for ($i = 0; $i < 3; $i++) { // Cada usuario tiene 3 cuentas bancarias
                $iban = $this->generarIBAN();
                CuentaBancaria::create([
                    'user_id' => $usuario->id,
                    'saldo' => rand(100, 10000),
                    'num_cuenta' => $iban,
                    'tipo_moneda' => 'EUR',
                    'cvv' => rand(100, 999), // CVV aleatorio
                    'fecha_expiracion' => now()->addYears(rand(1, 5))->format('Y-m-d'), // Fecha de expiración aleatoria
                ]);
            }
        }

        // Crear transacciones Bizum entre usuarios
        $usuariosIds = $usuarios->pluck('id')->toArray();
        for ($i = 0; $i < 20; $i++) {
            $emisorId = $usuariosIds[array_rand($usuariosIds)];
            $receptorId = $usuariosIds[array_rand($usuariosIds)];

            while ($emisorId === $receptorId) {
                $receptorId = $usuariosIds[array_rand($usuariosIds)];
            }

            $cuentaEmisor = CuentaBancaria::where('user_id', $emisorId)->inRandomOrder()->first();
            $cuentaReceptor = CuentaBancaria::where('user_id', $receptorId)->inRandomOrder()->first();

            Bizum::create([
                'id_emisor' => $emisorId,
                'id_receptor' => $receptorId,
                'cuenta_emisor' => $cuentaEmisor->num_cuenta,
                'cuenta_receptor' => $cuentaReceptor->num_cuenta,
                'monto' => rand(10, 500),
                'fecha_hora' => now()->subDays(rand(0, 30))->format('Y-m-d H:i:s'),
            ]);
        }

        $cuentas = CuentaBancaria::all();

        foreach ($cuentas as $cuenta) {
            TransaccionBancaria::create([
                'cuenta_id' => $cuenta->id,
                'num_cuenta_destino' => $this->generarIBAN(),
                'concepto' => 'Factura de luz',
                'monto' => rand(50, 200),
                'fecha' => now()->subDays(rand(1, 30)),
            ]);

            Deuda::create([
                'cuenta_id' => $cuenta->id,
                'num_cuenta_destino' => $this->generarIBAN(),
                'concepto' => 'Factura de luz no pagada',
                'monto' => rand(50, 200),
                'fecha_generacion' => now()->subDays(rand(1, 30)),
            ]);

            PagoPendiente::create([
                'cuenta_id' => $cuenta->id,
                'num_cuenta_destino' => $this->generarIBAN(),
                'concepto' => 'Impuesto de vehículo',
                'monto' => rand(100, 500),
                'fecha_vencimiento' => now()->addDays(rand(1, 30)),
            ]);
        }

        // Crear un usuario testCliente
        $testCliente = User::create([
            'nombre' => 'testCliente',
            'apellido' => 'Cliente',
            'email' => 'testcliente@example.com',
            'direccion' => '456 Calle Verdadera',
            'telefono' => '612345678',
            'rol' => 'visor',
            'password' => bcrypt('12345678'),
        ]);

        $testCliente->assignRole($visorRole); // Asignar rol de admin al testCliente

        for ($i = 0; $i < 3; $i++) {
            $cuenta = CuentaBancaria::create([
                'user_id' => $testCliente->id,
                'saldo' => rand(1000, 10000),
                'num_cuenta' => $this->generarIBAN(),
                'tipo_moneda' => 'EUR',
                'cvv' => rand(100, 999),
                'fecha_expiracion' => now()->addYears(rand(1, 5))->format('Y-m-d'),
            ]);

            Deuda::create([
                'cuenta_id' => $cuenta->id,
                'num_cuenta_destino' => $this->generarIBAN(),
                'concepto' => 'Deuda ' . ($i + 1),
                'monto' => rand(100, 1000),
                'fecha_generacion' => now()->subDays(rand(1, 30)),
            ]);

            PagoPendiente::create([
                'cuenta_id' => $cuenta->id,
                'num_cuenta_destino' => $this->generarIBAN(),
                'concepto' => 'Pago pendiente ' . ($i + 1),
                'monto' => rand(50, 500),
                'fecha_vencimiento' => now()->addDays(rand(1, 30)),
            ]);
        }

        foreach ($cuentas as $cuenta) {
            // Conceptos aleatorios para deudas
            $conceptosDeudas = [
                'Factura de luz no pagada',
                'Factura de agua no pagada',
                'Préstamo personal',
                'Compra a plazos',
                'Deuda de tarjeta de crédito',
                'Multa de tráfico',
                'Pago atrasado de alquiler',
            ];
        
            // Generar entre 3 y 7 deudas por cuenta
            for ($i = 0; $i < rand(3, 7); $i++) {
                Deuda::create([
                    'cuenta_id' => $cuenta->id,
                    'num_cuenta_destino' => $this->generarIBAN(),
                    'concepto' => $conceptosDeudas[array_rand($conceptosDeudas)], // Concepto aleatorio
                    'monto' => rand(50, 1000), // Monto aleatorio entre 50 y 1000
                    'fecha_generacion' => now()->subDays(rand(1, 60)), // Fecha aleatoria en los últimos 60 días
                ]);
            }
        
            // Conceptos aleatorios para pagos pendientes
            $conceptosPagos = [
                'Impuesto de vehículo',
                'Pago de matrícula universitaria',
                'Seguro de hogar',
                'Seguro de coche',
                'Pago de gimnasio',
                'Suscripción a streaming',
                'Pago de comunidad',
            ];
        
            // Generar entre 3 y 7 pagos pendientes por cuenta
            for ($i = 0; $i < rand(3, 7); $i++) {
                PagoPendiente::create([
                    'cuenta_id' => $cuenta->id,
                    'num_cuenta_destino' => $this->generarIBAN(),
                    'concepto' => $conceptosPagos[array_rand($conceptosPagos)], // Concepto aleatorio
                    'monto' => rand(50, 1000), // Monto aleatorio entre 50 y 1000
                    'fecha_vencimiento' => now()->addDays(rand(1, 60)), // Fecha aleatoria en los próximos 60 días
                ]);
            }
        }
    }

    private function generarIBAN()
    {
        do {
            $codigoPais = 'ES';
            $codigoControl = str_pad(random_int(0, 99), 2, '0', STR_PAD_LEFT);
            $numeroCuenta = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT) .
                            str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT) .
                            str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            $iban = $codigoPais . $codigoControl . $numeroCuenta;
        } while (CuentaBancaria::where('num_cuenta', $iban)->exists());

        return $iban;
    }
}
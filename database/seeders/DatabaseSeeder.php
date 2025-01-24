<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\factories\UserFactory;
use App\Models\Medicos;
use App\Models\Rescatados;
use App\Models\Rescates;
use App\Models\Tripulantes;
use App\Models\Viajes;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {   
    User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);
    User::factory()->create([
        'name' => 'Aimar',
        'email' => 'aimar@example.com',
    ]);
    
    User::factory(10)->create();

        // Crear 5 médicos
        $medicos = [];
        for ($i = 1; $i <= 5; $i++) {
            $medicos[] = Medicos::create([
                'nombre' => "Medico$i",
                'apellido' => "Apellido$i",
                'fecha_incorporacion' => now()->subDays(rand(100, 1000)),
                'fecha_baja' => null,
            ]);
        }

        // Crear 5 viajes
        $ciudadesEspana = ['Barcelona', 'Valencia', 'Algeciras', 'Málaga', 'Las Palmas'];
        $destinos = ['Casablanca', 'Tánger', 'Dakar', 'Trípoli', 'Mogadiscio', 'Mumbai'];
        $viajes = [];
        for ($i = 1; $i <= 5; $i++) {
            $viajes[] = Viajes::create([
                'origen' => $ciudadesEspana[array_rand($ciudadesEspana)],
                'destino' => $destinos[array_rand($destinos)],
                'fecha_hora' => now()->subDays(rand(1, 100)),
            ]);
        }

        // Crear 10 tripulantes
        $roles = ['Capitán', 'Jefe de Máquinas', 'Mecánico', 'Oficial de Puente', 'Marineros', 'Personal de enfermería'];
        $tripulantes = [];
        for ($i = 1; $i <= 10; $i++) {
            $tripulantes[] = Tripulantes::create([
                'nombre' => "Tripulante$i",
                'apellido' => "Apellido$i",
                'rol' => $roles[array_rand($roles)],
                'fecha_incorporacion' => now()->subDays(rand(100, 1000)),
                'fecha_baja' => null,
            ]);
        }

        // Crear 5 rescates
        $rescates = [];
        foreach ($viajes as $viaje) {
            $rescates[] = Rescates::create([
                'fecha_hora_inicio' => now()->subHours(rand(1, 10)),
                'fecha_hora_fin' => now(),
                'viajes_id' => $viaje->id,
            ]);
        }

        // Crear 20 rescatados
        $procedencias = [
            'Somalia' => ['nombres' => ['Abdi', 'Ahmed', 'Fatima', 'Khadija', 'Omar'], 'apellidos' => ['Ali', 'Hassan', 'Yusuf', 'Mohamed', 'Nur']],
            'Eritrea' => ['nombres' => ['Tekle', 'Haben', 'Senait', 'Merhawit', 'Dawit'], 'apellidos' => ['Tesfaye', 'Gebre', 'Kidan', 'Welde', 'Hagos']],
            'Sudán' => ['nombres' => ['Mustafa', 'Salma', 'Khalid', 'Amani', 'Othman'], 'apellidos' => ['Abdel', 'Hussein', 'Mahdi', 'Fadl', 'Ibrahim']],
            'Bangladés' => ['nombres' => ['Arif', 'Shila', 'Farhan', 'Nadia', 'Hasan'], 'apellidos' => ['Rahman', 'Khan', 'Chowdhury', 'Islam', 'Ahmed']],
            'Siria' => ['nombres' => ['Hadi', 'Layla', 'Ziad', 'Nour', 'Tariq'], 'apellidos' => ['Haddad', 'Salem', 'Aziz', 'Darwish', 'Fahmy']],
        ];
        
        for ($i = 1; $i <= 20; $i++) {
            $procedencia = array_rand($procedencias); // Selecciona un país aleatorio
            $nombres = $procedencias[$procedencia]['nombres'];
            $apellidos = $procedencias[$procedencia]['apellidos'];
        
            Rescatados::create([
                'nombre' => $nombres[array_rand($nombres)], // Nombre típico del país seleccionado
                'apellido' => $apellidos[array_rand($apellidos)], // Apellido típico del país seleccionado
                'foto' => null,
                'edad' => rand(1, 80),
                'sexo' => rand(0, 1) ? 'Masculino' : 'Femenino',
                'procedencia' => $procedencia, // País de procedencia
                'valoracion_medica' => 'Estable',
                'medicos_id' => $medicos[array_rand($medicos)]->id,
                'rescates_id' => $rescates[array_rand($rescates)]->id,
            ]);
        }
        
        }
    }


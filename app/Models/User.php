<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// use HasFactory, Notifiable, HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Permission::create(['name'=>'crear entidad']);
    // Permission::create(['name'=>'editar entidad']);
    // Permission::create(['name'=>'añadir entidad']);
    // Permission::create(['name'=>'ver entidad']);

    // $role = Role::create(['name'=>'editor']);
    // $role-> givePermissionTo[('crear entidad','editar entidad','añadir entidad')];

    // $role = Role::create(['name'=>'visor']);
    // $role->givePermission(['name'=>'ver entidad']);

    // $user = User::find(1);
    // $user = assignRole('editor');
}

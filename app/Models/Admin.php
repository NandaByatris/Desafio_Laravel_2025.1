<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     * 
     */

    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password', 
        'imagem',
        'endereco',
        'telefone',
        'data_nascimento',
        'is_admin',
        'role', 
    ];

    /**
    
     * Verifica se o usuário é um administrador.
     *
     * @return bool
     */

}
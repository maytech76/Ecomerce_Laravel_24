<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'type',
        'description',
        'district',
        'reference',
        'receiver',
        'receiver_info',
        'default',
    ];
/* 
    Casteamos el campo receiver_info, la cual recibirar un array y lo convierte a formato Json para almacenarlos en la DB,
    al solicitarlo con alguna consulta lo descodifica de Json -> Array */
    protected $casts = [
        'receiver_info' => 'array',
        'default' => 'boolean', 
    ];
}

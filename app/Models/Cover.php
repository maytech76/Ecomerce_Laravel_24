<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;



class Cover extends Model
{
    use HasFactory;

    protected $fillable = [

        'image_path',
        'title',
        'star_at',
        'end_at',
        'is_active',
    ];

    protected $casts = [

        'star_at'   => 'datatime',
        'end_at'    => 'datatime',
        'is_active' => 'boolean',
    ];

    /* Creamos un Accesor para image */
    protected function image(): Attribute
    {
      /* Retorname una url a partir del campo image_path */
      return Attribute::make(
        get: fn() => Storage::url($this->image_path),
      );
    }
}

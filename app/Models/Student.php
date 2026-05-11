<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'prodi',
        'angkatan',
        'jenis_kelamin',
        'status_lulus',
    ];

    protected $casts = [
        'status_lulus' => 'boolean',
        'angkatan'     => 'integer',
    ];
}
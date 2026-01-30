<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Karyawan extends Model
{
    //
    use HasFactory;

    protected $table='karyawan';
    protected $fillable = ['nik','nama','jk','asal','tgl_lahir','alamat','file'];

    protected $casts = [
        'tgl_lahir' => 'date',
    ];

    protected function tglLahir(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => \Carbon\Carbon::parse($value)->format('d-m-Y'),
            set: fn ($value) => \Carbon\Carbon::parse($value)->format('Y-m-d'),
        );
    }

    public function user() :HasOne 
    {
        return $this->hasOne(User::class,'id_karyawan','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input3 extends Model
{
    use HasFactory;
    protected $table = "input3"; // Eloquent akan membuat model Barang menyimpan record di tabel barang
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable. *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'temp_water_in',
        'temp_water_out',
        'temp_oil_in',
        'temp_oil_out',
        'vacum',
        'injector',
        'speed_drop',
        'load_limit',
        'flo_in',
        'flo_out',
    ];
    protected $casts = [
        'temp_water_in' => 'double',
        'temp_water_out' => 'double',
        'temp_oil_in' => 'double',
        'temp_oil_out' => 'double',
        'vacum' => 'double',
        'injector' => 'double',
        'speed_drop' => 'double',
        'load_limit' => 'double',
        'flo_in' => 'double',
        'flo_out' => 'double',
    ];
    protected $hidden = [
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input2 extends Model
{
    use HasFactory;
    protected $table = "input2"; // Eloquent akan membuat model Barang menyimpan record di tabel barang
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable. *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'turbin_speed',
        'rotor_vib_monitor',
        'axial_displacement_monitor',
        'main_steam',
        'stage_steam',
        'exhaust',
        'lub_oil',
        'control_oil',
    ];
    protected $casts = [
        'turbin_speed' => 'double',
        'rotor_vib_monitor' => 'double',
        'axial_displacement_monitor' => 'double',
        'main_steam' => 'double',
        'stage_steam' => 'double',
        'exhaust' => 'double',
        'lub_oil' => 'double',
        'control_oil' => 'double',
    ];
    protected $hidden = [
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

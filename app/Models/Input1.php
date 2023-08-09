<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input1 extends Model
{
    use HasFactory;
    protected $table = "input1"; // Eloquent akan membuat model Barang menyimpan record di tabel barang
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable. *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'inlet_steam',
        'exm_steam',
        'turbin_thrust_bearing',
        'tb_gov_side',
        'tb_coup_side',
        'pb_tbn_side',
        'pb_gen_side',
        'wb_tbn_side',
        'wb_gen_side',
        'oc_lub_oil_outlet',
    ];
    protected $casts = [
        'inlet_steam' => 'double',
        'exm_steam' => 'double',
        'turbin_thrust_bearing' => 'double',
        'tb_gov_side' => 'double',
        'tb_coup_side' => 'double',
        'pb_tbn_side' => 'double',
        'pb_gen_side' => 'double',
        'wb_tbn_side' => 'double',
        'wb_gen_side' => 'double',
        'oc_lub_oil_outlet' => 'double',
    ];
    protected $hidden = [
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

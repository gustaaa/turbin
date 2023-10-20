<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Input1 extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'status',
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
        'status' => 'integer',
    ];

    // Tambahkan mutator untuk kolom "status"
    public function setStatusAttribute($value)
    {
        $columns = [
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

        $allColumnsAreZero = true;

        foreach ($columns as $column) {
            if ($this->$column != 0) {
                $allColumnsAreZero = false;
                break;
            }
        }

        $this->attributes['status'] = $allColumnsAreZero ? 0 : 1;
    }

    protected $hidden = [
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function report()
    {
        return $this->hasMany(Report::class);
    }
}

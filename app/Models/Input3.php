<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Input3 extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
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
        'status',
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
        'status' => 'integer',
    ];
    // Tambahkan mutator untuk kolom "status"
    public function setStatusAttribute($value)
    {
        $columns = [
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

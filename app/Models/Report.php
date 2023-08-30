<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Report extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "report"; // Eloquent akan membuat model Barang menyimpan record di tabel barang
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable. *
     * @var array
     */
    protected $fillable = [
        'id',
        'id_input1',
        'id_input2',
        'id_input3',
    ];
    public function input1()
    {
        return $this->belongsTo(Input1::class, 'id_input1');
    }
    public function input2()
    {
        return $this->belongsTo(Input2::class, 'id_input2');
    }
    public function input3()
    {
        return $this->belongsTo(Input3::class, 'id_input3');
    }
}

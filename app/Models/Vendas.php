<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    use HasFactory;
    protected $table ="venda";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_cliente',
        'id_vendedor',
        'total_venda',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaBancaria extends Model
{
    use HasFactory; 

    protected $table = 'contas_bancarias';

    protected $fillable = [ 'banco', 'agencia', 'conta',  'tipo',  'estabelecimento_id',];
        
        
        
       
       


    public function estabelecimento()
    {
        return $this->belongsTo(Estabelecimento::class);
    }
}

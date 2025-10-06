<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estabelecimento extends Model
{
    protected $fillable = ['nome_fantasia','razao_social','cnpj','cliente_id'];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function contas() {
        return $this->hasMany(ContaBancaria::class);
    }
}
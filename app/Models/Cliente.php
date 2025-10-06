<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nome','cpf_cnpj','email','telefone','endereco'];

    public function estabelecimentos() {
        return $this->hasMany(Estabelecimento::class);
    }
}
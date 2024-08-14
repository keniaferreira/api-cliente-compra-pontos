<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Define os campos que podem ser atribuídos em massa (mass assignment)
    protected $fillable = ['nome', 'email', 'saldo_pontos'];

    // Relacionamento "um para muitos" com o modelo Compra
    // Um cliente pode ter várias compras associadas a ele
    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    // Relacionamento "um para muitos" com o modelo Resgate
    // Um cliente pode ter vários resgates de prêmios associados a ele
    public function resgates()
    {
        return $this->hasMany(Resgate::class);
    }
}

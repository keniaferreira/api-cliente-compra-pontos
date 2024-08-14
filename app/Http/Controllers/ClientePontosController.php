<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Mail;
use App\Mail\PremioResgatado;
use App\Mail\PontosGanhos;
use Exception;

class ClientePontosController extends Controller
{
    public function saldo($id)
    {

        try {
            $cliente = Cliente::find($id);

            if (!$cliente) {
                return response()->json(['message' => 'Cliente não encontrado'], 404);
            }

            $pontos = $cliente->saldo_pontos;
            $resgates = $cliente->resgates;

            return response()->json([
                'pontos' => $pontos,
                'resgates' => $resgates
            ]);
            
        } catch (Exception $e) {
            return response()->json([ $e->getMessage()]);
        }
        
    }

    public function resgatar(Request $request, $id)
    {
        try {
            $cliente = Cliente::find($id);

            if (!$cliente) {
                return response()->json(['message' => 'Cliente não encontrado'], 404);
            }

            $premio = $request->input('premio');
            $pontosNecessarios = $this->getPontosNecessarios($premio);

            if ($cliente->saldo_pontos < $pontosNecessarios) {
                return response()->json(['message' => 'Saldo insuficiente para resgatar o prêmio'], 400);
            }

            // Reduz o saldo de pontos e cria o registro de resgate
            $cliente->saldo_pontos -= $pontosNecessarios;
            $cliente->save();

            $cliente->resgates()->create([
                'premio' => $premio,
                'pontos_gastos' => $pontosNecessarios,
                'data' => now(),
            ]);

            // Enviar e-mail
            Mail::to($cliente->email)->send(new PremioResgatado($premio, $pontosNecessarios));
            return response()->json(['message' => 'Prêmio resgatado com sucesso']);
            
        } catch (Exception $e) {
            return response()->json([ $e->getMessage()]);
        }
        
    }

    private function getPontosNecessarios($premio)
    {
        try {
            $premios = [
                'Suco de Laranja' => 5,
                '10% de desconto' => 10,
                'Almoço especial' => 20
            ];

            return $premios[$premio] ?? 0;
            
        } catch (Exception $e) {
            return response()->json([ $e->getMessage()]);
        }
        
    }

    public function pontuar(Request $request, $id)
    {
        try {
            $cliente = Cliente::find($id);

            if (!$cliente) {
                return response()->json(['message' => 'Cliente não encontrado'], 404);
            }

            $valorGasto = $request->input('valor_gasto');

            if ($valorGasto < 5) {
                return response()->json(['message' => 'O valor gasto deve ser pelo menos R$5,00'], 400);
            }

            $pontosGanhos = intdiv($valorGasto, 5);
            $cliente->saldo_pontos += $pontosGanhos;
            $cliente->save();

            // Enviar e-mail
            Mail::to($cliente->email)->send(new PontosGanhos($pontosGanhos));
            return response()->json([
                'message' => 'Pontos adicionados com sucesso',
                'pontos_ganhos' => $pontosGanhos
            ]);
            
        } catch (Exception $e) {
            return response()->json([ $e->getMessage()]);
        }
        
    }


}
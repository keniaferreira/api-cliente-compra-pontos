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
    /**
     * Retorna o saldo de pontos e os resgates de um cliente específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function saldo($id)
    {
        try {
            // Encontra o cliente pelo ID
            $cliente = Cliente::find($id);

            // Retorna mensagem de erro se o cliente não for encontrado
            if (!$cliente) {
                return response()->json(['message' => 'Cliente não encontrado'], 404);
            }

            // Obtém o saldo de pontos e os resgates do cliente
            $pontos = $cliente->saldo_pontos;
            $resgates = $cliente->resgates;

            // Retorna o saldo e resgates em formato JSON
            return response()->json([
                'pontos' => $pontos,
                'resgates' => $resgates
            ]);
            
        } catch (Exception $e) {
            // Retorna uma resposta JSON com a mensagem de erro em caso de exceção
            return response()->json([$e->getMessage()]);
        }
    }

    /**
     * Permite que um cliente resgate um prêmio, se tiver pontos suficientes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function resgatar(Request $request, $id)
    {
        try {
            // Encontra o cliente pelo ID
            $cliente = Cliente::find($id);

            // Retorna mensagem de erro se o cliente não for encontrado
            if (!$cliente) {
                return response()->json(['message' => 'Cliente não encontrado'], 404);
            }

            // Obtém o prêmio solicitado e calcula os pontos necessários
            $premio = $request->input('premio');
            $pontosNecessarios = $this->getPontosNecessarios($premio);

            // Verifica se o cliente tem pontos suficientes para o prêmio
            if ($cliente->saldo_pontos < $pontosNecessarios) {
                return response()->json(['message' => 'Saldo insuficiente para resgatar o prêmio'], 400);
            }

            // Reduz o saldo de pontos e registra o resgate
            $cliente->saldo_pontos -= $pontosNecessarios;
            $cliente->save();

            $cliente->resgates()->create([
                'premio' => $premio,
                'pontos_gastos' => $pontosNecessarios,
                'data' => now(),
            ]);

            // Envia um e-mail notificando sobre o prêmio resgatado
            Mail::to($cliente->email)->send(new PremioResgatado($premio, $pontosNecessarios));
            return response()->json(['message' => 'Prêmio resgatado com sucesso']);
            
        } catch (Exception $e) {
            // Retorna uma resposta JSON com a mensagem de erro em caso de exceção
            return response()->json([$e->getMessage()]);
        }
    }

    /**
     * Calcula a quantidade de pontos necessários para um prêmio específico.
     *
     * @param  string  $premio
     * @return int
     */
    private function getPontosNecessarios($premio)
    {
        try {
            // Mapeia prêmios para a quantidade de pontos necessários
            $premios = [
                'Suco de Laranja' => 5,
                '10% de desconto' => 10,
                'Almoço especial' => 20
            ];

            // Retorna a quantidade de pontos para o prêmio ou 0 se não estiver listado
            return $premios[$premio] ?? 0;
            
        } catch (Exception $e) {
            // Retorna 0 em caso de exceção
            return 0;
        }
    }

    /**
     * Adiciona pontos ao saldo de um cliente baseado no valor gasto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function pontuar(Request $request, $id)
    {
        try {
            // Encontra o cliente pelo ID
            $cliente = Cliente::find($id);

            // Retorna mensagem de erro se o cliente não for encontrado
            if (!$cliente) {
                return response()->json(['message' => 'Cliente não encontrado'], 404);
            }

            // Obtém o valor gasto da requisição
            $valorGasto = $request->input('valor_gasto');

            // Verifica se o valor gasto é suficiente para acumular pontos
            if ($valorGasto < 5) {
                return response()->json(['message' => 'O valor gasto deve ser pelo menos R$5,00'], 400);
            }

            // Calcula a quantidade de pontos ganhos e atualiza o saldo
            $pontosGanhos = intdiv($valorGasto, 5);
            $cliente->saldo_pontos += $pontosGanhos;
            $cliente->save();

            // Envia um e-mail notificando sobre os pontos ganhos
            Mail::to($cliente->email)->send(new PontosGanhos($pontosGanhos));
            return response()->json([
                'message' => 'Pontos adicionados com sucesso',
                'pontos_ganhos' => $pontosGanhos
            ]);
            
        } catch (Exception $e) {
            // Retorna uma resposta JSON com a mensagem de erro em caso de exceção
            return response()->json([$e->getMessage()]);
        }
    }
}
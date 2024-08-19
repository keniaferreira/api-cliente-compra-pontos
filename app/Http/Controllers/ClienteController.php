<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Exception;

class ClienteController extends Controller
{
    /**
     * Armazena um novo cliente no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Valida os dados recebidos na requisição
            $validated = $request->validate([
                'nome' => 'required|string|max:255',  // O campo 'nome' é obrigatório, deve ser uma string com até 255 caracteres
                'email' => 'required|email|max:255'  // O campo 'email' é obrigatório, deve ser uma string com até 255 caracteres
            ]);

            // Cria um novo cliente com os dados validados
            $cliente = Cliente::create($validated);

            // Retorna a resposta JSON com o cliente criado e o status HTTP 201 (Criado)
            return response()->json($cliente, 201);
            
        } catch (Exception $e) {
            // Retorna uma resposta JSON com a mensagem de erro se uma exceção ocorrer
            return response()->json([$e->getMessage()]);
        }
    }

    /**
     * Exibe um cliente específico pelo ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            // Busca o cliente pelo ID fornecido
            $cliente = Cliente::find($id);

            // Se o cliente não for encontrado, retorna uma mensagem de erro com o status HTTP 404 (Não Encontrado)
            if (!$cliente) {
                return response()->json(['message' => 'Cliente não encontrado'], 404);
            }

            // Retorna a resposta JSON com os dados do cliente encontrado
            return response()->json($cliente);
            
        } catch (Exception $e) {
            // Retorna uma resposta JSON com a mensagem de erro se uma exceção ocorrer
            return response()->json([$e->getMessage()]);
        }
    }

    /**
     * Lista todos os clientes cadastrados.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            // Recupera todos os clientes do banco de dados
            $clientes = Cliente::all();

            // Retorna a resposta JSON com a lista de clientes
            return response()->json($clientes);

        } catch (Exception $e) {
            // Retorna uma resposta JSON com a mensagem de erro se uma exceção ocorrer
            return response()->json([$e->getMessage()]);
        }
    }
}
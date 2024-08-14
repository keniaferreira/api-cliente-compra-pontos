<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Exception;

class ClienteController extends Controller
{
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'nome' => 'required|string|max:255',
                'email' => 'required|string|max:255'
            ]);

            $cliente = Cliente::create($validated);

            return response()->json($cliente, 201);
            
        } catch (Exception $e) {
            return response()->json([ $e->getMessage()]);
        }
        
    }

    public function show($id)
    {
        try {
            $cliente = Cliente::find($id);

            if (!$cliente) {
                return response()->json(['message' => 'Cliente não encontrado'], 404);
            }

            return response()->json($cliente);
            
        } catch (Exception $e) {
            return response()->json([ $e->getMessage()]);
        }
        
    }

    public function index()
    {
        try {

            $clientes = Cliente::all();
            return response()->json($clientes);

        } catch (Exception $e) {
            return response()->json([ $e->getMessage()]);
        }
        
    }

}

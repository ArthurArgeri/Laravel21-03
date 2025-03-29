<?php

namespace App\Http\Controllers;

use App\Models\criptomoedas;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CriptomoedasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //buscando todas criptomoedas
        $registros = Criptomoedas::all();

        //contando o número de registros
        $contador = $registros->count();

        //Verificando se há registros
        if($contador > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Criptomoedas encontradas com sucesso',
                'data' => $registros,
                'total' => $contador
            ], 200); //Retorna HTTP 200 (OK) com os dados e a contagem
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Nenhuma criptomoeda encontrada',
            ], 404); //Retorna HTTP 404 (Not Found) se não houver registros
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validação de Dados
        $validator = Validator::make($request->all(), [
            'sigla' => 'required',
            'nome' => 'required',
            'valor' => 'required'
        ]);

        //Validação para falhas
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400); //Retorna HTTP 400 (Bad Request) se houver erro de validação
        }

        $registros = Criptomoedas::create($request->all());

        if ($registros) {
            return response()->json([
                'success' => true,
                'message' => 'Criptomoeda cadastrada com sucesso!',
                'data' => $registros
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar a criptomoeda'
            ], 500); //Retorna HTTP 500 (Internal Server Error) se o cadastro falhar
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $registros = Criptomoedas::find($id);

        if($registros) {
            return response()->json([
                'success' => true,
                'message' => 'Criptomoeda localizada com sucesso',
                'data' => $registros
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Criptomoeda não localizada.',
            ], 404); //Retorna HTTP 404 (Not Found) se a criptomoeda não for encontrada
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'sigla' => 'required',
            'nome' => 'required',
            'valor' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400); //retorna HTTP 400 se houver erro de validação
        }

        $registrosBanco = Criptomoedas::find($id);

        if (!$registrosBanco) {
            return response()->json([
                'success' => false,
                'message' => 'Criptomoeda não encontrada'
            ], 404);
        }

        $registrosBanco->sigla = $request->sigla;
        $registrosBanco->nome = $request->nome;
        $registrosBanco->valor = $request->valor;

        if($registrosBanco->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Criptomoeda atualizado com sucesso',
                'data' => $registrosBanco
            ], 200); //Retorna HTTP 200 se a atualização for bem-sucedida
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar a criptomoeda'
            ], 500); //Retorna HTTP 500 se houver erro ao salvar
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registros = Criptomoedas::find($id);

        if(!$registros) {
            return response()->json([
                'success' => false,
                'message' => 'Criptomoeda não encontrado',
            ], 404); //Retorna HTTP 404 se a criptomoeda não for encontrado
        }

        // Deletando a criptomoeda
        if($registros->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Criptomoeda deletado com sucesso'
            ], 200); //retorna HTTP 200 se a exclusão for bem-sucedida
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao deletar a criptomoeda'
        ], 500); //Retorn HTTP 500 se houver erro ao deletar

        
    }
}



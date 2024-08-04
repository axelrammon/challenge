<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TurmasController extends Controller {
    public function index() {
        $turmas = Turma::all();
        
        return response()->json(['data'=>$turmas]);
    }

    public function store(Request $request) {
    
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'ano' => 'required|integer',
            'periodo' => 'required|in:matutino,vespertino,noturno',
            // Adicione outras regras de validação conforme necessário
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        $turma = Turma::create([
            'nome' => $request->input('nome'),
            'ano' => $request->input('ano'),
            'periodo' => $request->input('periodo'),
        ]);
        return response()->json([
            'data' => $turma
        ], 201);
        
    }

    public function show(Turma $turma) {
        $turma->load('alunos');
        return response()->json(['data'=>$turma]);
    }

    public function update(Request $request, Turma $turma) {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'ano' => 'required|integer',
            'periodo' => 'required|in:matutino,vespertino,noturno'
                ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $turma->update($request->only(['nome', 'ano', 'periodo']));

        return response()->json([
            'data' => $turma
        ], 200);
    }

    public function destroy(Turma $turma) {
        $turma->delete();
        return response()->json([
            'message' => 'Turma apagada'
        ], 200);
    }
    
}

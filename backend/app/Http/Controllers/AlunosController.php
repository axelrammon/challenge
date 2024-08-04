<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlunosController extends Controller {
    public function index() {
        $alunos = Aluno::all();
        
        return response()->json(['data'=>$alunos]);
    }

    public function store(Request $request) {
    
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|string',
            'data_nascimento' => 'required|date',
            'turma_id' => 'required|exists:turmas,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        $aluno = Aluno::create([
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'data_nascimento' => $request->input('data_nascimento'),
            'turma_id' => $request->input('turma_id'),
        ]);
        return response()->json([
            'data' => $aluno
        ], 201);
        
    }

    public function show(Aluno $aluno) {
        return response()->json(['data'=>$aluno]);
    }

    public function update(Request $request, Aluno $aluno) {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|string',
            'data_nascimento' => 'required|date',
            'turma_id' => 'required|exists:turmas,id',
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

        $aluno->update($request->only(['nome', 'email', 'data_nascimento', 'turma_id']));

        return response()->json([
            'data' => $aluno
        ], 200);
    }

    public function destroy(Aluno $aluno) {
        $aluno->delete();
        return response()->json([
            'message' => 'Aluno apagado'
        ], 200);
    }
}

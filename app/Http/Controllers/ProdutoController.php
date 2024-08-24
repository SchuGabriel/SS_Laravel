<?php

namespace App\Http\Controllers;

use App\Models\Cod_Similar;
use App\Models\Grupo;
use App\Models\Grupo_Produto;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('cod_similar')->get();

        return view('produtos', [
            'produtos' => $produtos,
        ]);
    }

    public function create()
    {
        $produto = new Produto();
        $cod_similar = new Cod_Similar();
        $grupos = Grupo::all();
        $grupo_id = null;

        return view('produto', [
            'produto' => $produto,
            'cod_similar' => $cod_similar,
            'grupos' => $grupos,
            'grupo_id' => $grupo_id,
        ]);
    }

    public function store(Request $request)
    {
        #Criacao do Produto
        $produto = new Produto();

        $produto->referencia = $request->input('referencia');
        $produto->nome = $request->input('nome');
        $produto->observacao = $request->input('observacao');
        $produto->quant_carro = $request->input('quant_carro');
        $produto->multiplo = $request->input('multiplo');

        $produto->save();

        # Criacao do Cod Similar
        $cod_similares = $request->input('cod_similar');
        $cod_similares_array = array_map('trim', explode(',', $cod_similares)); // Remove espaços em branco

        foreach ($cod_similares_array as $cod_similar_pos) {
            if (!empty($cod_similar_pos)) {
                $cod_similar = new Cod_Similar();
                $cod_similar->nome = $cod_similar_pos;
                $cod_similar->produto_id = $produto->id;
                $cod_similar->save();
            }
        }

        $grupo = new Grupo_Produto();
        $grupo->grupo_id = $request->input('grupo_id');
        $grupo->produto_id = $produto->id;
        $grupo->save();

        return redirect()->route('produto.index');
    }

    public function edit($id)
    {
        $produto = Produto::with('cod_similar', 'grupo')->findOrFail($id);
        $grupos = Grupo::all();
        $grupo_id = $produto->grupo->isNotEmpty() ? $produto->grupo->first()->pivot->grupo_id : null;

        return view('produto', [
            'produto' => $produto,
            'grupos' => $grupos,
            'grupo_id' => $grupo_id,
        ]);
    }

    public function update($id, Request $request)
    {
        // Carrega o produto e seus códigos similares
        $produto = Produto::with('cod_similar', 'grupo')->findOrFail($id);

        // Atualiza os dados do produto
        $produto->referencia = $request->input('referencia');
        $produto->nome = $request->input('nome');
        $produto->observacao = $request->input('observacao');
        $produto->quant_carro = $request->input('quant_carro');
        $produto->multiplo = $request->input('multiplo');
        $produto->save();

        // Obtém os códigos similares da requisição e divide por vírgulas
        $cod_similar_names = $request->input('cod_similar');
        $cod_similar_array = array_map('trim', explode(',', $cod_similar_names)); // Remove espaços em branco

        // Obtém os IDs existentes para comparação
        $existing_cod_similar_ids = $produto->cod_similar->pluck('id')->toArray();
        $new_cod_similar_ids = [];

        // Processa cada código similar
        foreach ($cod_similar_array as $name) {
            if (!empty($name)) {
                // Verifica se o código similar já existe
                $cod_similar = Cod_Similar::where('produto_id', $produto->id)
                    ->where('nome', $name)
                    ->first();

                if ($cod_similar) {
                    $new_cod_similar_ids[] = $cod_similar->id;
                } else {
                    // Cria um novo código similar
                    $new_cod_similar = new Cod_Similar();
                    $new_cod_similar->nome = $name;
                    $new_cod_similar->produto_id = $produto->id;
                    $new_cod_similar->save();
                    $new_cod_similar_ids[] = $new_cod_similar->id;
                }
            }
        }

        // Remove os códigos similares que não estão mais na lista
        $cod_similar_ids_to_delete = array_diff($existing_cod_similar_ids, $new_cod_similar_ids);

        foreach ($cod_similar_ids_to_delete as $id) {
            Cod_Similar::find($id)->delete();
        }

        $gruposSelecionados = $request->input('grupo_id', []);
        $produto->grupo()->sync($gruposSelecionados);

        return redirect()->route('produto.index');
    }



    public function destroy($id)
    {
        $produto = Produto::with('grupo', 'cod_similar')->find($id);

        if ($produto) {
            // Deleta todos os registros na tabela intermediária grupo_produto
            $produto->grupo()->detach();
    
            // Deleta todos os códigos similares associados
            $produto->cod_similar()->delete();
    
            // Finalmente, deleta o produto
            $produto->delete();
        }
    
        return redirect()->route('produto.index');
    }
}

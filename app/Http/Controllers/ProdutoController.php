<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::get();

        $produtoHeader =  $produtos->first();

        return view('produtos', compact('produtos','produtoHeader'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required',
            'descricao' => 'sometimes',
            'preco' => 'required',
            'preco_revenda' => 'required',
            'cor' => 'sometimes'
        ]);


        $data['preco'] = $this->formatPreco($data['preco']);
        $data['preco_revenda'] = $this->formatPreco($data['preco_revenda']);

        $data['quantidade'] = json_encode([
            'RN' => 0,
            'P' => 0,
            'M' => 0,
            'G' => 0,
            'GG' => 0
        ]);

        $product = Produto::create($data);

        return $product;
    }

    public function update(Request $request, $id)
    {
      
        $data = $request->validate([
            'nome' => 'required',
            'descricao' => 'sometimes',
            'preco' => 'required',
            'preco_revenda' => 'required',
            'cor' => 'sometimes'
        ]);

        $produto = Produto::find($id);


        $data['preco'] = $this->formatPreco($data['preco']);
        $data['preco_revenda'] = $this->formatPreco($data['preco_revenda']);

        $produto->update($data);

        return $produto;
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produtos.index')
            ->with('success', 'Produto excluído com sucesso.');
    }

    private function formatPreco($preco)
    {
        return str_replace(',', '.', $preco);
    }
}


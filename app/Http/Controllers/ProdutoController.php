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

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required',
            'descricao' => 'sometimes',
            'quantidade' => 'required|integer|min:0',
            'preco' => 'required',
            'preco_revenda' => 'required',
            'cor' => 'sometimes'
        ]);


        $data['preco'] = $this->formatPreco($data['preco']);
        $data['preco_revenda'] = $this->formatPreco($data['preco_revenda']);

        $product = Produto::create($data);

        return $product;
    }

    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, $id)
    {
      
        $data = $request->validate([
            'nome' => 'required',
            'descricao' => 'sometimes',
            'quantidade' => 'required|integer|min:0',
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
        // Remove espaços em branco, "R$" e caracteres indesejados
        return str_replace(',', '.', $preco);
    }
}


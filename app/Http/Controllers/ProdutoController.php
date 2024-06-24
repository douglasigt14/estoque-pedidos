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
            'quantidade' => 'required|integer|min:0',
            'preco' => 'required',
            'preco_revenda' => 'required',
        ]);


        $data['preco'] = $this->limparPreco($data['preco']);
        $data['preco_revenda'] = $this->limparPreco($data['preco_revenda']);

        dd($data);

        Produto::create($data);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto criado com sucesso.');
    }

    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required',
            'quantidade' => 'required|integer|min:0',
            'preco' => 'required|numeric|min:0',
        ]);

        $produto->update($request->all());

        return redirect()->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produtos.index')
            ->with('success', 'Produto excluído com sucesso.');
    }

    private function limparPreco($preco)
    {
        // Remove espaços em branco, "R$" e caracteres indesejados
        return str_replace('R$', '', $preco);
    }
}


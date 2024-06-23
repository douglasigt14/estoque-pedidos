@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endpush

@section('title', 'Lista de Produtos')

@section('content')
    <div class="container d-flex flex-column w-100">
                <div class="row d-flex justify-content-between">
                    <div> </div>
                    <div><a href="{{ route('produtos.create') }}" class="btn btn-primary mb-3">+</a></div>

                </div>
                <div class="d-flex w-100">
                    <table class="table w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Quantidade</th>
                                <th>Preço</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produtos as $produto)
                                <tr>
                                    <td>{{ $produto->id }}</td>
                                    <td>{{ $produto->nome }}</td>
                                    <td>{{ $produto->descricao }}</td>
                                    <td>{{ $produto->quantidade }}</td>
                                    <td>{{ $produto->preco }}</td>
                                    <td>
                                        <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                        <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
               
    </div>
@endsection

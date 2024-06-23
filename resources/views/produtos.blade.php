@extends('layouts.app')

@section('title', 'Lista de Produtos')

@section('content')
        <div class="row d-flex justify-content-between">
            <div><a href="{{ route('produtos.create') }}" class="btn btn-primary mb-3">+</a></div>

        </div>
        <div class="w-100">
            @if ($produtos->isEmpty())
                <div class="alert alert-info">Não há produtos cadastrados.</div>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            @foreach ($produtoHeader->toArray() as $key => $value)
                                <th @if ($produtoHeader->deveCentralizarCampo($key)) style="text-align: center;" @endif>
                                    {{ ucfirst( $produtoHeader->getField($key)) }}
                                </th>
                            @endforeach
                            <th>Editar</th>
                            <th>Apagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                @foreach ($produto->toArray() as $key => $value)
                                <td @if ($produto->deveCentralizarCampo($key)) style="text-align: center;" @endif>
                                    {{ $value }}
                                </td>
                                @endforeach
                                <td>
                                    <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                </td>
                                <td>
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
            @endif
        </div>
@endsection

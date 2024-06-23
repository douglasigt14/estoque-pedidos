@extends('layouts.app')

@section('title', 'Lista de Produtos')

@section('content')
        <div class="row content-header d-flex justify-content-between">
            <div></div>
            <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInserirProduto">
                +
              </button>
            </div>
        </div>
        <div class="w-100">
            @if ($produtos->isEmpty())
                <div class="alert alert-info">Não há produtos cadastrados.</div>
            @else
                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            @foreach ($produtoHeader->toArray() as $key => $value)
                                <th @if ($produtoHeader->deveCentralizarCampo($key)) style="text-align: center;" @endif>
                                    {{ ucfirst( $produtoHeader->getField($key)) }}
                                </th>
                            @endforeach
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
            @endif
        </div>


  <div class="modal fade" id="modalInserirProduto" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalInserirProdutoLabel">Inserir Novo Produto</h5>
      </div>
      <div class="modal-body">
        <form id="formInserirProduto">
          <div class="row">
            <!-- Nome do Produto -->
            <div class="col-md-12 mb-3">
              <label for="nome" class="form-label">Nome</label>
              <input autocomplete="off"  type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <!-- Descrição do Produto -->
            <div class="col-md-12 mb-3">
              <label for="descricao" class="form-label">Descrição</label>
              <textarea class="form-control" id="descricao" name="descricao"></textarea>
            </div>

            <!-- Preço do Produto -->
            <div class="col-md-6 mb-3">
              <label for="preco" class="form-label">Preço</label>
              <input type="text" class="form-control currency-input" id="preco" name="preco" pattern="[0-9]+(\.[0-9]{1,2})?" required>
            </div>

            <!-- Preço de Revenda -->
            <div class="col-md-6 mb-3">
              <label for="preco_revenda" class="form-label">Preço de Revenda</label>
              <input type="text" class="form-control currency-input" id="preco_revenda" name="preco_revenda" pattern="[0-9]+(\.[0-9]{1,2})?">
            </div>
            
            <!-- Quantidade do Produto -->
            <div class="col-md-6 mb-3">
              <label for="quantidade" class="form-label">Quantidade</label>
              <input type="number" class="form-control" id="quantidade" name="quantidade" required>
            </div>

            

            <!-- Cor do Produto -->
            <div class="col-md-6 mb-3">
              <label for="cor" class="form-label">Cor</label>
              <input type="text" class="form-control" id="cor" name="cor">
            </div>
          </div>

          <!-- Botões de Ação -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar Produto</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection


@push('scripts')

<script>
   document.addEventListener("DOMContentLoaded", function() {
      var inputs = document.querySelectorAll('.currency-input'); // Seleciona todos os inputs com a classe 'currency-input'

      inputs.forEach(function(input) {
        input.addEventListener('input', function(e) {
          var valor = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito
          var formato = Number(valor / 100).toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
          });

          e.target.value = formato;
        });
      });
   });
</script>
@endpush
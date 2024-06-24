@extends('layouts.app')

@section('title', 'Lista de Produtos')

@section('content')
        <div class="content-header d-flex justify-content-between">
            <div></div>
            <div>
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal" onclick="openModal()">
                +
              </button>
            </div>
        </div>
        <div class="w-100">
            @if ($produtos->isEmpty())
                <div class="alert alert-warning">Não há produtos cadastrados.</div>
            @else
                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            @foreach ($produtoHeader->toArray() as $key => $value)
                                <th @if ($produtoHeader->deveCentralizarCampo($key)) class="center" @endif>
                                    {{ ucfirst( $produtoHeader->getField($key)) }}
                                </th>
                            @endforeach
                            <th class="center">Apagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr onclick="openModal({{ json_encode($produto) }})">
                                @foreach ($produto->toArray() as $key => $value)
                                <td @if ($produto->deveCentralizarCampo($key)) class="center" @endif>
                                    {{ $value }}
                                </td>
                                @endforeach
                                <td class="center">
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


        <div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Inserir Novo Produto</h5>
              </div>
              <div class="modal-body">
                <form id="formInserirEditar" action='/produtos' method="POST">
                  @csrf
                  <div id="methodField"></div>
                  <div class="row">
                    <!-- Nome do Produto -->
                    <div class="col-md-12 mb-3">
                      <label for="nome" class="form-label">Nome</label>
                      <input autocomplete="off" type="text" class="form-control" id="nome" name="nome" required>
                    </div>

                    <!-- Descrição do Produto -->
                    <div class="col-md-12 mb-3">
                      <label for="descricao" class="form-label">Descrição</label>
                      <textarea class="form-control" id="descricao" name="descricao"></textarea>
                    </div>

                    <!-- Preço do Produto -->
                    <div class="col-md-6 mb-3">
                      <label for="preco" class="form-label">Preço</label>
                      <input type="text" class="form-control currency-input" id="preco" name="preco" required>
                    </div>

                    <!-- Preço de Revenda -->
                    <div class="col-md-6 mb-3">
                      <label for="preco_revenda" class="form-label">Preço de Revenda</label>
                      <input type="text" class="form-control currency-input" id="preco_revenda" name="preco_revenda" required>
                    </div>
                    
                    <!-- Quantidade do Produto -->
                    <div class="col-md-6 mb-3">
                      <label for="quantidade" class="form-label">Quantidade</label>
                      <input type="number" value="1" class="form-control" id="quantidade" name="quantidade" required>
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
<script src="{{ asset('js/uteis.js') }}"> </script>
<script>
  function openModal(produto = null) {
    const modal = $('#modal');
    const form = $('#formInserirEditar');
    const methodField = $('#methodField');

    if (produto) {
      // Preencher o formulário com os valores do produto para edição
      $('#modalLabel').text('Editar Produto');
      form.attr('action', `/produtos/${produto.id}`);
      methodField.html('@method('PUT')');
      
      $('#nome').val(produto.nome);
      $('#descricao').val(produto.descricao);
      $('#preco').val(produto.preco);
      $('#preco_revenda').val(produto.preco_revenda);
      $('#quantidade').val(produto.quantidade);
      $('#cor').val(produto.cor);
    } else {
      // Limpar o formulário para inserção de um novo produto
      $('#modalLabel').text('Inserir Novo Produto');
      form.attr('action', '/produtos');
      methodField.html('');
      
      $('#nome').val('');
      $('#descricao').val('');
      $('#preco').val('');
      $('#preco_revenda').val('');
      $('#quantidade').val(1);
      $('#cor').val('');
    }

    modal.modal('show');
  }
</script>
@endpush

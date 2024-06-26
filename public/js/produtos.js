function openModal(produto = null) {
    const modal = $('#modal');
    const form = $('#formInserirEditar');
    const methodField = $('#methodField');

    if (produto) {
      // Preencher o formulário com os valores do produto para edição
      $('#modalLabel').text('Editar Produto');
      form.attr('action', `/produtos/${produto.id}`);
      methodField.html('@method(\'PUT\')');
      
      $('#nome').val(produto.nome);
      $('#descricao').val(produto.descricao);
      $('#preco').val(produto.preco);
      $('#preco_revenda').val(produto.preco_revenda);
      $('#qtd').val(produto.qtd);
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
      $('#qtd').val(1);
      $('#cor').val('');
    }

    modal.modal('show');
  }
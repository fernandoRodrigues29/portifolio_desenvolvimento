<?php   $campo = $conteudo['campo']; ?>
<div class="row">
  <div class="col-lg-12">
    <div class="col-lg-4 col-lg-offset-3">
      <a href="cad" class="btn btn-lg btn-info btn-block">Cadastrar</a>
    </div>
  </div>

</div>
<br>
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
        <th scope="col">Produto</th>
        <th scope="col">Categoria</th>
        <th scope="col">Fornecedor</th>
      <th scope="col">editar</th>
      <th scope="col">X</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($conteudo['lista'] as $key => $value) {
    ?>
    <tr>
      <th scope="row"><?php echo $value['produto']->getId(); ?></th>
      <td><?php echo $value['produto']->getProduto(); ?></td>
      <td><?php echo $value['produto']->getCategoria()->getCategoria(); ?></td>
      <td><?php echo $value['produto']->getFornecedor()->getFornecedor(); ?></td>
      <td><a href="editar/id/<?php echo $value['produto']->getId(); ?>">editar</a></td>
      <td><a href="excluir/id/<?php echo $value['produto']->getId(); ?>">x</a></td>
    </tr>

    <?php
      }
    ?>
  </tbody>
</table>
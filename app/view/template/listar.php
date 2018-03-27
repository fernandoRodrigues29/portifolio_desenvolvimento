<?php   $campo = $conteudo['campo']; ?>
<div class="row">
   <?php 
        if(isset($_SESSION['msg'])){
          $msg = $_SESSION['msg'];
        ?>
       <div class="col-lg-6 col-lg-offset-3"> 
         <div class="alert alert-info">
            <strong><?php echo $msg; ?></strong> 
         </div>
       </div>
       <?php
          unset($_SESSION['msg']);
          } 
        ?>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="col-lg-4 col-lg-offset-3">
      <a href="cad" class="btn btn-lg btn-info btn-block">Cadastrar</a>
    </div>
  </div>
</div>
<br>
<div class="row">
  <div class="col-lg-12">

<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col"><?php echo $conteudo['titulo'];?></th>
      <th scope="col">editar</th>
      <th scope="col">X</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($conteudo['lista'] as $key => $value) {
    ?>
    <tr>
      <th scope="row"><?php echo $value['id']; ?></th>
      <td><?php echo $value[$campo]; ?></td>
      <td><a href="editar/id/<?php echo $value['id']; ?>">editar</a></td>
      <td><a href="excluir/id/<?php echo $value['id']; ?>">x</a></td>
    </tr>
    <?php
      }
    ?>
  </tbody>
</table>
</div>
</div>
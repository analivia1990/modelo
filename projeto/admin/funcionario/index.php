<?php
// configurações gerais do site
require_once 'config.php';
$msg = get_mensagem();




try 
{
  if (isset($_GET['excluir'])) 
  {
    $id = filter_var($_GET['excluir'], FILTER_VALIDATE_INT);
    if ($id === false or $id <= 0) 
    {
      throw new Exception('ID fornecido é inválido');
    }

    if (!excluir_funcionario($id)) {

      throw new Exception('nao foi possivel excluir');
    }

    set_mensagem('Funcionario excluido com sucesso', 'alert-success', 'index.php');
  }
} 
catch (Exception $e) {
  set_mensagem($e->getMessage(), 'alert-danger', 'index.php');
}

$lista_funcionario = get_funcionarios();


// configuração da pagina
$titulo_pagina = "Adm | Funcionário";
$link_ativo = 'funcionario';
require_once 'includes/header-admin.php';



?>


<!-- CONTEUDO -->
<div class="jumbotron container p-5 mb-5">
  <h1 class="h2 float-left">Funcionário</h1>
  <a href="adicionar.php" class="btn btn-success float-right">
    Novo Funcionário
  </a>
  <div class="clearfix"></div>
  <hr>
  <p class="lead mb-0">
    Confira abaixo todos os colaboradores cadastrados no time da sua empresa.
  </p>
</div>
<div class="container">
  <?php include "templates/alert-mensagens.php"; ?>

  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>

        <th scope="col">#</th>
        <th scope="col">Foto</th>
        <th scope="col">Nome completo</th>

        <th scope="col">CPF</th>

        <th scope="col">Cargo</th>
        <th scope="col">Telefone</th>
        <th scope="col">Ativo?</th>
        <th scope="col" width="10%"></th>

      </tr>
    </thead>
    <tbody>

      <?php foreach ($lista_funcionario as $funcionario) : ?>

        <tr>
          <th scope="row"><?= $funcionario['id_func'] ?></th>
          <td> <img src="<?= get_imagem_url($funcionario['foto_func']) ?>" width="100" class="img-responsive"></td>
          <td><?= $funcionario['nome'] ?></td>
          <td><?= $funcionario['cpf_func'] ?></td>
          <th scope="row" width="5%"></th>
          <td><?= $funcionario['cargo'] ?></td>
          <td><?= $funcionario['tel_func'] ?></td>
          <td><?= $funcionario['ativo'] ? 'SIM' : 'NAO' ?></td>
          <td>
            <a href="editar.php?id=<?= $funcionario['id_func'] ?>" class="btn btn-success" title="Editar">
              <i class="far fa-edit"></i>
            </a>
          </td>
          <td>
            <a href="index.php?excluir=<?= $funcionario['id_func'] ?>" class="btn btn-danger" title="Excluir">
              <i class="far fa-trash-alt"></i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>


<?php require_once 'includes/footer-admin.php'; ?>
<?php
// configurações gerais do site
require_once 'config.php';
$msg = get_mensagem();
$funcionario_info = array();


try {
    if (isset($_POST['atualizar_funcionario'])) {


        $id = filter_var($_POST['id_func'], FILTER_VALIDATE_INT);
        $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $cpf = filter_var($_POST['cpf_func'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $tel = filter_var($_POST['tel_func'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $cargo = filter_var($_POST['cargo'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $ativo = (bool) ($_POST['ativo'] ?? false);
        $senha = filter_var($_POST['senha'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $confirmacao_senha = filter_var($_POST['confirmacao'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $foto = $_FILES['foto_func']['name'] ? $_FILES['foto_func'] : $_POST['foto_atual'];

        if ($foto and is_array($foto)) {
            $nome_arquivo = upload_imagem($foto, 'funcionario');
            $foto = 'funcionario/' . $nome_arquivo;
        }

        if ($id === false or $id <= 0) {
            throw new Exception('id invalido');
        }

        if (!$nome) {
            throw new Exception(' Nome necessário');
        }
        if (!$cpf) {
            throw new Exception('Cpf Necessário');
        }
        if (!$tel) {
            throw new Exception('telefone necessário');
        }
        if (!$cargo) {
            throw new Exception('cargo necessário');
        }

        if ($senha) {
            if ($senha != $confirmacao_senha or !$confirmacao_senha) {
                throw new Exception('é Necessário digitar senha e confirmação, e necessitam ser iguais.');
            }
        }

        if (!atualizar_funcionario($nome, $cpf, $tel, $foto, $cargo, $ativo, $senha,  $id)) {
            throw new Exception('Não foi possivel atualizar');
        }
        set_mensagem('funcionário atualizado com sucesso', 'alert-success');

        if (isset($_GET['id'])) {
            $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
            $funcionario_info = get_funcionarios_id($id);
           var_dump(get_funcionarios_id($id));
           exit;
            if (!$funcionario_info) {
                set_mensagem('funcionário não localizado', 'alert-warning', 'index.php');
            }
        } else {
            set_mensagem('id invalido para editar membro', 'alert-warning', 'index.php');
        }
    }
} catch (Exception $e) {
    set_mensagem($e->getmessage(), 'alert-danger');
}

// configuração da pagina
$titulo_pagina = "Adm | Editar Funcionario";
$link_ativo = 'funcionario';
require_once 'includes/header-admin.php';

?>

<!-- CONTEUDO -->
<div class="jumbotron container p-5 mb-5">
    <h1 class="h2 float-left"><span class="text-secondary">Time /</span> Editar Funcionário</h1>
    <a href="index.php" class="btn btn-success float-right">
        Voltar
    </a>
    <div class="clearfix"></div>
    <hr>
    <p class="lead mb-0">
        Utilize o formulário abaixo para alterar as informações de um funcionário.
    </p>
</div>
<div class="container">
    <?php include "templates/alert-mensagens.php"; ?>
    <form method="POST" class="card" action="" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Nome completo:</label>
                    <input type="text"  value="<?=$funcionario_info['nome']?>" class="form-control" name="nome" />
                </div>
                <div class="form-group col-md-6">
                    <label>Foto:</label>
                    <input type="file" class="form-control-file" name="foto_func" />
                    <input type="hidden" name="foto_atual" />
                </div>
                <div class="form-group col-md-6">
                    <label>CPF:</label>
                    <input type="text" class="form-control" name="cpf_func" />
                </div>
                <div class="form-group col-md-6">
                    <label>Telefone:</label>
                    <input type="text" class="form-control" name="tel_func" />
                </div>
                <div class="form-group col-md-6">
                    <label>Cargo:</label>
                    <input type="text" class="form-control" name="cargo" />
                </div>
                <div class="form-group col-md-6">
                    <label>Senha:</label>
                    <input type="password" class="form-control" name="senha" />
                </div>

                <div class="form-group col-md-6">
                    <label>Confirmação Senha:</label>
                    <input type="password" class="form-control" name="confirmacao" />
                </div>

                <div class="form-group col-md-6">
                    <label>&nbsp;</label>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="ativo" id="checkboxAtivo">
                        <label class="custom-control-label" for="checkboxAtivo">Deixar colaborador ativo</label>
                    </div>

                    <div class="form-group col-md-12">
                        <button name="atualizar_funcionario" class="btn btn-lg btn-success">
                            Salvar Funcionário
                        </button>
                        <input type="hidden" name="id_func" value="<?= $funcionario_info['id_func'] ?>">
                    </div>
                </div>
            </div>
    </form>
</div>

<?php require_once 'includes/footer-admin.php'; ?>
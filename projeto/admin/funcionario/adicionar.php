<?php
// configurações gerais do site
require_once 'config.php';
$msg = get_mensagem();



try {
    if (isset($_POST['cadastrar_funcionario'])) {
        $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $cpf = filter_var($_POST['cpf_func'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $tel = filter_var($_POST['tel_func'], FILTER_VALIDATE_INT);
        $cargo = filter_var($_POST['cargo'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $ativo = (bool) ($_POST['ativo'] ?? false);
        $senha = filter_var($_POST['senha'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $confirmacao_senha = filter_var($_POST['confirmacao'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $foto = $_FILES['foto_func']['name'] ? $_FILES['foto_func'] : '';
        /*custom_print($_POST);
        custom_print($_FILES);
        exit;*/


        if (!$senha or !$confirmacao_senha or $senha != $confirmacao_senha) {
            throw new Exception('senha e confirmaçao devem ser iguais');
        }
        if (!$nome) {
            throw new Exception('nome obrigatório');
        }
        if (!$cpf) {
            throw new Exception('cpf obrigatório');
        }

        if (!$tel) {
            throw new Exception('telefone obrigatório');
        }

        if (!$cargo) {
            throw new Exception('cargo obrigatório');
        }

        if ($foto and is_array($foto)) {
            $nome_arquivo = upload_imagem($foto, 'funcionario');
            $foto = 'funcionario/' . $nome_arquivo;
        }


        if (!cadastrar_funcionario($nome, $cpf, $tel, $foto, $cargo, $ativo, $senha)) {
            throw new Exception('Não foi possivel cadastrar o colaborador');
        }

        set_mensagem('Colaborador cadastrado com sucesso', 'alert-success');
    }
} catch (Exception $e) {
    set_mensagem($e->getMessage(), 'alert-danger');
}

// configuração da pagina
$titulo_pagina = "Adm | Novo Funcionario";
$link_ativo = 'funcionario';
require_once 'includes/header-admin.php';



?>


<!-- CONTEUDO -->
<div class="jumbotron container p-5 mb-5">
    <h1 class="h2 float-left"><span class="text-secondary">Time |</span> Novo Funcionário</h1>
    <a href="index.php" class="btn btn-success float-right">
        Voltar
    </a>
    <div class="clearfix"></div>
    <hr>
    <p class="lead mb-0">
        Utilize o formulário abaixo para cadastrar um novo colaborador no time da sua empresa.
    </p>
</div>
<div class="container">
    <?php include "templates/alert-mensagens.php"; ?>
    <form method="POST" class="card" action="" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label> Nome completo:</label>
                    <input type="text" class="form-control" name="nome" placeholder="Insira aqui o nome completo do colaborador..." />
                </div>
                <div class="form-group col-md-6">
                    <label>Foto:</label>
                    <input type="file" class="form-control-file" name="foto_func" />
                </div>

                <div class="form-group col-md-6">
                    <label> CPF:</label>
                    <input type="text" class="form-control" name="cpf_func" autocomplete="off" placeholder="Insira aqui o cpf do colaborador..." />
                </div>
                <div class="form-group col-md-6">
                    <label> Cargo:</label>
                    <input type="text" class="form-control" name="cargo" autocomplete="off" placeholder="Insira aqui o cargo do colaborador..." />
                </div>

                <div class="form-group col-md-6">
                    <label> Telefone:</label>
                    <input type="text" class="form-control" name="tel_func" autocomplete="off" placeholder="Insira aqui o telefone do colaborador..." />
                </div>

                <div class="form-group col-md-6">
                    <label>Senha:</label>
                    <input type="password" class="form-control" name="senha" autocomplete="off" placeholder="Digite uma senha" />
                </div>

                

                <div class="form-group col-md-6">
                    <label>&nbsp;</label>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="ativo" id="checkboxAtivo" value="1" checked>
                        <label class="custom-control-label" for="checkboxAtivo">Deixar colaborador ativo</label>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label> Confirme sua senha:</label>
                    <input type="password" class="form-control" name="confirmacao" autocomplete="off" placeholder="Confirme sua senha" />
                </div>

                <div class="form-group col-md-12">
                    <button class="btn btn-lg btn-success" name="cadastrar_funcionario">
                        Cadastrar Colaborador
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>



<?php require_once 'includes/footer-admin.php'; ?>
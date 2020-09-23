<?php

# Configurações Gerais
require_once 'config.php';
$msg = get_mensagem();

try
{
    if(isset($_POST['login_usuario']))
    {
        $usuario = filter_var($_POST['usuario'], FILTER_VALIDATE_EMAIL);
        $senha = filter_var($_POST['senha'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    
        if ($usuario === false)
        {
            throw new Exception('usuário invalido');
        }
        if (!$senha)
        {
            throw new Exception('senha invalida');
        }
        login_usuario($usuario, $senha);
    }
}
catch(Exception $e)
{
    set_mensagem($e->getMessage(), 'alert-danger');
}


//custom_print('12345', PASSWORD_DEFAULT);
# Configurações da Página
$titulo_pagina = "Login";
$link_ativo = 'login';
require_once 'includes/header-admin.php';
?>

    

    <div class="container my-5">
        <form method="POST" action="" class="card mx-auto w-50">
            <div class="card-header p-5 text-center">
                <h3 class="h2 mb-0">Área Restrita</h3>
                <span>Utilize o formulário abaixo para acessar a Área Administrativa.</span>
            </div>

            <div class="card-body p-5">
                <?php include "templates/alert-mensagens.php"; ?>
                <div class="form-group">
                    <label>* Usuario:</label>
                    <input type="email" name="usuario" placeholder="usuario@email.com.br" class="form-control" />
                </div>
                <div class="form-group">
                    <label>* Senha:</label>
                    <input type="password" name="senha" placeholder="*****" class="form-control" />
                </div>
                <div class="form-group">
                    <button name="login_usuario" class="btn btn-primary btn-lg">
                        Entrar
                    </button>
                </div>
            </div>
        </form>
    </div>

<?php require_once 'includes/footer-admin.php'; ?>
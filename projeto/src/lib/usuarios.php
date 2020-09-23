<?php

/**
 * Cadastra um usuário admin no sistema
 * @param string $email_login       E-mail de login do usuário
 * @param string $senha             Senha do Usuário
 * @param bool $ativo               Indica se o usuário está ativo ou não
 * @return bool
 */

function cadastrar_usuario (string $email_login, string $senha, bool $ativo = true) : bool
{
    if (is_usuario_cadastrado($email_login)){
        throw new Exception('Email ja cadastrado no sistema');
    }
    $hash = password_hash ($senha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios_admin (email_login, senha, ativo ) VALUES (?, ?, ?)"; //MD5 CRIPTOGRAFIA - POREM RUIM
    $params = array ($email_login, $hash, $ativo);
    return db_execute($sql, 'ssi', $params);
}

/**
 * Verifica se um usuário já está cadastrado na base de dados
 * @param string $email_login       Usuário a ser verificado
 * @param int $usuario_id           ID do Usuário a ser testado
 * @return bool
 */


function is_usuario_cadastrado (string $email_login, int $usuario_id = 0) : bool
{
    $sql = "SELECT email_login FROM usuarios_admin WHERE email_login = ? AND usuario_id != ?";
    $param = array ($email_login, $usuario_id);
    $resultado = db_query($sql, 'si', $param);

    if ($resultado){
        return true;
    }
        return false;
}

/**
 * Exclui um usuário admin do sistema
 * @param int $usuario_id       ID do usuário
 * @return bool
 */

function excluir_usuarios(int $usuario_id) : bool
{
    $sql = "DELETE FROM usuarios_admin WHERE usuario_id = ?";
    $params = array($usuario_id);
    return db_execute($sql, 'i', $params);
}

/**
 * Retorna a lista de usuários cadastrados no sistema
 * @return array
 */

function get_usuarios() : array
{
    $sql = "SELECT * FROM usuarios_admin";
    return db_query($sql);
}

/**
 * Retorna os dados de um usuário específico da base de dados
 * @param int $usuario_id       ID do usuário
 * @return array|null
 */

function get_usuario_por_id(int $usuario_id) : ?array
{
    $sql = "SELECT * FROM usuarios_admin WHERE usuario_id=?";
    $params = array ($usuario_id);
    return db_query($sql, 'i', $params, true);

}

/**
 * Atualiza um usuário admin no sistema
 * @param string $email_login       E-mail de login do usuário
 * @param string $senha             Senha do Usuário
 * @param bool $ativo               Indica se o usuário está ativo ou não
 * @param int $usuario_id           ID do usuário a ser cadastrado
 * @return bool
 */

function atualizar_usuario (string $email, string $senha ='', bool $ativo, int $usuario_id) : bool
{
    if (is_usuario_cadastrado($email, $usuario_id))
    {
        throw new Exception('Email ja cadastrado no sistema');
    }
    if($senha)
    {
    $hash = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios_admin SET email_login = ?, senha = ? , ativo = ? WHERE usuario_id = ? ";
    $params = array ($email, $hash, $ativo, $usuario_id);
    return db_execute($sql, 'ssii' , $params);
    }
    $sql = "UPDATE usuarios_admin SET email_login = ?,  ativo = ? WHERE usuario_id = ? ";
    $params = array ($email, $ativo, $usuario_id);
    return db_execute($sql, 'sii' , $params);
}

/**
 * Bloqueia o acesso de usuários não autenticados às páginas administrativas
 * @return void
 */

 function bloquear_acesso_admin ()
 {
     $url = $_SERVER['REQUEST_URI']; // INFORMA EXATAMENTE A URL ACESSADA
     $is_admin = (strstr($url, '/admin/') and !strstr($url, '/admin/login.php')); 
     //$redirect = true;
     if ($is_admin and !is_usuario_logado()) // strstr verifica se a variavel tem o /admin
     {
        header('Location: ' . get_url('admin/login.php'));
        exit; // exit; ou exit(); - da na mesma
     }
 }

 /**
 * Verifica se há um usuário logado no sistema
 * @return bool
 */

  function is_usuario_logado ()
  {
    return (isset($_SESSION['usuario_logado']) and !empty($_SESSION['usuario_logado']));

  }

  /**
 * Retorna o usuário logado no momento
 * @return string
 */
/*
   function get_usuario_logado ()
   {
    return $_SESSION['usuario_logado'];

   }*/

   /**
 * Realiza o logout do usuário no sistema
 * @return void
 */

    function logout ()
    {
        unset($_SESSION['usuario_logado']); //unset zera tudo que na sessao do usuario logado
    }

    /**
 * Realiza o login de um usuário administrativo
 * @param string $email     E-mail do usuário que será logado no sistema
 * @param string $senha     Senha do usuário
 * @return void
 */

    function login_usuario (string $email, string $senha)
    {
        $sql = "SELECT * FROM usuarios_admin WHERE email_login = ?";
        $params = array($email);
        $usuario = db_query($sql, 's' , $params, true);
        if (!$usuario)
        {
            throw new Exception('Usuário não localizado na base de dados');
        }
        if($usuario and !$usuario['ativo'])
        {
            throw new Exception('Usuário Inativo na base de dados');
        }
        if (!password_verify($senha, $usuario['senha']))
        {
            throw new Exception ('Senha Inválida');
        }

        $_SESSION['usuario_logado'] = $usuario['email_login'];
        header('Location: ' . get_url('admin/index.php'));
        exit;

    }

    
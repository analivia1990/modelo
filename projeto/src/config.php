
<?php

/*
// configurações gerais do site
*/

define('SITE_NAME', 'Teste');
define('SITE_URL', 'http://localhost/Modelo/projeto/');
define('SITE_EMAIL_CONTATTO', 'teste@gmail.com');
define('SITE_FACEBOOK_URL', 'https://facebook.com/teste');
define('SITE_TWITTER_URL', 'https://twitter.com');
define('SITE_INSTAGRAM_URL', 'https://instagram.com');
define('SITE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/Modelo/projeto/');
define('SITE_PATH_IMG', SITE_PATH . 'assets/images/');
define('SITE_URL_IMG', SITE_URL . 'assets/images/');

define('DB_HOST', 'localhost');
define('DB_NAME', 'teste');
define('DB_USER', 'root');
define('DB_PWD', '');



if (!session_id()) {
  session_start();
}


require_once "lib/db.php";
require_once "lib/utils.php";
require_once "lib/usuarios.php";
require_once "lib/funcionario.php";




if (isset($_GET['logout'])) {
  logout();
}


spl_autoload_register(function ($nomeClasse) {
  $path_to_class = __DIR__ . '/classes/' . str_replace('\\', '/', $nomeClasse) . '.php';
  if (file_exists($path_to_class)) {
    require_once $path_to_class;
  } else {
    throw new Exception("Não foi possível carregar a classe: $nomeClasse");
  }
});

//bloquear_acesso_admin();
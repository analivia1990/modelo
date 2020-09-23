<?php 
// obtem a lista de itens do menu
$menu_itens = get_menu_admin();

?>   
   

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?>&trade; | <?= $titulo_pagina ?? '' ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400');
        body { font-family: 'Open Sans', sans-serif; }
        .navbar-brand { font-weight: bold; }
    </style>
</head>
<body>
    
    

    <!-- TOPO e NAVEGAÇÃO ADMIN -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
        <a href="<?= get_url('admin/index.php') ?>" class="navbar-brand mb-0 h1"><?= SITE_NAME ?>&trade;</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav mr-auto">
                <?php
                foreach ($menu_itens as $chave => $item) : 
                    $active = ($link_ativo == $chave) ? 'active' : null;
                ?>
                
                <li class="nav-item <?= $active?>">
                    <a class="nav-link" href="<?= $item[1] ?>">
                    <?= $item[0] ?>
                
                </a>

                </li>
                <?php endforeach ?>
                
            </ul>
            <span class="navbar-text">
                Bem-vindo(a), <strong class="text-white"><?= SITE_NAME // ALTERAR DEPOIS PARA FUNCAO USER LOGADO()?></strong> &nbsp;|&nbsp; 
               <a href="<?= get_url('admin/login.php?logout=true') ?>" class="text-warning">Logout</a> 
            </span>
        </div>
    </nav>
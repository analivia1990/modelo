<?php

    /**
     * Função que auxilia no debug de variáveis da aplicação
     * @param mixed $variavel   Variável cuja estrutura deve ser exibida no debug
     * @return void
     */
    function custom_print($variavel)
    {
        print '<pre>';
        print_r($variavel);
        print '</pre>';
    }

    /**
     * Corrige o caminho dos links de navegação do site
     * @param string $pagina    Página que a URL deve ser corrigida
     * @return string
     */
    function get_url(string $pagina)
    {
        return SITE_URL . $pagina;
    }

    /**
     * Retorna a estrutura do menu da área administrativa
     * @return array
     */
    function get_menu_admin()
{
    return array(
        'home' => array('Home', get_url('admin/index.php')),
      //  'cliente' => array('Cliente', get_url('admin/clientes')),
        'funcionario' => array('Funcionário', get_url('admin/funcionario')),
       // 'categorias' => array('Categoria', get_url('admin/Categorias')),
       // 'financeiro' => array('Financeiro', get_url('admin/Financeiro')),
      //  'pedidos' => array('Pedidos', get_url('admin/Pedidos')),
      //  'produtos' => array('Produtos', get_url('admin/Produtos')),
        //'usuarios' => array('Usuários', get_url('admin/usuarios')),
    );
}


    /**
     * Configura a mensagem de erro ou de sucesso a ser exibida pela aplicação
     * @param string $msg       Mensagem a ser exibida pela aplicação
     * @param string $classe    Classe CSS a ser aplicada no elemento HTML da mensagem
     * @param string $url       URL de redirecionamento (Por padrão redireciona para a página atual)
     * @param string $id        ID da mensagem na Sessão
     * @return void
     */
    function set_mensagem(string $msg, string $classe, string $url = '', string $id = 'msg')
    {
        $_SESSION[$id] = array(
            'mensagem' => $msg,
            'classe' => $classe
        );

        $url = $url ? $url : $_SERVER['REQUEST_URI'];

        header("Location: $url");
        exit();
    }

    /**
     * Retorna a mensagem guardada na sessão da aplicação
     * @param string $id    ID da chave na Sessão que contém a mensagem
     * @return array|null
     */
    function get_mensagem(string $id = 'msg')
    {
        $msg = $_SESSION[$id] ?? null;
        unset($_SESSION[$id]); // remove o dado da sessão

        return $msg;
    }

    /**
     * Formata datas recebidas da base de dados no padrão brasileiro DD/MM/AAAA às 08h30
     * @param string $data      Data no formato do banco de dados
     * @return string           Data corrigida
     */
    function get_data_formatada(string $data) : string 
    {
        return date('d/m/Y à\s H\hi', strtotime($data));
    }

    /**
     * Realiza o upload de imagens para o servidor
     * @param array $arquivo_info       Array contendo as informações da imagem enviada
     * @param string $diretorio         Diretório onde a imagem deverá ser salva
     * @param bool $novo_nome           Se um novo nome único deve ser gerado ou não pela aplicação (por padrão sim)
     * @param int $altura               Se especificado, valida a altura da imagem
     * @param int $largura              Se espeficiado, valida a largura da imagem
     * @return string                   Nome do Arquivo no servidor
     */
    function upload_imagem(array $arquivo_info, string $diretorio = '', bool $novo_nome = true, int $altura = 0, int $largura = 0) : string
    {
        $extensoes_permitidas = array('png', 'jpg', 'jpeg', 'gif');
        $extensao = strtolower(pathinfo($arquivo_info['name'], PATHINFO_EXTENSION));

        if ($novo_nome) {
            $arquivo_info['name'] = uniqid('', true) . ".$extensao";
        }

        if (!in_array($extensao, $extensoes_permitidas)) {
            throw new Exception('Extensão inválida! Selecione uma imagem PNG, GIF ou JPG.');
        }

        if ($altura and $largura) {
            // array( 0 => largura da imagem, 1 => altura da imagem )
            $tamanho = getimagesize($arquivo_info['tmp_name']);
            if ($largura != $tamanho[0] or $altura != $tamanho[1]) {
                throw new Exception("Tamanho da imagem incorreto! Selecione uma imagem com os tamanhos $largura x $altura");
            }
        }

        $caminho_diretorio = SITE_PATH_IMG;
        if ($diretorio) {
            $caminho_diretorio .= $diretorio . '/';
            if (!file_exists($caminho_diretorio)) {
                mkdir($caminho_diretorio);
            }
        }

        $caminho_arquivo = $caminho_diretorio . $arquivo_info['name'];
        if (!move_uploaded_file($arquivo_info['tmp_name'], $caminho_arquivo)) {
            throw new Exception('Não foi possível realizar o upload do arquivo!');
        }

        return $arquivo_info['name'];
    }

    /**
     * Retorna a URL correta para uma imagem
     * @param string $foto          Imagem a ser retornada com a URL corrigida
     * @param string $placeholder   Imagem substituta caso a foto não seja fornecida
     * @param string
     */
    function get_imagem_url(string $foto, string $placeholder = '100x100') : string 
    {
        if ($foto) {
            return SITE_URL_IMG . $foto;
        }

        return 'https://placehold.it/' . $placeholder;
    }
<?php

/**
 * 
 * funções relacionadas a operações em banco de dados
 */

// conectar ao banco
/**
 * Função que retorna o objeto de conexão com a base de dados da aplicação
 */

function get_db_connection()
{
    $conexao = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
    if (mysqli_connect_errno()) {
        exit("Não foi possivel conectar ao Banco ");
    }
    return $conexao;
}




/**
 * executa operções de seleção de dados na base
 * @param string $sql Instrução que deve ser executada no banco
 * @param string $param_types Tipo dos valores passados como paramentro do sql
 * @param array $param Valores dos parametros SQL
 * @param bool $is_single Se true retorna um unico valor do banco, caso contrario retorna lista
 */

function db_query(string $sql, string $param_types = '', array $params = [], bool $is_single = false)
{
    $conexao = get_db_connection();
    $stmt = mysqli_prepare($conexao, $sql);
    if (!$stmt or mysqli_stmt_errno($stmt)) {
        throw new Exception('Erro na estrutura do comando SQL informado');
    }

    if ($params and $param_types) {
        mysqli_stmt_bind_param($stmt, $param_types, ...$params); // ... $params - spread operations - espalaha valores

    }

    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt); // encerra conexao

    if ($is_single) {
        // retorna so 1 item dos resultados
        return mysqli_fetch_assoc($resultado);
        // se quiser o retorno numero return mysqli_fetch_numeric 
    }

    // retorna todos os dados retorndos ( lista de infos )- array associativo
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}


/**
 * EXECUTA OPERAÇÕES DO TIPO INSERT, UPDATE, DELETE NA BASE DE DADOS
 * @param string $sql Instrução que deve ser executada no banco
 * @param string $param_types Tipo dos valores passados como paramentro do sql
 * @param array $param Valores dos parametros SQL
 */

function db_execute(string $sql, string $param_types = '', array $params = [])
{
    $conexao = get_db_connection();
    $stmt = mysqli_prepare($conexao, $sql);

    if (!$stmt or mysqli_stmt_errno($stmt)) {
        throw new Exception('Erro na estrutura do comando SQL informado');
    }

    if ($params and $param_types) {
        mysqli_stmt_bind_param($stmt, $param_types, ...$params);
    }
    mysqli_stmt_execute($stmt);
    $erro = mysqli_stmt_errno($stmt);
    mysqli_stmt_close($stmt);

    if ($erro) {
        return false;
    }
    return true;
}

<?php

function get_funcionarios(bool $ativos_only = false): array
{
    if ($ativos_only) {
        $sql = "SELECT * FROM funcionarios WHERE ativo = 1";
        return db_query($sql);
    }
    $sql = "SELECT * FROM funcionarios";
    return db_query($sql);
}

function get_funcionarios_id(int $id_func) : ?array
{
    $sql = "SELECT * FROM funcionarios WHERE func_id = ?";
    $params = array($id_func);
    return db_query($sql, 'i', $params, true);
}

function cadastrar_funcionario(
    string $nome,
    string $cpf,
    string $tel,
    string $foto = '',
    string $cargo,
    bool $ativo = true,
    string $senha
): bool {

    if (is_cadastrar_funcionario($cpf)) {
        throw new Exception("Este CPF ja esta cadastrado na base de dados");
    }
    $hash = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO funcionarios (nome, cpf_func, tel_func, foto_func, cargo, ativo, senha) 
VALUES (?,?,?,?,?,?,?)";
    $params = array($nome, $cpf, $tel, $foto, $cargo, $ativo, $hash);
    return db_execute($sql, 'sssssis', $params);
}


function is_cadastrar_funcionario(string $cpf, int $id_func = 0): bool
{
    $sql = "SELECT cpf_func FROM funcionarios WHERE cpf_func = ? AND id_func != ? ";
    $params = array($cpf, $id_func);
    $resultado = db_query($sql, 'si', $params);
    if ($resultado) {
        return true;
    }

    return false;
}

function atualizar_funcionario(
    string $nome,
    string $cpf,
    string $tel,
    string $foto = '',
    string $cargo,
    bool $ativo = true,
    string $senha,
    int $id
): bool {
    if (is_cadastrar_funcionario($cpf)) {
        throw new Exception("Este CPF ja esta cadastrado na base de dados");
    }
    if ($senha) {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "UPDATE funcionarios SET nome = ? , cpf_func = ? tel_func = ? , foto_func = ?, 
    cargo = ? , ativo = ? , senha = ?  WHERE id_func = ?";
        $params = array($nome, $cpf,  $tel, $foto, $cargo, $ativo, $hash, $id);
        return db_execute($sql, 'sssssisi', $params);
    }
    $sql = "UPDATE funcionarios SET nome = ?  , cpf_func = ? , tel_func = ? , foto_func = ?, 
    cargo = ? , ativo = ?  WHERE id_func = ?";
    $params = array($nome, $cpf, $tel, $foto, $cargo, $ativo,  $id);
    return db_execute($sql, 'sssssii', $params);
}




function excluir_funcionario(int $id): bool
{
    $sql = "DELETE FROM funcionarios WHERE id_func = ? ";
    $params = array($id);
    return db_execute($sql, 'i', $params);
}

<?php
// CAPTURANDO DADOS DO USUÁRIO LOGADO NO JSON
$usuarioEncontrado = getRegisters("usuarios", ["email", $_SESSION["usuarioEmail"]]);
// /CAPTURANDO DADOS DO USUÁRIO LOGADO NO JSON

// EDITANDO REGISTRO NO JSON
if (isset($_REQUEST["editarUsuario"]) && $_REQUEST["editarUsuario"]) :
    $arrayNovoUsuario = [
        "nome" => $_REQUEST["nome"],
        "sobrenome" => $_REQUEST["sobrenome"],
        "email" => $_REQUEST["email"],
        "senha" => $_REQUEST["senha"]
    ];
    $identificador = ["email", $_REQUEST["email"]];
    setRegister("usuarios", $arrayNovoUsuario, $identificador);
    header("Location: usuarios.php");
endif;
// /EDITANDO REGISTRO NO JSON
?>
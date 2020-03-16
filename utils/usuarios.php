<?php
// CAPTURANDO DADOS DO JSON
$listaDeUsuarios = getRegisters("usuarios");
// /CAPTURANDO DADOS DO JSON

// INCLUINDO REGISTRO NO JSON
if (isset($_REQUEST["cadastrarUsuario"]) && $_REQUEST["cadastrarUsuario"]) :
    $arrayNovoUsuario = [
        "nome" => $_REQUEST["nome"],
        "sobrenome" => $_REQUEST["sobrenome"],
        "email" => $_REQUEST["email"],
        "senha" => $_REQUEST["senha"]
    ];
    setRegister("usuarios", $arrayNovoUsuario);
    header("Location: usuarios.php");
endif;
// /INCLUINDO REGISTRO NO JSON

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

// EXCLUINDO REGISTRO NO JSON
if (isset($_REQUEST["excluirUsuario"]) && $_REQUEST["excluirUsuario"]) :
    $identificador = ["email", $_REQUEST["email"]];
    unsetRegister("usuarios", $identificador);
    header("Location: usuarios.php");
endif;
// /EXCLUINDO REGISTRO NO JSON
?>
<?php
// VALIDAÇÃO DE LOGIN -->
if (isset($_REQUEST["logarUsuario"]) && $_REQUEST["logarUsuario"]) {
    $usuarioLogando = getRegisters("usuarios", ["email", $_REQUEST["email"]]);
    if ($usuarioLogando === "Registro não localizado") :
        $erro = "Usuário inexistente!";
    elseif (isset($usuarioLogando) && $usuarioLogando) :
        if (password_verify($_REQUEST["senha"], $usuarioLogando["senha"])) :
            $usuarioLogado = $usuarioLogando;
        else :
            $erro = "Senha não bate!";
        endif;
    endif;
    if (isset($usuarioLogado) && $usuarioLogado) {
        session_start();
        $_SESSION["usuarioLogado"] = true;
        $_SESSION["usuarioNome"] = $usuarioLogado["nome"];
        $_SESSION["usuarioSobrenome"] = $usuarioLogado["sobrenome"];
        $_SESSION["usuarioEmail"] = $usuarioLogado["email"];
        header("Location: index.php");
    } elseif ($erro) {
        echo "<p class='alert alert-danger'>Ops! Algo de errado não deu certo...<br>Por favor, tente novamente</p>";
    }
}
// /VALIDAÇÃO DE LOGIN
?>
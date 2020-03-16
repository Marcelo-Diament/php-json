<?php $tituloPagina = "Formluário de Login"; ?>
<?php require_once("./inc/head.php"); ?>
<?php require_once("./inc/header.php"); ?>
<!-- /VALIDAÇÃO DE LOGIN -->
<?php
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
?>
<!-- /VALIDAÇÃO DE LOGIN -->
<main class="container">
    <article class="row">
        <section class="col-12 mx-auto bg-light my-5 py-5 rounded border" id="cadastroForm">
            <h3 class="col-12 text-center my-3"><?= $tituloPagina ?></h3>
            <!-- OBSERVAÇÃO: vamos deixar o action vazio, para que ele envie para a própria página.
                Após validarmos o login, vamos redirecionar o usuário para usuarios.php (sem parâmetros) -->
            <form action="" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
                </div>
                <input type="hidden" name="logarUsuario" value="logarUsuario">
                <button type="submit" class="btn btn-primary float-right" id="btnCadastrar">Cadastrar</button>
            </form>
        </section>
    </article>
</main>
<?php require_once("./inc/footer.php"); ?>
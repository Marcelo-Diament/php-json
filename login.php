<?php
$tituloPagina = "Formluário de Login";
require_once("./inc/head.php");
require_once("./inc/header.php");
require("./utils/login.php");
?>
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
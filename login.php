<!-- /VALIDAÇÃO DE LOGIN -->
<?php

    // Verificando se estamos recebendo algum dado com $_REQUEST
    if(isset($_REQUEST) && $_REQUEST) {

        // DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O $_REQUEST RECEBIDO
        // echo "<br><pre>";
        // var_dump($_REQUEST);
        // echo "</pre><br>";
        // exit;

        // Caso estejamos recebendo... vamos fazer a verificação!
        // Começaremos atribuindo os valores recebidos à 2 variáveis, email e senha:
        $email = $_REQUEST["email"];
        $senha = $_REQUEST["senha"];
        // DESCOMENTE AS 6 LINHAS ABAIXO PARA VER O AS DUAS VARIÁVEIS
        // echo "<br><pre>";
        // var_dump($email);
        // echo "<br><hr><br>";
        // var_dump($senha);
        // echo "</pre><br>";
        // exit;

        // Agora vamos verificar se existe esse email no nosso arquivo dados.json

        // O primeiro passo é recebermos nosso JSON como array (ou poderia ser como objeto também)
        $usuariosJson = file_get_contents("./data/dados.json");
        $usuariosArray = json_decode($usuariosJson, true);

        // Agora vamos percorrer esse array para ver se encontramos o email:
        foreach($usuariosArray["usuarios"] as $usuario) {

            // Se encontrarmos um email que coincida com o email enviado...
            if ($usuario["email"] === $email) {

                // Atrelamos esse usuário (todo) à variável $usuarioLogando
                // Logando por que ainda precisamos verificar a senha para logar ele
                $usuarioLogando = $usuario;

            } else {
            // Se não encontrarmos...

                // Salvamos a variável $erro com o motivo do erro
                // Mas... não vamos mostrar o motivo do erro para não facilitar para os invasores! hehehe
                $erro = "Usuário não existe!";

            }

        }

        // Agora que já sabemos se esse email existe, vamos verificar se a senha do usuário que tem esse email bate
        // Antes de verificarmos, vamos verificar se o usuário que está logando existe (se existe $usuarioLogando)
        if(isset($usuarioLogando) && $usuarioLogando) {

            // Mas ela está criptografada, então precisamos fazer uma verificação do hash.
            // Para isso, existe mais uma função: password_verify, que compara duas senhas (a 'crua' e a 'hasheada')
            // Ao incluirmos no if, já estamos vendo se a senha bate e declarando isso como condição
            if (password_verify($senha, $usuarioLogando["senha"])) {

                // Se bater... criamos a variável $usuarioLogado
                $usuarioLogado = $usuario;

            } else {

                // Se não bater...
                $erro = "Senha não bate!";

            }
        
        }

        // Enfim, vamos finalizar a verificação!
        // Recapitulando:
        // 1) Recebemos os dados e atrelamos à uma variável
        // 2) Puxamos os usuários do nosso JSON em um array
        // 3) Buscamos o email inserido dentro dos usuários do JSON
        // 4) Se o email bater, criamos o usuário $usuarioLogando, senão criamos um erro
        // 5) O email batendo, vamos verificar a senha. Se bater também, criamos o $usuarioLogado, senão, criamos um erro

        // Agora basta verificarmos se há o usuário logado OU se há erro.
        if(isset($usuarioLogado) && $usuarioLogado) {

            // Iniciamos uma sessão
            session_start();

            // Se estiver tudo certo, atrelamos as propriedades do usuário logado à constante superglobal, como chamamos, $_SESSION
            $_SESSION["usuarioLogado"] = true;
            $_SESSION["usuarioNome"] = $usuarioLogado["nome"];
            $_SESSION["usuarioSobrenome"] = $usuarioLogado["sobrenome"];
            $_SESSION["usuarioEmail"] = $usuarioLogado["email"];

            // DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O $usuarioLogado"
            // echo "<br><pre>";
            // var_dump($usuarioLogado);
            // echo "</pre><br>";

            // DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O $_SESSION
            // echo "<br><pre>";
            // var_dump($_SESSION);
            // echo "</pre><br>";

            // DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O $_SESSION["usuarioLogado"]
            // echo "<br><pre>";
            // var_dump($_SESSION["usuarioLogado"]);
            // echo "</pre><br>";

            // E redirecionamos o usuário para a página inicial:
            header("Location: index.php");

            // ATENÇÃO: veja o arquivo inc/header.php para ver
            // como a session nos permite continuar trabalhando com os dados que salvamos nessa própria session

        } elseif($erro) {

            // Já se houver erro... enviamos uma mensagem de erro:
            echo "<p class='alert alert-danger'>Ops! Algo de errado não deu certo...<br>Por favor, tente novamente</p>";

        }


    }

?>
<!-- /VALIDAÇÃO DE LOGIN -->
<?php $tituloPagina = "Formluário de Login"; ?>
<?php require_once("./inc/head.php"); ?>
<?php require_once("./inc/header.php"); ?>
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
                    <button type="submit" class="btn btn-primary float-right" id="btnCadastrar">Cadastrar</button>
                </form>
            </section>
        </article>
    </main>
    <?php require_once("./inc/footer.php"); ?>
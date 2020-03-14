<?php $tituloPagina = "Lista de Usuários"; ?>
<?php require_once("./inc/head.php"); ?>
<?php require_once("./inc/header.php"); ?>

<!-- CAPTURANDO DADOS DO JSON -->
<?php
    
    // ESTAMOS PUXANDO O CONTEÚDO DO ARQUIVO DECLARADO COMO PARÂMETRO
    $usuariosJson = file_get_contents("./data/usuarios.json");
    // DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O JSON DA MANEIRA QUE RECEBEMOS
    // echo "<br><pre>";
    // var_dump($usuariosJson);
    // echo "</pre><br>";
    // exit;
    // Perecba que o JSON nada mais é do que uma String. =)

    // AQUI TRANSFORMAMOS A STRING RECEBIDA EM OBJETO
    $usuariosObjeto = json_decode($usuariosJson);
    // DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O JSON DECODIFICADO
    // echo "<br><pre>";
    // var_dump($usuariosObjeto);
    // echo "</pre><br>";
    // exit;
    // Ao decodificarmos o JSON, transformamos aquela string em um objeto populado por arrays e objetos!

    // E AQUI TRANSFORMAMOS A STRING RECEBIDA EM ARRAY
    $usuariosArray = json_decode($usuariosJson, true);
    // DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O JSON DECODIFICADO
    // echo "<br><pre>";
    // var_dump($usuariosArray);
    // echo "</pre><br>";
    // exit;
    // Se incluirmos um segundo parâmetro com o valor true, transformamos o JSON em Array,
    // Ou seja, sem o true, o valor default é false (que transforma o JSON em objeto)

    // DESÇA NA PARTE DA TABELA DE USUÁRIOS PARA VER COMO UTILIZAMOS ESSE OBJETO PARA POPULAR A TABELA DE USUÁRIOS

?>
<!-- /CAPTURANDO DADOS DO JSON -->



<!-- CAPTURANDO DADOS DO FORM E INCLUINDO NO JSON -->
<?php

    // RECEBENDO DADOS DO FORMULÁRIO
    // Se estivermos recebendo dados (como usamos o $_REQUEST, pode ser POST ou GET)
    if(isset($_REQUEST) && $_REQUEST) {

        // DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O $_REQUEST RECEBIDO
        // echo "<br><pre>";
        // var_dump($_REQUEST);
        // echo "</pre><br>";

        // Atrelamos os valores recebidos às variáveis que estamos criando mais abaixo.
        // Lembrando que o valor do input é capturado através do valor do atributo name do input.
        // Ou seja, se recebemos valor em $_REQUEST["nome"], é por que o input tem o atributo name="nome".
        $nome = $_REQUEST["nome"];
        $sobrenome = $_REQUEST["sobrenome"];
        $email = $_REQUEST["email"];
        // Para a senha, utilizaremos a função password_hash, de modo que não seja possível ver a senha do usuário:
        $senha = password_hash($_REQUEST["senha"], PASSWORD_DEFAULT);
        // Para saber mais sobre essa função de 'hashear' a senha, acesse https://www.php.net/manual/en/function.password-hash.php.


        // CRIANDO UM ARRAY COM AS INFORMAÇÕES DO NOVO USUÁRIO
        // Podemos inserir as novas variáveis e seus valores em um array
        $novoUsuario = [
            "nome" => $nome,
            "sobrenome" => $sobrenome,
            "email" => $email,
            "senha" => $senha
        ];
        // DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O ARRAY DO NOVO USUÁRIO
        // echo "<br><pre>";
        // var_dump($novoUsuario);
        // echo "</pre><br>";
        

        // INCLUINDO NOVO USUÁRIO AO ARRAY DE USUÁRIOS
        // E então vamos incluir o array do novo usuário no array de usuários
        // ATENÇÃO: lembre-se da estrutura do nosso JSON:
        // dentro do JSON temos o índice (a posição) "usuarios"
        array_push($usuariosArray["usuarios"], $novoUsuario);
        // DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O ARRAY ATUALIZADO
        // echo "<br><pre>";
        // var_dump($usuariosArray);
        // echo "</pre><br>";


        // CODIFICANDO NOSSO ARRAY NOVAMENTE
        $usuariosJsonAtualizados = json_encode($usuariosArray);
        // DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O JSON CODIFICADO NOVAMENTE
        // echo "<br><pre>";
        // var_dump($usuariosJsonAtualizados);
        // echo "</pre><br>";


        // INSERINDO OS VALORES ATUALIZADOS NO ARQUIVO NOVAMENTE
        file_put_contents("./data/usuarios.json", $usuariosJsonAtualizados);
        // Agora nosso arquivo com o JSON está atualizado com o novo cadastro.
        // Vamos redirecionar o usuário para a página usuarios.php novamente,
        // Para que vejamos a tabela atualizada. Para vermos a atualização
        // sem sairmos da tela, aprenderemos AJAX no módulo de JavaScript.


        // Vamos aproveitar e já 'logar' nosso usuário
        // Atenção: isso não é uma boa prática por não ser muito seguro,
        // Mas faremos assim apenas para fins didáticos.
        // É bacana para a experiência do usuário, mas há maneiras melhores de fazermos isso
        // Então vamos lá! Iniciamos uma sessão
        session_start();

        // Se estiver tudo certo, atrelamos as propriedades do usuário logado à constante superglobal, como chamamos, $_SESSION
        $_SESSION["usuarioLogado"] = true;
        $_SESSION["usuarioNome"] = $nome;
        $_SESSION["usuarioSobrenome"] = $sobrenome;
        $_SESSION["usuarioEmail"] = $email;


        // REDIRECIONANDO O USUÁRIO PARA A LISTA DE USUÁRIOS
        header('Location: ./usuarios.php');
        exit;

    }


?>
<!-- /CAPTURANDO DADOS DO FORM E INCLUINDO NO JSON -->


    <main class="container">
        <article class="row">
            <section class="col-12 mx-auto bg-light my-5 py-5 rounded border" id="usuariosTb">
                <h3 class="col-12 text-center my-3"><?= $tituloPagina ?></h3>
                <table class="table mt-5 mb-2 text-center bg-white">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" colspan="2">Nome Completo</th>
                            <th scope="col">email</th>
                            <th scope="col">Senha</th>
                            <th scope="col" colspan="2">Opções</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- HTML 'CHAPADO' NO CÓDIGO -->
                        <!-- Mas queremos puxar os usuários do JSON,
                        para não precisarmos criar cada usuário na mão -->

                            <!--
                            <tr>
                                <th scope="row">Fulano</th>
                                <td>da Silva</td>
                                <td>email@email.com</td>
                                <td>123456</td>
                            </tr>
                            <tr>
                                <th scope="row">Ciclano</th>
                                <td>Santos</td>
                                <td>ciclano@santos.com</td>
                                <td>124155</td>
                            </tr>
                            -->

                        <!-- /HTML 'CHAPADO' NO CÓDIGO -->

                        <!-- CAPTURANDO REGISTROS DO JSON -->
                        
                        <!-- 1) Nós já 'puxamos' o arquivo do Json com o file_get_contents().-->

                        <!-- 2) Depois decodificamos a string que recebemos (o JSON em si) e
                        transformamos essa string em um objeto - com o json_decode. -->

                        <!-- 3) E agora vamos percorrer esses objetos com um loop foreach: -->

                        <?php foreach($usuariosObjeto->usuarios as $usuario): ?>
                            
                            <tr>

                                <th scope="row" colspan="2" class="text-left pl-4"><?= $usuario->nome . " " . $usuario->sobrenome; ?></th>
                                <td class="text-left"><a href="mailto:<?= $usuario->email; ?>?subject=Contato%20via%20Site%20PHP%20JSON" title="Enviar email para <?= $usuario->nome ?>"><?= $usuario->email; ?></a></td>
                                <!-- A função abaixo mantém apenas 10 caracteres
                                (a partir do caractere 0, o primeiro) e concatena com '...' -->
                                <td><?= substr($usuario->senha,0,10)."..."; ?></td>
                                <td colspan="2" class="pr-0">
                                    <a href="./usuario.php/?<?= $usuario->email ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="./editar.php/?<?= $usuario->email ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                    <a href="./excluir.php/?<?= $usuario->email ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>

                            </tr>
    
                        <?php endforeach; ?>

                        <!-- /CAPTURANDO REGISTROS DO JSON -->

                    </tbody>
                </table>
            </section>
        </article>
    </main>
    <?php require_once("./inc/footer.php"); ?>
<?php $tituloPagina = "Lista de Usuários"; ?>
<?php require_once("./inc/head.php"); ?>
<?php require_once("./inc/header.php"); ?>

<!-- CAPTURANDO DADOS DO JSON -->
<?php $listaDeUsuarios = getRegisters("usuarios"); ?>
<!-- /CAPTURANDO DADOS DO JSON -->

<!-- INCLUINDO REGISTRO NO JSON -->
<?php
if ( isset($_REQUEST["cadastrarUsuario"]) && $_REQUEST["cadastrarUsuario"] ) :

    $arrayNovoUsuario = [
        "nome" => $_REQUEST["nome"],
        "sobrenome" => $_REQUEST["sobrenome"],
        "email" => $_REQUEST["email"],
        "senha" => $_REQUEST["senha"]
    ];

    setRegister("usuarios", $arrayNovoUsuario);

    header("Location: usuarios.php");

endif;
?>
<!-- /INCLUINDO REGISTRO NO JSON -->
<!-- EDITANDO REGISTRO NO JSON -->
<?php
if ( isset($_REQUEST["editarUsuario"]) && $_REQUEST["editarUsuario"] ) :

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
?>
<!-- /EDITANDO REGISTRO NO JSON -->
<!-- EXCLUINDO REGISTRO NO JSON -->
<?php
if ( isset($_REQUEST["excluirUsuario"]) && $_REQUEST["excluirUsuario"] ) :

    $identificador = ["email", $_REQUEST["email"]];

    unsetRegister("usuarios", $identificador);

    header("Location: usuarios.php");

endif;
?>
<!-- /EXCLUINDO REGISTRO NO JSON -->

<!-- CAPTURANDO DADOS DO FORM E INCLUINDO NO JSON -->
<?php

// // RECEBENDO DADOS DO FORMULÁRIO
// // Se estivermos recebendo dados (como usamos o $_REQUEST, pode ser POST ou GET)
// if (isset($_REQUEST) && $_REQUEST) {

//     // DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O $_REQUEST RECEBIDO
//     // echo "<br><pre>";
//     // var_dump($_REQUEST);
//     // echo "</pre><br>";

//     // Atrelamos os valores recebidos às variáveis que estamos criando mais abaixo.
//     // Lembrando que o valor do input é capturado através do valor do atributo name do input.
//     // Ou seja, se recebemos valor em $_REQUEST["nome"], é por que o input tem o atributo name="nome".

//     if (isset($_REQUEST["usuarioEmail"]) && $_REQUEST["usuarioEmail"]) {
//         // Se recebermos os names no formato usuarioCampo...
//         // Aqui, nesse caso, recebemos nesse formato - nessa página - recebemos para excluir o user

//         $email = $_REQUEST["usuarioEmail"];
//     } elseif (isset($_REQUEST["email"]) && $_REQUEST["email"]) {
//         // Se recebermo os names no formato campo

//         $nome = $_REQUEST["nome"];
//         $sobrenome = $_REQUEST["sobrenome"];
//         $email = $_REQUEST["email"];
//         // Para a senha, utilizaremos a função password_hash, de modo que não seja possível ver a senha do usuário:
//         $senha = password_hash($_REQUEST["senha"], PASSWORD_DEFAULT);
//         // Para saber mais sobre essa função de 'hashear' a senha, acesse https://www.php.net/manual/en/function.password-hash.php.

//     }

//     } elseif (isset($_REQUEST["excluir"]) && $_REQUEST["excluir"] === "excluir") {
//         // OU... SE O USUÁRIO ESTIVER SENDO EXCLUÍDO...

//         // Vamos percorrer o array de usuários para ver se encontramos o email
//         // Estamos usando um FOR para termos o índice de cada usuário
//         for ($i = 0; $i < count($usuariosArray["usuarios"]); $i++) {

//             // Se encontrarmos um email que coincida com o email enviado...
//             if ($usuariosArray["usuarios"][$i]["email"] === $email) {

//                 // Excluímos o índice em que houve a coincidência com a função unset
//                 // O parâmetro um é o array e o segundo é o índice onde a função começará a remover os índices
//                 // Pode haver um terceiro parâmetro, que define quantos índices serão removidos
//                 array_splice($usuariosArray["usuarios"], $i, 1);
//             } else {

//                 // Se não encontrarmos...

//                 // Salvamos a variável $erro com o motivo do erro
//                 $erro = "Usuário não encontrado!";
//             }
//         }
//     }

//     // CODIFICANDO NOSSO ARRAY NOVAMENTE
//     $usuariosJsonAtualizados = json_encode($usuariosArray);
//     // DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O JSON CODIFICADO NOVAMENTE
//     // echo "<br><pre>";
//     // var_dump($usuariosJsonAtualizados);
//     // echo "</pre><br>";


//     // INSERINDO OS VALORES ATUALIZADOS NO ARQUIVO NOVAMENTE
//     file_put_contents("./data/dados.json", $usuariosJsonAtualizados);
//     // Agora nosso arquivo com o JSON está atualizado com o novo cadastro.
//     // Vamos redirecionar o usuário para a página usuarios.php novamente,
//     // Para que vejamos a tabela atualizada. Para vermos a atualização
//     // sem sairmos da tela, aprenderemos AJAX no módulo de JavaScript.


//     // SE O USUÁRIO ESTIVER SE CADASTRANDO...
//     if (isset($_REQUEST["cadastrarUsuario"]) && $_REQUEST["cadastrarUsuario"] === "cadastrarUsuario") {

//         // Vamos aproveitar e já 'logar' nosso usuário
//         // Atenção: isso não é uma boa prática por não ser muito seguro,
//         // Mas faremos assim apenas para fins didáticos.
//         // É bacana para a experiência do usuário, mas há maneiras melhores de fazermos isso
//         // Então vamos lá! Iniciamos uma sessão
//         session_start();

//         // Se estiver tudo certo, atrelamos as propriedades do usuário logado à constante superglobal, como chamamos, $_SESSION
//         $_SESSION["usuarioLogado"] = true;
//         $_SESSION["usuarioNome"] = $nome;
//         $_SESSION["usuarioSobrenome"] = $sobrenome;
//         $_SESSION["usuarioEmail"] = $email;


//         // REDIRECIONANDO O USUÁRIO PARA A LISTA DE USUÁRIOS
//         header('Location: ./usuarios.php');
//         exit;
//     } elseif (isset($_REQUEST["editarUsuario"]) && $_REQUEST["editarUsuario"] === "editarUsuario") {
//         // /SE O USUÁRIO ESTIVER SENDO EDITADO...

//         // RECARREGAMOS A PÁGINA PARA ATUALIZAR A LISTA DE USUÁRIOS (posteriormente aprenderemos a fazer isso com AJAX sem sair da página)
//         header('Location: ./usuarios.php');
//         exit;
//     } elseif (isset($_REQUEST["excluir"]) && $_REQUEST["excluir"] === "excluir") {
//         // /SE O USUÁRIO ESTIVER SENDO EXCLUÍDO...

//         // RECARREGAMOS A PÁGINA PARA ATUALIZAR A LISTA DE USUÁRIOS (posteriormente aprenderemos a fazer isso com AJAX sem sair da página)
//         header('Location: ./usuarios.php');
//         exit;
//     }
// }


?>
<!-- /CAPTURANDO DADOS DO FORM E INCLUINDO NO JSON -->


<main class="container">
    <article class="row">
        <section class="col-12 mx-auto bg-light my-5 py-5 rounded border" id="usuariosTb">
            <h3 class="col-12 text-center my-3"><?= $tituloPagina ?></h3>
            <table class="table mt-5 mb-2 text-center bg-white">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" colspan="2">Nome Completo</th>
                        <th scope="col">email</th>
                        <th scope="col">Senha</th>
                        <th scope="col" colspan="2">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- CAPTURANDO REGISTROS DO JSON A PARTIR DA FUNÇÃO getRegisters(), CHAMADA NA VARIÁVEL $listaDeUsuarios NA LINHA 6 DESSE DOCUMENTO -->
                    <?php foreach ($listaDeUsuarios as $usuario) : ?>
                        <tr>
                            <th scope="row" class="text-left pl-4"><?= $usuario["id"]; ?></th>
                            <th scope="row" colspan="2" class="text-left pl-4"><?= $usuario["nome"] . " " . $usuario["sobrenome"]; ?></th>
                            <td class="text-left"><a href="mailto:<?= $usuario["email"]; ?>?subject=Contato%20via%20Site%20PHP%20JSON" title="Enviar email para <?= $usuario["nome"] ?>"><?= $usuario["email"]; ?></a></td>
                            <!-- A função abaixo mantém apenas 10 caracteres
                                (a partir do caractere 0, o primeiro) e concatena com '...' -->
                            <td><?= substr($usuario["senha"], 0, 10) . "..."; ?></td>
                            <td colspan="2" class="pr-0">
                                <form id="verUsuario" action="./usuario.php" method="post" class="d-inline">
                                    <input type="hidden" name="ver" value="ver">
                                    <button type="submit" name="usuarioEmail" value="<?= $usuario["email"] ?>" title="Visulizar dados de <?= $usuario["nome"] ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></button>
                                </form>
                                <form id="editarUsuario" action="./usuario.php" method="post" class="d-inline">
                                    <input type="hidden" name="editar" value="editar">
                                    <button type="submit" name="usuarioEmail" value="<?= $usuario["email"] ?>" title="Editar dados de <?= $usuario["nome"] ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button>
                                </form>
                                <form id="excluirUsuario" action="./usuarios.php" method="post" class="d-inline">
                                    <input type="hidden" name="excluir" value="excluir">
                                    <button type="submit" name="usuarioEmail" value="<?= $usuario["email"] ?>" title="Excluir <?= $usuario["nome"] ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <!-- /CAPTURANDO REGISTROS DO JSON A PARTIR DA FUNÇÃO getRegisters(), CHAMADA NA VARIÁVEL $listaDeUsuarios NA LINHA 6 DESSE DOCUMENTO -->

                </tbody>
            </table>
        </section>
    </article>
</main>
<?php require_once("./inc/footer.php"); ?>
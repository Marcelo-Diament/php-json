<?php $tituloPagina = "Detalhes do Usuário"; ?>
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

// AGORA VAMOS BUSCAR POR UM USUÁRIO ESPECÍFICO, VEJA NA TABELA ABAIXO

?>
<!-- /CAPTURANDO DADOS DO JSON -->



<!-- CAPTURANDO DADOS DO USUÁRIO CLICADO, BUSCANDO O USUÁRIO NO JSON (PELO EMAIL) E CRIANDO UMA NOVA VARIÁVEL (SE ENCONTRADO) -->
<?php

// RECEBENDO DADOS VINDOS DA TABELA DE USUÁRIOS VIA MÉTODO GET
// Se estivermos recebendo dados (como usamos o $_REQUEST, pode ser POST ou GET)
if (isset($_REQUEST) && $_REQUEST) {

    // DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O $_REQUEST RECEBIDO
    // echo "<br><pre>";
    // var_dump($_REQUEST);
    // echo "</pre><br>";

    // Atrelamos o valor recebido (no caso sabemos que será um email) à variável $email.
    // Lembrando que o valor recebido veio na própria URL, inserido 'manualmente' na montagem do link.
    $email = $_REQUEST["usuarioEmail"];


    // Agora vamos percorrer o array de usuários para ver se encontramos o email:
    foreach ($usuariosArray["usuarios"] as $usuario) {

        // Se encontrarmos um email que coincida com o email enviado...
        if ($usuario["email"] === $email) {

            // Atrelamos esse usuário (todo) à variável $usuarioEncontrado
            $usuarioEncontrado = $usuario;

            // DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O $_SESSION
            // echo "<br><pre>";
            // var_dump($usuarioEncontrado);
            // echo "</pre><br>";

        } else {
            // Se não encontrarmos...

            // Salvamos a variável $erro com o motivo do erro
            $erro = "Usuário não encontrado!";
        }
    }
}


?>
<!-- /CAPTURANDO DADOS DO USUÁRIO CLICADO, BUSCANDO O USUÁRIO NO JSON (PELO EMAIL) E CRIANDO UMA NOVA VARIÁVEL (SE ENCONTRADO) -->


<main class="container">
    <article class="row">
        <section class="col-12 mx-auto bg-light my-5 py-5 rounded border" id="usuario">

            <!-- CASO A GENTE RECEBA $_REQUEST["ver"] EXIBIMOS AS INFORMAÇÕES VINDAS DO JSON NUMA TABELA -->
            <?php if (isset($_REQUEST) && isset($_REQUEST["ver"]) && $_REQUEST["ver"] === "ver") : ?>

                <h3 class="col-12 text-center my-3">Detalhes do Usuário</h3>
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
                        <tr>
                            <th scope="row" colspan="2" class="text-left pl-4"><?= $usuarioEncontrado["nome"] . " " . $usuarioEncontrado["sobrenome"]; ?></th>
                            <td class="text-left"><a href="mailto:<?= $usuarioEncontrado["email"]; ?>?subject=Contato%20via%20Site%20PHP%20JSON" title="Enviar email para <?= $usuarioEncontrado["nome"] ?>"><?= $usuarioEncontrado["email"]; ?></a></td>
                            <!-- A função abaixo mantém apenas 10 caracteres
                                (a partir do caractere 0, o primeiro) e concatena com '...' -->
                            <td><?= substr($usuarioEncontrado["senha"], 0, 10) . "..."; ?></td>
                            <td colspan="2" class="pr-0">
                                <form id="editarUsuario" action="./usuario.php" method="post" class="d-inline">
                                    <input type="hidden" name="editar" value="editar">
                                    <button type="submit" name="usuarioEmail" value="<?= $usuario->email ?>" title="Editar dados de <?= $usuario->nome ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button>
                                </form>
                                <form id="excluirUsuario" action="./usuario.php" method="post" class="d-inline">
                                    <input type="hidden" name="excluir" value="excluir">
                                    <button type="submit" name="usuarioEmail" value="<?= $usuario->email ?>" title="Excluir <?= $usuario->nome ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>

            <?php endif; ?>
            <!-- /CASO A GENTE RECEBA $_REQUEST["ver"] EXIBIMOS AS INFORMAÇÕES VINDAS DO JSON NUMA TABELA -->

        </section>
    </article>
</main>
<?php require_once("./inc/footer.php"); ?>
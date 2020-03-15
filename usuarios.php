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
                                    <button type="submit" name="email" value="<?= $usuario["email"] ?>" title="Visulizar dados de <?= $usuario["nome"] ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></button>
                                </form>
                                <form id="editarUsuario" action="./usuario.php" method="post" class="d-inline">
                                    <input type="hidden" name="editar" value="editar">
                                    <button type="submit" name="email" value="<?= $usuario["email"] ?>" title="Editar dados de <?= $usuario["nome"] ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button>
                                </form>
                                <form id="excluirUsuario" action="./usuarios.php" method="post" class="d-inline">
                                    <input type="hidden" name="excluirUsuario" value="excluirUsuario">
                                    <button type="submit" name="email" value="<?= $usuario["email"] ?>" title="Excluir <?= $usuario["nome"] ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
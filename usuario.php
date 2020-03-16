<?php
$tituloPagina = "Detalhes do Usuário";
require_once("./inc/head.php");
require_once("./inc/header.php");
require("./utils/usuario.php");
?>
<main class="container">
    <article class="row">
        <section class="col-12 mx-auto bg-light my-5 py-5 rounded border" id="usuario">
            <?php if (isset($usuarioEncontrado) && $usuarioEncontrado && (!isset($_REQUEST["editar"]) || $_REQUEST["editar"] !== "editar")) : ?>
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
                            <td><?= substr($usuarioEncontrado["senha"], 0, 10) . "..."; ?></td>
                            <td colspan="2" class="pr-0">
                                <form id="editarUsuario" action="./usuario.php" method="post" class="d-inline">
                                    <input type="hidden" name="editar" value="editar">
                                    <button type="submit" name="email" value="<?= $usuarioEncontrado["email"]; ?>" title="Editar dados de <?= $usuarioEncontrado["nome"] ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button>
                                </form>
                                <form id="excluirUsuario" action="./usuarios.php" method="post" class="d-inline">
                                    <input type="hidden" name="excluirUsuario" value="excluirUsuario">
                                    <button type="submit" name="email" value="<?= $usuarioEncontrado["email"]; ?>" title="Excluir <?= $usuarioEncontrado["nome"] ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php elseif (isset($usuarioEncontrado) && $usuarioEncontrado && isset($_REQUEST) && isset($_REQUEST["editar"]) && $_REQUEST["editar"] === "editar") : ?>
                <form action="usuarios.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required value="<?= $usuarioEncontrado["nome"] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sobrenome">Sobrenome</label>
                            <input type="text" class="form-control" id="sobrenome" name="sobrenome" required value="<?= $usuarioEncontrado["sobrenome"] ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="emailCadastrado">email</label>
                            <input type="email" class="form-control" id="emailCadastrado" name="emailCadastrado" disabled value="<?= $usuarioEncontrado["email"] ?>">
                            <input type="hidden" class="form-control" id="email" name="email" required value="<?= $usuarioEncontrado["email"] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="senha">Senha (preencha a atual ou uma nova - obrigatório)</label>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck" checked>
                            <label class="form-check-label" for="gridCheck">
                                Concordo com os termos
                            </label>
                        </div>
                    </div>
                    <input type="hidden" name="editarUsuario" value="editarUsuario">
                    <button type="submit" class="btn btn-primary float-right" id="btnAtualizar">Atualizar</button>
                </form>
            <?php endif; ?>
        </section>
    </article>
</main>
<?php require_once("./inc/footer.php"); ?>
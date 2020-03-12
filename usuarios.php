<?php $tituloPagina = "Lista de Usuários"; ?>
<?php require_once("./inc/head.php"); ?>
<?php require_once("./inc/header.php"); ?>
    <main class="container">
        <article class="row">
            <section class="col-12 mx-auto bg-light my-5 py-5 rounded border" id="usuariosTb">
                <h3 class="col-12 text-center my-3"><?= $tituloPagina ?></h3>
                <table class="table my-5">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Sobrenome</th>
                        <th scope="col">email</th>
                        <th scope="col">Senha</th>
                        </tr>
                    </thead>
                    <tbody>
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
                    </tbody>
                </table>
            </section>
        </article>
    </main>
    <?php require_once("./inc/footer.php"); ?>
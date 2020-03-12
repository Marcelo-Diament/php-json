<?php $tituloPagina = "Lista de Usuários"; ?>
<?php require_once("./inc/head.php"); ?>
<?php require_once("./inc/header.php"); ?>

<!-- CAPTURANDO DADOS DO JSON -->
<?php
    
    $usuariosJson = file_get_contents("./data/usuarios.json");
    // DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O JSON DA MANEIRA QUE RECEBEMOS
    // echo "<br><pre>";
    // var_dump($usuariosJson);
    // echo "</pre><br>";
    // Perecba que o JSON nada mais é do que uma String. =)

    $usuariosObjetos = json_decode($usuariosJson);
    // DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O JSON DECODIFICADO
    // echo "<br><pre>";
    // var_dump($usuariosObjetos);
    // echo "</pre><br>";
    // Ao decodificarmos o JSON, transformamos aquela string em um objeto populado por arrays e objetos!

?>
<!-- /CAPTURANDO DADOS DO JSON -->

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

                        <?php foreach($usuariosObjetos->usuarios as $usuario): ?>
                            
                            <tr>

                                <th scope="row"><?= $usuario->nome; ?></th>
                                <td><?= $usuario->sobrenome; ?></td>
                                <td><?= $usuario->email; ?></td>
                                <td><?= $usuario->senha; ?></td>

                            </tr>
    
                        <?php endforeach; ?>

                        <!-- /CAPTURANDO REGISTROS DO JSON -->

                    </tbody>
                </table>
            </section>
        </article>
    </main>
    <?php require_once("./inc/footer.php"); ?>
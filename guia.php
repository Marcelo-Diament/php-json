<?php $tituloPagina = "Guia Visual de Funções"; ?>
<?php require_once("./inc/head.php"); ?>
<?php require_once("./inc/header.php"); ?>

<?php //setRegister( "usuarios", ["nome"=>"José","sobrenome"=>"da Silva", "email"=>"jose@dasilva.com", "senha"=> "123abc"] ); 
?>

<main class="container">
    <article class="row">
        <h1 class="col-12 text-center mt-5">functions.php</h1>
        <section class="col-12 mx-auto bg-light my-5 px-5 pt-5 rounded border">
            <h2 class="col-12 text-info text-center mb-5">init( )</h2>
            <article class="px-0 mx-0">
                <?php
                echo "<br/><p><b>A função init( ), além de iniciar uma sessão (session), também verifica o domínio e, se for 'localhost', define a variável \$ambiente como 'desenvolvimento'. Caso contrário, a define como 'produição'. Teste acessar o projeto usando o localhost e então o IP 127.0.0.1 e veja a diferença</b></p><pre class='bg-dark text-warning rounded p-3 my-5'>";
                var_dump(init());
                echo "</pre><br/>";
                ?>
            </article>
        </section>
        <section class="col-12 mx-auto bg-light my-5 px-5 pt-5 rounded border">
            <h2 class="col-12 text-info text-center mb-5">getJson( )</h2>
            <article class="px-0 mx-0">
                <h3>getJson( )</h3>
                <p><b>A função getJson( ) possui apenas um parâmetro, opcional, que é o caminho do arquivo JSON. Se não declarado, será utilizado o arquivo /data/dados.json.</b></p>
                <?php
                echo "<br/><pre class='bg-dark text-warning rounded p-3 mb-5'>";
                var_dump(getJson());
                echo "</pre><br/>";
                ?>
            </article>
            <article class="px-0 mx-0">
                <h3>getJson( "./data/inexistente.json" )</h3>
                <p><b>Se o arquivo enviado à função getJson( ) - parâmetro 1, que representa o caminho do JSON a ser consultado - for inexistente, retorna um erro.</b></p>
                <?php
                echo "<br/><pre class='bg-dark text-warning rounded p-3 mb-5'>";
                var_dump(getJson("./data/inexistente.json"));
                echo "</pre><br/>";
                ?>
            </article>
        </section>
        <section class="col-12 mx-auto bg-light my-5 px-5 pt-5 rounded border">
            <h2 class="col-12 text-info text-center mb-5">getRegisters( )</h2>
            <article class="px-0 mx-0">
                <h3>getRegisters( "usuarios" )</h3>
                <p><b>Função getRegisters( ) passando apenas o parâmetro 1, que indica em qual índice primário do array deve ser feita a consulta</b></p>
                <?php
                $usuarios = getRegisters("usuarios");
                echo "<br/><pre class='bg-dark text-warning rounded p-3 mb-5'>";
                var_dump($usuarios);
                echo "</pre><br/>";
                ?>
            </article>
            <article class="px-0 mx-0">
                <h3>getRegisters( "usuarios", ["nome, "Professor Marcelo"] )</h3>
                <p><b>Função getRegisters( ) passando o parâmetro 1, que indica em qual índice primário do array deve ser feita a consulta, e o parâmetro 2, um array com um identificador e o valor buscado</b></p>
                <?php
                $usuarioX = getRegisters("usuarios", ["nome", "Professor Marcelo"]);
                echo "<br/><pre class='bg-dark text-warning rounded p-3 mb-5'>";
                var_dump($usuarioX);
                echo "</pre><br/>";
                ?>
            </article>
            <article>
                <h3>getRegisters( "usuarios", ["email, "victor@torres.com.br"] )</h3>
                <p><b>Função getRegisters( ) passando o parâmetro 1, que indica em qual índice primário do array deve ser feita a consulta, e o parâmetro 2, um array com um identificador e o valor buscado</b></p>
                <?php
                $usuarioX = getRegisters("usuarios", ["email", "victor@torres.com.br"]);
                echo "<br/><pre class='bg-dark text-warning rounded p-3 mb-5'>";
                var_dump($usuarioX);
                echo "</pre><br/>";
                ?>
            </article>
            <article>
                <h3>getRegisters( "usuarios", ["email, "victor-torres@torres.com.br"] )</h3>
                <p><b>Função getRegisters( ) passando o parâmetro 1, que indica em qual índice primário do array deve ser feita a consulta, e o parâmetro 2, um array com um identificador e o valor buscado - no caso, um valor inexistente</b></p>
                <?php
                $usuarioX = getRegisters("usuarios", ["email", "victor-torres@torres.com.br"]);
                echo "<br/><pre class='bg-dark text-warning rounded p-3 mb-5'>";
                var_dump($usuarioX);
                echo "</pre><br/>";
                ?>
            </article>
        </section>
        <section class="col-12 mx-auto bg-light my-5 px-5 pt-5 rounded border">
            <h2 class="col-12 text-info text-center mb-5">setRegister( )</h2>
            <article class="px-0 mx-0">
                <h3>setRegister( "usuarios", ["nome"=>"José","sobrenome"=>"da Silva", "email"=>"jose@dasilva.com", "senha"=> "123abc"] )</h3>
                <p><b>Função setRegister( ) pode tanto cadastrar um novo objeto quanto editar um objeto existente</b></p>
                <?php
                //$usuarioNovo = setRegister( "usuarios", ["nome"=>"José","sobrenome"=>"da Silva", "email"=>"jose@dasilva.com", "senha"=> "123abc"] ); 
                echo "<br/><pre class='bg-dark text-warning rounded p-3 mb-5'>";
                //var_dump($usuarioNovo);
                echo "Se rodarmos a função adicionaremos esse novo usuário.<br>Para ver a função em ação, acesse o arquivo guia.php<br>e descomente a chamada e o respectivo 'var_dump()'";
                echo "</pre><br/>";
                ?>
            </article>
            <article class="px-0 mx-0">
                <h3>setRegister( "indiceInexistente", ["nome"=>"José","sobrenome"=>"da Silva", "email"=>"jose@dasilva.com", "senha"=> "123abc"] )</h3>
                <p><b>Função setRegister( ) usando um índice inexistente</b></p>
                <?php
                $setRegistroEmIndiceInexistente = setRegister( "indiceInexistente", ["nome"=>"José","sobrenome"=>"da Silva", "email"=>"jose@dasilva.com", "senha"=> "123abc"] );
                echo "<br/><pre class='bg-dark text-warning rounded p-3 mb-5'>";
                var_dump($setRegistroEmIndiceInexistente);
                echo "</pre><br/>";
                ?>
            </article>
        </section>
</main>
<?php require_once("./inc/footer.php"); ?>
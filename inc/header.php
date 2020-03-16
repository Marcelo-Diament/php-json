<?php

// Verificando se há sessão e se temos o usuário logado - só para verem o var_dump da $_SESSION
//if(isset($_SESSION) && isset($_SESSION["usuarioLogado"]) ) {

// DESCOMENTE AS 3 LINHAS ABAIXO PARA VER O $_SESSION["usuarioLogado"]
// echo "<br><pre>";
// var_dump($_SESSION["usuarioLogado"]);
// echo "</pre><br>";

//}

?>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="./index.php">JSON PHP</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="./index.php">Início <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./usuarios.php">Usuários</a>
                    </li>
                    <?php

                    // Verificando se há sessão e se temos o usuário logado:
                    if (isset($_SESSION["usuarioLogado"]) && $_SESSION["usuarioLogado"] === true) :

                    ?>
                        <!-- Menu exibido para usuários logados -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="menuUsuario" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i> <?= $_SESSION["usuarioNome"] ?> | Editar Perfil
                            </a>
                            <div class="dropdown-menu" aria-labelledby="menuUsuario">
                                <a class="dropdown-item" disabled href="./perfil.php" tabindex="-1" aria-disabled="true">Editar Perfil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="./logout.php">Logout</a>
                            </div>
                        </li>
                        <!-- /Menu exibido para usuários logados -->

                    <?php else : ?>

                        <!-- Menu exibido para usuários não logados -->
                        <li class="nav-item">
                            <a class="nav-link" href="./cadastro.php">Cadastre-se</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./login.php">Login</a>
                        </li>
                        <!-- /Menu exibido para usuários não logados -->

                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
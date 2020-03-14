<?php $tituloPagina = "Formulário de Cadastro"; ?>
<?php require_once("./inc/head.php"); ?>
<?php require_once("./inc/header.php"); ?>
<main class="container-fluid">
    <article class="row">
        <section id="bannerPrincipal" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#bannerPrincipal" data-slide-to="0" class="active"></li>
                <li data-target="#bannerPrincipal" data-slide-to="1"></li>
                <li data-target="#bannerPrincipal" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./assets/img/banner-principal-01-1920x1080.jpg" class="d-block w-100" alt="Banner Principal 01">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Banner Principal 01</h5>
                        <p>Uma imagem qualquer apenas para demonstração</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./assets/img/banner-principal-02-1920x1080.jpg" class="d-block w-100" alt="Banner Principal 02">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Banner Principal 02</h5>
                        <p>Outra qualquer apenas para demonstração</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./assets/img/banner-principal-03-1920x1080.jpg" class="d-block w-100" alt="Banner Principal 03">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Banner Principal 03</h5>
                        <p>Mais uma imagem qualquer apenas para demonstração</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#bannerPrincipal" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#bannerPrincipal" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </section>
    </article>
</main>
<?php require_once("./inc/footer.php"); ?>
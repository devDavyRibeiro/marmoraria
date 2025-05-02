<?php
require "config.php";
include DATABASE;
include HEADER_TEMPLATE;

?>

<br>
<?php if (!check_login()) : ?>
    <div id="carouselExampleCaptions" class="carousel slide ms-auto" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="slide1.jpg" class="d-block w-100" alt="...">

            </div>
            <div class="carousel-item">
                <img src="slide2.jpg" class="d-block w-100" alt="...">

            </div>
            <div class="carousel-item">
                <img src="slide3.jpg" class="d-block w-100" alt="...">

            </div>
            <div class="carousel-item">
                <img src="slide4.jpg" class="d-block w-100" alt="...">

            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <br>
    <br>
    <br>
    <h1 class="titulo-bonito text-center"> Um pouco sobre nós </h1>
    <br>
    <h4>Bem-vindo à Mármoria Chiovetto! Você sabia que existem diversos pontos de sua casa onde o mámore se torna uma peça única e elegante? Aqui, nós buscamos transformar seus sonhos em realidade a partir das nossas peças incríveis! Em nossa Mármoria, os projetos são realizados com muita dedicação ao que o cliente pede. Nossa empresa possui uma grande variedade e difencial em modelos como mármores e granitos.</h4>

    <br>
    <br>
    <div class="row w-100">
        <div class="col-md-6 mt-5">
            <img src="balcao3.jpg" class="img-fluid img1">
        </div>
        <div class="col-md-6">
            <div class="box text-center">
                <h1 class="titulo-grande">Atendimento dedicado!</h1>
                <h5>Se você sonha em ter o comodo dos sonhos, as peças que realizamos aqui são para você! Na Chiovetto transformamos sua casa dos sonhos em realidade, visando suas ideias e exigências para um excelente resultado.</h5>
                <br>
            </div>
        </div>
    </div>

    <br>
    <br>

    <div class="row w-100">
        <div class="col-md-6">
            <div class="box2 text-center">
                <h1 class="titulo-grande">Acabamentos Extraordinários!</h1>
                <h5>Nosso trabalho é realizado com grande profissionalismo e dedicação, alcançando a satisfação do cliente.</h5>
                <br>
            </div>
        </div>
        <div class="col-md-6 mt-5">
            <img src="banheiro1.jpg" class="img-fluid img2">
        </div>
    </div>


    <br>
    <br>

    <div class="row w-100">
        <div class="col-md-6 mt-5">
            <img src="balcao2.jpg" class="img-fluid img1">
        </div>
        <div class="col-md-6">
            <div class="box text-center">
                <h1 class="titulo-grande">Variedade e qualidade!</h1>
                <h5>Nossas peças contam com uma grande diversidade entre as peças selecionadas, visando sempre uma qualidade de altos padrões.</h5>
                <br>
            </div>
        </div>
    </div>
    <!-- Index logado -->
<?php else : ?>
    <div class="boxindexlogin">
        <div class="botoes">
            <!-- <div class="container-fluid"> -->
            <div class="row">
                <div class="col">
                    <h1 class="text-center"><i class="fa-solid fa-gear"></i> Opções</h1>
                    <hr>
                </div>
            </div>
            <?php if ($_SESSION['nivel'] > 0) : ?>
                <!-- index para funcionários e admin -->
                <div class="row pb-1">
                    <div class="col">
                        <a href="<?php echo BASEURL; ?>funcionarios/edit.php?i=<?php echo $_SESSION['id']; ?>">
                            <button class="btn glow-on-hover">Editar Perfil</button>
                        </a>
                    </div>
                    <!-- agendas e orçamentos -->
                    <?php if ($_SESSION['cargo'] == "admin" or $_SESSION['cargo'] == "orçamento") : ?>
                        <!-- index admin e orçamentno -->
                        <div class="col">
                            <a href="<?php echo BASEURL; ?>agendas/leitura.php">
                                <button class="btn glow-on-hover">Agendas</button>
                            </a>
                        </div>
                        <div class="col">
                            <button class="btn glow-on-hover" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Orçamentos
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li> <a class="btn" href="<?php echo BASEURL; ?>orcamentos/cadastro.php?i=<?php echo $_SESSION['id']; ?>">Novo Orçamento</a></li>
                                <a class="btn" href="<?php echo BASEURL; ?>orcamentos/leitura.php">Ver Orçamentos</a></li>
                            </ul>
                        </div>
                </div> <!-- final da div row com o if --> 
                <div class="row pb-1">
                    <div class="col">
                        <a href="<?php echo BASEURL; ?>producao/leitura.php">
                            <button class="btn glow-on-hover">Produções</button>
                        </a>
                    </div>                                       
                    <?php else : ?>
                            <div class="col">
                                <a href="<?php echo BASEURL; ?>producao/leitura.php">
                                    <button class="btn glow-on-hover">Produções</button>
                                </a>
                            </div>
                </div> <!-- final da div row com o else -->
                    <?php endif; ?>

                <!-- Produções -->


                    <?php if (check_admin()) : ?>
                        <!-- index só para admin -->
                        <!-- Produtos e Funcionários -->
                        <div class="col">
                            <button class="btn glow-on-hover" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Produtos
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li> <a class="btn" href="<?php echo BASEURL; ?>produtos/cadastro.php">Novo Produto</a></li>
                                <a class="btn" href="<?php echo BASEURL; ?>produtos/leitura.php">Ver Produtos</a></li>
                            </ul>
                        </div>
                        <div class="col">
                            <button class="btn glow-on-hover" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Funcionarios
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li> <a class="btn" href="<?php echo BASEURL; ?>funcionarios/cadastro.php">Novo Funcionario</a></li>
                                <a class="btn" href="<?php echo BASEURL; ?>funcionarios/leitura.php">Ver funcionarios</a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <!-- Index Clientes -->
                <div class="row pb-1">
                    <div class="col">
                        <a href="<?php echo BASEURL; ?>clientes/edit.php?i=<?php echo $_SESSION['id']; ?>">
                            <button class="btn glow-on-hover">Editar Perfil</button>
                        </a>
                    </div>
                    <div class="col">
                        <button class="btn glow-on-hover" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Agenda
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>agendas/cadastro.php?i=<?php echo $_SESSION['id']; ?>">Agendar Visita</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>agendas/leitura.php?i=<?php echo $_SESSION['id']; ?>">Ver seus Agendamentos</a></li>
                        </ul>
                    </div>
                    <div class="col">
                        <button class="btn glow-on-hover" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Orçamentos
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>orcamentos/leitura.php?i=<?php echo $_SESSION['id']; ?>">Ver seus Agendamentos</a></li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            <!-- </div> -->
        </div>
    </div>
<?php endif; ?>


<?php include FOOTER_TEMPLATE; ?>
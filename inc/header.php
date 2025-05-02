<!DOCTYPE html>
<html>

<head>
	<link rel="icon" href="<?php echo BASEURL?>inc/MC.ico" type="image/x-icon">
	<title>Marmoraria Chiovetto</title>
	<!-- Bootstrap versão 5.1.3-->
	<link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo BASEURL; ?>css/fontawesome/all.min.css">
	<link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">

</head>

<body>
	<header class="header"> <!-- criei uma classe header no css pra formatar a parte do header-->
		<div>
			<nav class="navbar navbar-expand-lg navbar-dark bg-color "><!-- transformei a classe navbar-light para navbar-dark para ser legivel nas cores escuras-->
				<div class="container-fluid">
					<a href="<?php echo BASEURL; ?>"><img src="<?php echo BASEURL; ?>/inc/Logo.jpg" width=100%></a> <!-- Adiciona a logo no header, e também serve como botão para voltar para o home-->
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse " id="navbarSupportedContent">
						<ul class="navbar-nav mb-2 mb-lg-0">
							<li class="nav-item dropdown ps-2">
								<a class="nav-link animated-button my-float" href="<?php echo BASEURL; ?>" style="color: white;">
									<h5>Home</h5>
								</a>
							</li>
							<li class="nav-item dropdown ps-2">
								<a class="nav-link animated-button my-float" href="<?php echo BASEURL; ?>trabalhos" style="color: white;">
									<h5>Trabalhos</h5>
								</a>
							</li>
							<!-- Agendas Orçamentos e Produções -->
							<?php if (check_admin_funcionario()) : ?>
								<?php if ($_SESSION['cargo'] == "admin" or $_SESSION['cargo'] == "orçamento") : ?>
									<li class="nav-item dropdown ps-2">
										<a class="nav-link animated-button my-float" href="<?php echo BASEURL; ?>agendas/leitura.php" style="color: white;">
											<h5>Agendas</h5>
										</a>
									</li>
									<li class="nav-item dropdown ps-2">
										<a class="nav-link animated-button my-float" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
											<h5>Orçamentos</h5>
										</a>
										<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
											<li><a class="dropdown-item" href="<?php echo BASEURL; ?>orcamentos/cadastro.php?i=<?php echo $_SESSION['id']; ?>">Novo Orçamento</a></li>
											<li><a class="dropdown-item" href="<?php echo BASEURL; ?>orcamentos/leitura.php">Meus Orçamentos</a></li>
										</ul>
									</li>
								<?php endif; ?>
								<li class="nav-item dropdown ps-2">
									<a class="nav-link animated-button my-float" href="<?php echo BASEURL; ?>producao/leitura.php" style="color: white;">
										<h5>Produções</h5>
									</a>
								</li>

							<?php endif; ?>
							<!-- Produtos e Funcionarios -->
							<?php if (check_admin()) : ?>
								<li class="nav-item dropdown ps-2">
									<a class="nav-link animated-button my-float" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
										<h5>Produtos</h5>
									</a>
									<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
										<li><a class="dropdown-item" href="<?php echo BASEURL; ?>produtos/cadastro.php">Novo Produto</a></li>
										<li><a class="dropdown-item" href="<?php echo BASEURL; ?>produtos/leitura.php">Meus Funcionarios</a></li>
									</ul>
								</li>
								<li class="nav-item dropdown ps-2">
									<a class="nav-link animated-button my-float" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
										<h5>Funcionarios</h5>
									</a>
									<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
										<li><a class="dropdown-item" href="<?php echo BASEURL; ?>funcionarios/cadastro.php">Novo Funcionário</a></li>
										<li><a class="dropdown-item" href="<?php echo BASEURL; ?>funcionarios/leitura.php">Meus Funcionários</a></li>
									</ul>
								</li>							
							<?php else : ?>
								<li class="nav-item dropdown ps-2">
									<a class="nav-link animated-button my-float" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
										<h5>Contatos</h5>
									</a>
									<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
										<li><a class="dropdown-item" href="mailto:Veraluciasantosdelima88@gmail.com?subject=">Enviar e-mail</a></li>
										<li><a class="dropdown-item" href="tel:+5515997285951">Telefone</a></li>
										<li><a class="dropdown-item" href="https://wa.me/5515997285951?text=Oi,%20estou%20entrando%20em%20contato%20através%20do%20site.%20Gostaria%20de%20fazer%20uma%20encomenda%20por%20favor">WhatsApp</a></li>
										<li><a class="dropdown-item" href="https://www.instagram.com/chiovetto_/">Instagram</a></li>
                                	</ul>
								</li>
							<?php endif; ?>
						</ul>
					</div>
					<div class="collapse navbar-collapse justify-content-end dropdown dropstart" id="navbarSupportedContent">
						<ul class="navbar-nav mb-2 mb-lg-0">
							<li class="nav-item dropdown ps-2">
								<a class="nav-link my-float" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									<h3><i class="fa-solid fa-user" style="color: #ffffff;"></i></h3>
								</a>
								<ul class="dropdown-menu" aria-labelledby="navbarDropdown">

									<?php if (!check_login()) : ?>
										<li><a class="dropdown-item" href="#" id="navbarDropdown" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
										<li>
											<hr class="dropdown-divider">
											</hr>
										</li>
										<li><a class="dropdown-item" href="<?php echo BASEURL; ?>clientes/cadastrar.php">Cadastrar</a></li> <!-- cadastrar -->

									<?php else : ?>
										<?php if (check_admin_funcionario()) : ?>
											<li><a class="dropdown-item" href="<?php echo BASEURL; ?>funcionarios/edit.php?i=<?php echo $_SESSION['id']; ?>">Perfil</a></li>
											<li>
											<?php else : ?>
											<li><a class="dropdown-item" href="<?php echo BASEURL; ?>clientes/edit.php?i=<?php echo $_SESSION['id']; ?>">Perfil</a></li>
											<li>
											<?php endif; ?>
											<hr class="dropdown-divider">
											</hr>
											</li>
											<li><a class="dropdown-item" href="<?php echo BASEURL; ?>login/logout.php">Sair</a></li>
										<?php endif; ?>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="<?php echo BASEURL; ?>js/JS.js"></script>
	<main class="main-content"> <!-- adicionei a classe conteiner no main. -->
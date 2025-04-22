<?php
$arrRecursos[] = 'aos';

if(!isset($tagTitle)){ $tagTitle = $arrCampos['nome']." - Descubra Conteúdos Incríveis Sobre ".$arrCampos['tema']; }
if(!isset($tagDescription)){ $tagDescription = "Explore os melhores artigos sobre ".$arrCampos['tema'].". Dicas, novidades e tendências para você ficar sempre atualizado!"; }

$busca = null;
?>

<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="auto">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Xweb">

	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo URL; ?>assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="<?php echo URL; ?>assets/img/favicon.png">

	<title><?php echo $tagTitle; ?></title>
	<meta name="description" content="<?php echo $tagDescription; ?>">
	<meta name="robots" content="index">

	<!-- CSS CORE -->
	<link href="<?php echo URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo URL; ?>assets/css/bootstrap-icons.css" rel="stylesheet">

	<!-- CSS PLUGINS -->
	<?php if(in_array("aos", $arrRecursos)){ ?>
		<link href="<?php echo URL; ?>assets/css/plugins/aos.css" rel="stylesheet">
	<?php } ?>

	<!-- CSS CUSTOM -->
	<link href="<?php echo URL; ?>assets/css/custom-xweb.css?v=1.1.1" rel="stylesheet">

	<style type="text/css">
		:root,
		[data-bs-theme=light] {
			--bs-primary: <?php echo $arrCampos['cor_primaria']; ?>;
			--bs-secondary: <?php echo $arrCampos['cor_secundaria']; ?>;
			--bs-primary-text-emphasis: <?php echo $arrCampos['cor_secundaria']; ?>;
			--bs-secondary-text-emphasis: <?php echo $arrCampos['cor_primaria']; ?>;
		}
	</style>

</head>

<body>

	<header class="position-relative" data-aos="fade-down" data-aos-duration="500">
		<div class="page-header min-vh-50 bg-gradient-primary">
			<div class="container mt-n6">
				<div class="row justify-content-center">
					<div class="col-lg-10">
						<div class="row justify-content-center align-items-center">
							<div class="col-5 col-lg-3 text-center px-lg-5 pb-lg-2">
								<a class="navbar-brand" href="<?php echo URL; ?>" rel="tooltip" title="<?php echo $arrCampos['nome']; ?>" data-placement="bottom">
									<img src="<?php echo $arrCampos['imagem']; ?>" class="img-fluid">
								</a>
							</div>
							<div class="col-12 col-lg-6">
								<h1 class="text-white text-center"><?php echo $arrCampos['nome']; ?></h1>
							</div>
							<div class="col-12 col-lg-3 mt-lg-3">
								<ul class="nav float-lg-end justify-content-center">
									<?php if($arrCampos['instagram']){ ?>
										<li class="nav-item">
											<a class="nav-link p-2" href="<?php echo $arrCampos['instagram']; ?>" target="_blank">
												<i class="bi bi-instagram text-white text-lg"></i>
											</a>
										</li>
									<?php } ?>
									<?php if($arrCampos['tiktok']){ ?>
										<li class="nav-item">
											<a class="nav-link p-2" href="<?php echo $arrCampos['tiktok']; ?>" target="_blank">
												<i class="bi bi-tiktok text-white text-lg"></i>
											</a>
										</li>
									<?php } ?>
									<?php if($arrCampos['facebook']){ ?>
										<li class="nav-item">
											<a class="nav-link p-2" href="<?php echo $arrCampos['facebook']; ?>" target="_blank">
												<i class="bi bi-facebook text-white text-lg"></i>
											</a>
										</li>
									<?php } ?>
									<?php if($arrCampos['youtube']){ ?>
										<li class="nav-item">
											<a class="nav-link p-2" href="<?php echo $arrCampos['youtube']; ?>" target="_blank">
												<i class="bi bi-youtube text-white text-lg"></i>
											</a>
										</li>
									<?php } ?>
									<?php if($arrCampos['whatsapp']){ ?>
										<li class="nav-item">
											<a class="nav-link p-2" href="https://wa.me/55<?php echo $arrCampos['whatsapp_limpo']; ?>">
												<i class="bi bi-whatsapp text-white text-lg"></i>
											</a>
										</li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="position-absolute w-100 z-index-1 bottom-0">
			<svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
				<defs>
					<path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
				</defs>
				<g class="moving-waves">
					<use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40"></use>
					<use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>
					<use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)"></use>
					<use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)"></use>
					<use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)"></use>
					<use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95)"></use>
				</g>
			</svg>
		</div>
	</header>

	<section class="mt-n9">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 z-1 rounded mx-auto blur shadow-blur py-2" data-aos="fade-up" data-aos-duration="500">
					<div class="row">
						<nav class="navbar navbar-expand-lg" aria-label="Thirteenth navbar example">
							<div class="container-fluid py-2">

								<button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample11" aria-controls="navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon"></span>
								</button>
								<div class="collapse navbar-collapse d-lg-flex" id="navbarsExample11">
									<ul class="navbar-nav col-lg-8 justify-content-center mx-auto">
										<?php 
										$arrMenu = ControllerMenu::listar("id_superior IS NULL ORDER BY ordem ASC", null, array('id','id_superior','nome', 'link', 'target', 'ordem'));
										if($arrMenu){
											foreach ($arrMenu as $objMenu) {

												$arrSubMenu = ControllerMenu::listar("id_superior = '".$objMenu->getId()."' ORDER BY ordem ASC", null, array('id','id_superior','nome', 'link', 'target', 'ordem'));
												if($arrSubMenu){
													echo '<li class="nav-item">
													<div class="dropdown">
													<a class="nav-link px-3 text-bold dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
													'.$objMenu->getNome().'
													</a>
													<ul class="dropdown-menu">';
													foreach($arrSubMenu as $objSubMenu){
														echo '<li>
														<a href="'.$objSubMenu->getUrlLink().'" target="'.$objSubMenu->getTarget().'" class="dropdown-item"><span>'.$objSubMenu->getNome().'</span></a>
														</li>
														';
													}
													echo '</ul>
													</div>
													</li>';
												}else{
													echo '<li class="nav-item">
													<a class="nav-link px-3 text-bold" href="'.$objMenu->getUrlLink().'" target="'.$objMenu->getTarget().'" >
													'.$objMenu->getNome().'
													</a>
													</li>';
												}
											}
										}
										?>
									</ul>
								</div>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</section>
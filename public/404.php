<?php
$titulo = "404 - Página Não Encontrada";
include('_header.php');
?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 d-flex justify-content-center flex-column">
				<div class="card d-flex blur justify-content-center p-4 shadow-lg mt-4">
					<h3 class="text-danger">404 - Página Não Encontrada</h3>
					<p>
						Acesse o menu para voltar ao site
					</p>
				</div>
			</div>
			<div class="col-lg-4">
				<img src="<?php echo URL; ?>assets/img/404.png" class="w-100">
			</div>
		</div>
	</div>
</section>

<?php include('_footer.php'); ?>
<?php
$tagTitle = $objPagina->getMetaTitle();
$tagDescription = $objPagina->getMetaDescription();
if(!isset($tagTitle)){ $tagTitle = $objPagina->getNome()." | ".$arrCampos['nome']; }
if(!isset($tagDescription)){ $tagDescription = $objPagina->getNome()." | ".$arrCampos['nome']; }
include('_header.php');
?>

<section>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10 px-0" data-aos="fade-right" data-aos-duration="1000">
				<div class="row">
					<div class="col-12">
						<div class="card d-flex blur justify-content-center p-4 shadow-lg mt-4">
							<h1 class="text-gradient text-primary fs-2"><?php echo $objPagina->getNome(); ?></h1>
							<?php echo str_replace($arrCamposKeys, $arrCampos, $objPagina->getConteudo()); ?>
							<?php if(strpos($objPagina->getConteudo(), "{{formulario}}")){ include('_contato.php'); } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include('_footer.php'); ?>
<?php if(isset($arrAdminPermissoes[$objRoute->getArrUrl(1)]['gerenciar'])){ ?>
	<div class="row col-12 mb-3">
		<a class="btn btn-outline-primary" href="<?php echo $urlAdminModulo."gerenciar/"; ?>"><i class="fa fa-list"></i> Gerenciar</a>
	</div>
<?php } ?>
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">Excluir</h3>
	</div>
	<div class="col-12 mt-2">
		<?php echo $alertaSistema; ?>
	</div>
</div>
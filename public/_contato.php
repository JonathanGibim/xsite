<?php if(!empty($alertaSistema)){ echo $alertaSistema; } ?>

<form action="<?php echo URL_ATUAL; ?>" method="POST" autocomplete="off">
	<div class="card-body pb-2">
		<div class="row">
			<div class="col-md-6">
				<label>Nome</label>
				<div class="input-group mb-4">
					<input type="text" name="nome" class="form-control" placeholder="Digite seu nome" value="<?= $nome; ?>">
				</div>
			</div>
			<div class="col-md-6 ps-md-2">
				<label>E-mail</label>
				<div class="input-group">
					<input type="email" name="email" class="form-control" placeholder="Digite seu e-mail" value="<?= $email; ?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 ps-md-2">
				<label>Telefone</label>
				<div class="input-group">
					<input type="text" name="telefone" class="form-control mask_telcel" placeholder="Digite seu telefone" value="<?= $telefone; ?>">
				</div>
			</div>
			<div class="col-md-6">
				<label>Assunto</label>
				<div class="input-group mb-4">
					<input type="text" name="assunto" class="form-control" placeholder="Digite o assunto" value="<?= $assunto; ?>">
				</div>
			</div>
		</div>
		<div class="form-group mb-0 mt-md-0 mt-4">
			<label>Mensagem</label>
			<textarea name="mensagem" class="form-control" id="message" rows="6" placeholder="Descreva sua mensagem"><?= $mensagem; ?></textarea>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				<button type="submit" name="submitForm" value="contato-site" class="btn btn-md btn-primary bg-gradient-primary mt-3 px-5">Enviar</button>
			</div>
		</div>
	</div>
</form>
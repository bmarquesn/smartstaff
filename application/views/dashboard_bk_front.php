<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php echo doctype('html5'); ?>
<html lang="pt-br">
	<head>
		<?php require_once(APPPATH.'views/estrutura/head.php'); ?>
	</head>
	<body>
		<div class="container">
			<h1 class="text-center">Smarts Dashboard</h1>
			<br />
			<div class="row" id="ordenar">
				<div class="col-2">ORDENAR:</div>
				<div class="col">
					<button type="button" class="btn btn-info active">Menor Budget</button>
				</div>
				<div class="col">
					<button type="button" class="btn btn-info">Maior Budget</button>
				</div>
				<div class="col">
					<button type="button" class="btn btn-info">A - Z</button>
				</div>
				<div class="col">
					<button type="button" class="btn btn-info">Z - A</button>
				</div>
			</div>
			<br />
			<div class="row" id="filtrar">
				<div class="col-2">FILTRAR:</div>
				<div class="col-5">
					<div class="row">
						<div class="col"><input type="text" class="form-control datepicker" name="data_inicio" value="" placeholder="Data Início" id="data_inicio" /></div>
						<div class="col"><label for="data_inicio"><img src="<?php echo base_url().'assets/img/calendario.png'; ?>" alt="Calendário Data Início" title="Calendário Data Início" /></label></div>
					</div>
				</div>
				<div class="col-5">
					<div class="row">
						<div class="col"><input type="text" class="form-control datepicker" name="data_fim" value="" placeholder="Data Fim" id="data_fim" /></div>
						<div class="col"><label for="data_fim"><img src="<?php echo base_url().'assets/img/calendario.png'; ?>" alt="Calendário Data Fim" title="Calendário Data Fim" /></label></div>
					</div>
				</div>
			</div>
			<br />
			<div id="usuarios">
				<?php
				if(!empty($dados_json)) {
					foreach($dados_json as $key => $value) {
				?>
				<div class="row usuario">
					<div class="col-2 text-center align-self-center">
						<img src="<?php echo $value->pictures[0]->url; ?>" alt="Foto" title="Foto" class="img-fluid" />
					</div>
					<div class="col align-self-center">
						<span><strong>Nome:</strong> <?php echo $value->name->first." ".$value->name->last; ?></span>
						<span><strong>Email:</strong> <a href="mailto:<?php echo $value->email; ?>?subject=Contato via sistema Smartstaff - Bruno Nogueira"><?php echo $value->email; ?></a></span>
						<span><strong>Age:</strong> <?php echo $value->age; ?></span>
						<span><strong>Budget:</strong> <?php echo $value->budget; ?></span>
					</div>
				</div>
				<?php
					}
				}
				?>
			</div>
			<br />
			<div class="row text-center">
				<div class="col"><button type="button" class="btn btn-primary">Anterior</button></div>
				<div class="col"><button type="button" class="btn btn-primary">Próximo</button></div>
			</div>
		</div>
		<?php require_once(APPPATH.'views/estrutura/assinatura_site.php'); ?>
		<?php require_once(APPPATH.'views/estrutura/footer.php'); ?>
	</body>
</html>
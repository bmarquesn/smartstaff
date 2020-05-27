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
				<div class="col-2 align-self-center">ORDENAR:</div>
				<div class="col">
					<button type="button" class="btn btn-info">Menor Budget</button>
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
				<div class="col">
					<button type="button" class="btn btn-info">Remover Ordenacao</button>
				</div>
			</div>
			<br />
			<div class="row" id="filtrar">
				<div class="col-2 align-self-center">FILTRAR:</div>
				<div class="col-5">
					<div class="row">
						<div class="col"><input type="text" class="form-control datepicker" name="data_inicio" value="<?php echo isset($data_de)&&!empty($data_de)?$data_de:''; ?>" placeholder="Data Início" id="data_inicio" /></div>
						<div class="col"><label for="data_inicio"><img src="<?php echo base_url().'assets/img/calendario.png'; ?>" alt="Calendário Data Início" title="Calendário Data Início" /></label></div>
					</div>
				</div>
				<div class="col-5">
					<div class="row">
						<div class="col"><input type="text" class="form-control datepicker" name="data_fim" value="<?php echo isset($data_ate)&&!empty($data_ate)?$data_ate:''; ?>" placeholder="Data Fim" id="data_fim" /></div>
						<div class="col"><label for="data_fim"><img src="<?php echo base_url().'assets/img/calendario.png'; ?>" alt="Calendário Data Fim" title="Calendário Data Fim" /></label></div>
					</div>
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-3">
					<select class="form-control" name="itens_por_pagina">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select>
				</div>
				<div class="col align-self-center">: ÍTENS POR PÁGINA</div>
				<div class="col align-self-center">Quantidade de Usuários: <?php echo count($dados_json); ?></div>
			</div>
			<br />
			<div id="usuarios">
				<table class="table table-borderless w-100">
					<tbody>
						<tr>
							<td align="center">Nenhum dado ainda...</td>
						</tr>
					</tbody>
				</table>
			</div>
			<br />
			<div class="row text-center">
				<div class="col"><button id="anterior" disabled="disabled" class="btn btn-primary">&lsaquo; Anterior</button></div>
				<div class="col"><span id="numeracao"></span></div>
				<div class="col"><button id="proximo" disabled="disabled" class="btn btn-primary">Próximo &rsaquo;</button></div>
			</div>
		</div>
		<?php require_once(APPPATH.'views/estrutura/assinatura_site.php'); ?>
		<form action="" name="filtrar" style="display:none !important;">
			<input type="hidden" name="itens_pagina" value="<?php echo $itens_pagina; ?>" />
			<input type="hidden" name="data_de" value="<?php echo !empty($data_de)?$data_de:''; ?>" />
			<input type="hidden" name="data_ate" value="<?php echo !empty($data_ate)?$data_ate:''; ?>" />
			<input type="hidden" name="tipo_ordenacao" value="<?php echo !empty($tipo_ordenacao)?$tipo_ordenacao:''; ?>" />
		</form>
		<?php require_once(APPPATH.'views/estrutura/footer.php'); ?>
		<script type="text/javascript">
			/** estas variáveies serão usadas pelo arquivo JS */
			var tamanhoPagina = <?php echo (int)$itens_pagina; ?>;
			var pagina = <?php echo (int)$numero_pagina; ?>;
			var tipo_ordenacao = '<?php echo $tipo_ordenacao; ?>';
			var dados = [
			<?php
			/** ID, FOTO, NOME, EMAIL, IDADE, BUDGET, DATAENTRADA */
			if(!empty($dados_json)) {
				foreach($dados_json as $key => $value):
					echo "['".$value->_id."', '".$value->pictures[0]->url."', '".$value->name->first." ".$value->name->last."', '".$value->email."', '".$value->age."', '".$value->budget."', '".date('d/m/Y', strtotime($value->registered))."'],";
				endforeach;
			}
			?>
			];
		</script>
	</body>
</html>
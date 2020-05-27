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
			<table>
				<tbody>
					<tr>
						<td align="center">Nenhum dado ainda...</td>
					</tr>
				</tbody>
			</table>
			<div>
				<button id="anterior" disabled>&lsaquo; Anterior</button>
					<span id="numeracao"></span>
				<button id="proximo" disabled>Próximo &rsaquo;</button>
			</div>
		</div>
		<?php require_once(APPPATH.'views/estrutura/assinatura_site.php'); ?>
		<?php require_once(APPPATH.'views/estrutura/footer.php'); ?>
		<?php //var_dump($dados_json);die; ?>;
		<script type="text/javascript">
			//var dados = <?php //echo $dados_json; ?>;
			/*var dados = [
				['Banana'],
				['Maça'],
				['Pera'],
				['Goiaba'],
				['Tamarindo'],
				['Cenoura'],
				['Alface'],
				['Tomate'],
				['Abacaxi'],
				['Kiwi'],
				['Cebola'],
				['Alho'],
				['Abóbora'],
				['Pêssego'],
				['laranja']
			];*/
			var dados = [
			<?php
			/** ID, FOTO, NOME, EMAIL, IDADE, BUDGET */
			foreach($dados_json as $key => $value):
				echo "['".$value->_id."', '".$value->pictures[0]->url."', '".$value->name->first." ".$value->name->last."', '".$value->email."', '".$value->age."', '".$value->budget."'],";
			endforeach;
			?>
			];

			var tamanhoPagina = 6;
			var pagina = 0;

			function paginar() {
				$('table > tbody > tr').remove();
				var tbody = $('table > tbody');
				var html_usuario = "";
				for (var i = pagina * tamanhoPagina; i < dados.length && i < (pagina + 1) *  tamanhoPagina; i++) {
					html_usuario = '<div class="row usuario">';
					html_usuario += '<div class="col-2 text-center align-self-center">';
					html_usuario += '<img src="'+dados[i][1]+'" alt="Foto" title="Foto" class="img-fluid" />';
					html_usuario += '</div>';
					html_usuario += '<div class="col align-self-center">';
					html_usuario += '<span><strong>Nome:</strong> '+dados[i][2]+'</span>';
					html_usuario += '<span><strong>Email:</strong> <a href="mailto:'+dados[i][3]+'?subject=Contato via sistema Smartstaff - Bruno Nogueira">'+dados[i][3]+'</a></span>';
					html_usuario += '<span><strong>Age:</strong> '+dados[i][4]+'</span>';
					html_usuario += '<span><strong>Budget:</strong> '+dados[i][5]+'</span>';
					html_usuario += '</div>';
					html_usuario += '</div>';
					tbody.append($('<tr>').html($('<td>').html(html_usuario)))
				}
				$('#numeracao').text('Página ' + (pagina + 1) + ' de ' + Math.ceil(dados.length / tamanhoPagina));
			}

			function ajustarBotoes() {
				$('#proximo').prop('disabled', dados.length <= tamanhoPagina || pagina >= Math.ceil(dados.length / tamanhoPagina) - 1);
				$('#anterior').prop('disabled', dados.length <= tamanhoPagina || pagina == 0);
			}

			$(function() {
				$('#proximo').click(function() {
					if (pagina < dados.length / tamanhoPagina - 1) {
						pagina++;
						paginar();
						ajustarBotoes();
					}
				});
				$('#anterior').click(function() {
					if (pagina > 0) {
						pagina--;
						paginar();
						ajustarBotoes();
					}
				});
				paginar();
				ajustarBotoes();
			});
		</script>
	</body>
</html>
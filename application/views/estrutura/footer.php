<div id="modalExibirMensagem" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">MENSAGEM</h4></div>
			<div class="modal-body">
				<p></p>
			</div>
			<div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button></div>
		</div>
	</div>
</div>
<script type="text/javascript">var base_url = '<?php echo base_url(); ?>';</script>
<?php
//javascripts
$loadJQuery = array('src' => 'assets/js/jquery/jquery-2.1.1.js', 'type' => 'text/javascript');
$bootstrap = array('src' => 'assets/js/bootstrap/bootstrap.min.js', 'type' => 'text/javascript');
$jQueryUi = array('src' => 'assets/js/jquery/jquery-ui.min.js', 'type' => 'text/javascript');
$smartstaff_functions = array('src' => 'assets/js/smartstaff_functions.js?time='.time(), 'type' => 'text/javascript');

echo script_tag($loadJQuery);
echo script_tag($bootstrap);
echo script_tag($jQueryUi);
echo script_tag($smartstaff_functions);

if(isset($scripts_js) && !empty($scripts_js)) {
	foreach($scripts_js as $key => $value) {
		$jsPersonalizado = array('src' => $value.'?time='.time(), 'type' => 'text/javascript');
		echo script_tag($jsPersonalizado);
	}
}

if(isset($msg) && !empty($msg)) {
	echo "<script>
		$(function(){
			$('.alert.bg-danger').find('span').html('".$msg."');
			$('.alert.bg-danger').show('fast');
		});
	</script>";
}
?>
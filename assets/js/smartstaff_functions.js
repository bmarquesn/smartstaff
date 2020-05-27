$(function() {
	$("a").click(function(event) {
        if ($(this).attr("href") === "http://#" || $(this).attr("href") === "#" || $(this).attr("href") === "") {
            event.preventDefault();
        }
    });
	$('.datepicker').datepicker({
		dateFormat: 'dd/mm/yy',
		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
		dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
		nextText: 'Próximo',
		prevText: 'Anterior',
		currentText: 'Hoje',
		closeText: 'Fechar'
	});

	/** para a paginacao so json */
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
	/** setar itens por pagina */
	$('select[name="itens_por_pagina"]').val(tamanhoPagina);
	$('select[name="itens_por_pagina"]').on('change', function(){
		var itens_por_pagina=$(this).val();
		$('body').find('form[name="filtrar"]').children('input[name="itens_pagina"]').val(itens_por_pagina);
		$('body').find('form[name="filtrar"]').submit();
	});
	/** filtrar por data */
	$('input[name="data_inicio"]').on('change', function(){
		var data_inicio=$(this).val();
		$('body').find('form[name="filtrar"]').children('input[name="data_de"]').val(data_inicio);
		$('body').find('form[name="filtrar"]').submit();
	});
	$('input[name="data_fim"]').on('change', function(){
		var data_fim=$(this).val();
		$('body').find('form[name="filtrar"]').children('input[name="data_ate"]').val(data_fim);
		$('body').find('form[name="filtrar"]').submit();
	});
	/** ordernar o resultado */
	$('#ordenar').find('button').on('click', function(){
		var tipo_ordenacao=$(this).text();
		if(tipo_ordenacao=="Tirar Ordenacao"){
			$('body').find('form[name="filtrar"]').children('input[name="tipo_ordenacao"]').val('');
		}else{
			$('body').find('form[name="filtrar"]').children('input[name="tipo_ordenacao"]').val(tipo_ordenacao);
		}
		$('body').find('form[name="filtrar"]').submit();
	});
	if(tipo_ordenacao!=0&&tipo_ordenacao!="Tirar Ordenacao"){
		$('#ordenar').find('button').each(function(){
			if($(this).text()==tipo_ordenacao){
				$(this).addClass('active');
				return false;
			}
		});
	}
});

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
		html_usuario += '<span><strong>Data Entrada:</strong> '+dados[i][6]+'</span>';
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
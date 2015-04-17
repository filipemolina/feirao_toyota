// Variáveis Globais

App = {};

// Funções globais

function getDados(concessionaria)
{
	// As concessionárias nessa lista devem estar na mesma ordem em que aparecem no select do index

	concessionarias = [
		{ nome : "", telefone : "" },
		{ nome : "Inter Japan - Botafogo", telefone : "(21) 21769400" },
		{ nome : "Inter Japan - Barra", telefone : "(21) 8888-8888" },
	];

	return concessionarias[concessionaria];
}

function mostraDados(dados)
{
	$("span.local-span").html(dados.nome);
	$("span.telefone-span").html(dados.telefone);
}

// Eventos principais

$(document).ready(function(){

	// Slider

	$('.slider').fractionSlider({
		'fullWidth': 			true,
		'controls': 			false, 
		'pager': 				false,
		'responsive': 			true,
		'dimensions': 			"1000,670",
	    'increase': 			false,
		'pauseOnHover': 		true,
		//'slideEndAnimation': 	true
	});

	// Select de Telefones

	$("select.select-telefone").change(function(){

		var concessionaria = $(this).val();

		mostraDados(getDados(concessionaria));

	});

	// Botão para abrir o chat

	$("a.button").click(function(){

		$zopim.livechat.window.show();

	});
	
});
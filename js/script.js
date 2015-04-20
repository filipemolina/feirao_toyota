// Variáveis Globais

App = {};

App.expandido = false;

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
	// Aumentar o background e mostrar o telefone

	if(!App.expandido)
	{
		$(".contente").animate({ height : "250px" }, 400, 'swing', function(){

			$("span.telefone-span").html(dados.telefone);

			App.expandido = true;

		});
	}
	else
	{
		$("span.telefone-span").html(dados.telefone);
	}

	// Caso nenhuma concessionária tenha sido selecinada, diminuir o background

	if(dados.nome == "")
	{
		$(".contente").stop().animate({ height: '190px' }, 400, 'swing', function(){

			$("span.telefone-span").html(dados.telefone);

			App.expandido = false;

		});
	}
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
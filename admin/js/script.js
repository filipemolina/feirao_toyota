App = {};

App.inscritos = 0;
App.inscritos_carteirinha = 0;
App.total_participantes = 0;

App.confirmados = 0;
App.confirmados_carteirinha = 0;
App.confirmados_participantes = 0;

// Função que obtém os dados do banco e preenche a tabela

function preencheTabela()
{
	var checkbox;
	var carteirinha;

	for(dado in dados)
	{
		// Incrementar a quantidade de inscritos

		App.inscritos++;

		// Tratamento da checkbox

		if(dados[dado].confirmado == 1)
		{
			// Incrementar a quantidade de confirmados

			App.confirmados++;

			// Incrementar os participantes confirmados

			App.confirmados_participantes += parseFloat(dados[dado].num_acompanhantes);

			// Criar a checkbox

			checkbox = "<input type='checkbox' checked='checked' name='confirmado' value='"+dados[dado].id+"'/>";
		}
		else
		{
			checkbox = "<input type='checkbox' name='confirmado' value='"+dados[dado].id+"'/>";
		}

		// Tratamento do número da carteirinha

		if(!dados[dado].carteira)
		{
			carteirinha = "-";
		}
		else
		{
			// Incrementar a quantidade de inscritos com carteirinha

			App.inscritos_carteirinha++;

			// Confirmar se esse cadastro por carteirinha foi confirmado

			if(dados[dado].confirmado == 1)
			{
				App.confirmados_carteirinha++;
			}

			// Exibir o número da carteirinha

			carteirinha = dados[dado].carteira;
		}

		// Contabilizar o número de participantes

		App.total_participantes += parseFloat(dados[dado].num_acompanhantes);

		$(".table").append("<tr><td>"+dados[dado].nome+"</td><td>"+dados[dado].email+"</td><td>"+dados[dado].telefone+"</td><td>"+dados[dado].modelo+"</td><td class='centralizar'>"+dados[dado].num_acompanhantes+"</td><td class='centralizar'>"+carteirinha+"</td><td class='centralizar'>"+checkbox+"</td></tr>");
	}

	// Mostrar os valores nos boxes de resultados

	// Totais

	$(".inscricoes .panel-body .num_total").html(App.inscritos);
	$(".carteirinhas .panel-body .num_total").html(App.inscritos_carteirinha);
	$(".participantes .panel-body .num_total").html(App.total_participantes);

	// Confirmados

	$(".inscricoes .num_confirmados").html(App.confirmados);
	$(".carteirinhas .num_confirmados").html(App.confirmados_carteirinha);
	$(".participantes .num_confirmados").html(App.confirmados_participantes);

	$(".table, .resultados").addClass("fadeInUp animated");
}

$(function(){

	////////////////////////////////////////////////////// Veririficar o Cookie

	if($.cookie('usuario'))
	{
		$("#loginform").hide();

		$.post("list.php", { username : $.cookie('usuario'), password : $.cookie('senha') }, function(data){

			if(data)
			{
				// Esconder o formulário de login e preencher a tabela

				dados = JSON.parse(data);

				$(".login").hide();

				preencheTabela(dados);

			}
			else
			{
				$("div.alert").addClass('alert-danger').html('Dados incorretos, tente novamente');
			}

		});
	}
	else
	{
		$("#loginform").addClass('fadeInLeft animated');
	}

	////////////////////////////////////////////////////// Submit do Formulário de Login

	$("form#loginform").submit(function(event){

		event.preventDefault();

		var username = $("#login-username").val();
		var password = $("#login-password").val();

		$.post("list.php", { username : username, password : password }, function(data){

			if(data)
			{
				// Gravar o cookie de autorização

				$.cookie('usuario', username);
				$.cookie('senha', password);

				// Esconder o formulário de login e preencher a tabela

				dados = JSON.parse(data);

				$("#loginform").removeClass('fadeInLeft animated').addClass('fadeOutLeft animated');

				setTimeout(function(){

					$("#loginform").hide();
					$(".login").hide();

					preencheTabela(dados);

				}, 1000);
			}
			else
			{
				$("div.alert").addClass('alert-danger').html('Dados incorretos, tente novamente');
			}

		});

		return false;

	});

	////////////////////////////////////////////////////// Click do Checkbox de confirmar presença

	$(".table").on('click', 'input[type=checkbox]', function(){

		var elemento = $(this);

		$.post("confirmar.php", { id : $(this).val(), confirmado : $(this).prop('checked') }, function(data){

			// Obter o número da carteirinha do usuário confirmado

			var numero_carteirinha = $(elemento).parent('td').prev('td').html();

			// Obter o número de pessoas

			var numero_pessoas = parseFloat($(elemento).parent('td').prev('td').prev('td').html());

			// Caso o checkbox tenha sido clicado para confirmar mais um usuário, aumentar em 1 o número nos boxes,
			// caso contrário diminuir.
			
			if(data == "true")
			{
				App.confirmados++;
				App.confirmados_participantes += numero_pessoas;

				// Caso o usuário tenha carteirinha, alterar o número lá também

				if(numero_carteirinha != "-")
				{
					App.confirmados_carteirinha++;
				}
			}
			else
			{
				App.confirmados--;
				App.confirmados_participantes -= numero_pessoas;

				// Caso o usuário tenha carteirinha, alterar o número lá também

				if(numero_carteirinha != "-")
				{
					App.confirmados_carteirinha--;
				}
			}

			// Atualizar os dados nos boxes

			$(".inscricoes .num_confirmados").html(App.confirmados);
			$(".carteirinhas .num_confirmados").html(App.confirmados_carteirinha);
			$(".participantes .num_confirmados").html(App.confirmados_participantes);

			

		});

	});

	////////////////////////////////////////////////////// Logout

	$(".logout").click(function(){

		$.removeCookie('usuario');
		$.removeCookie('senha');

		location.reload();

	});

});
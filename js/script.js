// Variáveis Globais

App = {};

	App.nome = "";
	App.email = "";
	App.telefone = "";
	App.modelo = "";
	App.existe = false;

// Eventos principais

$(document).ready(function(){

	// Slider

	$('.bxslider').bxSlider();

	// Mostrar o nome do usuário correspondente ao número da carteirinha digitado

	$("input.carteirinha").blur(function(){

		console.log("chamou a função");

		var numero_carteirinha = $(this).val();

		$.post('includes/busca.php', { carteirinha : numero_carteirinha }, function(data){

			if(data != 'inexistente')
			{
				var dados = JSON.parse(data);

				// Preencher os dados do formulário

				// $("input[name=nome]").val(dados.nome);

				//Preencher as variáveis com os dados do usuário

				App.nome = dados.nome;
				App.email = dados.email;
				App.telefone = dados.telefone;
				App.modelo = dados.modelo;
				App.carteira = dados.carteira;
				App.existe = true;
			}

		});

	});

	// Realizar o cadastro via Ajax usando apenas o número da carteirinha e a quantidade de acompanhantes

	$("form.cadastro_carteirinha").submit(function(event){

		// Evitar que o formulário seja enviado de forma tradicional

		event.preventDefault();

		// Obter o número de acompanhnates

		var acompanhantes = $("input[name='acompanhantes_carteirinha']").val();

		/////////////////////////////////// Validação Básica

		if(acompanhantes == "" || (!$.isNumeric(acompanhantes)))
		{
			$("div.alert").removeClass('alert-success').addClass('alert-danger').html("Preencha o campo 'Acompanhantes' corretamente.");
			return false;
		}

		/////////////////////////////////// Fim da Validação Básica

		// Testar se o número da carteirinha existe no banco de dados

		if(App.existe)
		{

			// Enviar os dados via AJAX para o cadastro

			$.post('includes/cadastro.php', { nome : App.nome, email : App.email, acompanhantes : acompanhantes, telefone : App.telefone, modelo : App.modelo, carteira : App.carteira }, function(data){

				if(data == '')
				{
					$("div.alert").removeClass('alert-danger').addClass('alert-success').html(App.nome + ", seu cadastro foi realizado com sucesso!");

					$("input[name='carteirinha']").val('');
					$("input[name='acompanhantes_carteirinha']").val('');
				}
				else
				{
					$("div.alert").removeClass('alert-success').addClass('alert-danger').html(data);
				}

			});
		}
		else
		{
			$("div.alert").removeClass('alert-success').addClass('alert-danger').html("Preencha o campo 'Nº da Carteirinha' corretamente.");
		}

		return false;

	});

	// Enviar o formulário via Ajax

	$("form.form-cadastro").submit(function(event){

		event.preventDefault();

		var nome = $("input[name='nome']").val();
		var email = $("input[name='email']").val();
		var acompanhantes = $("input[name='acompanhantes']").val();
		var telefone = $("input[name='telefone']").val();
		var modelo = $("input[name='modelo']").val();
		var local_partida = $("select[name='local_partida']").val();

		$.post('includes/cadastro.php', { nome : nome, email : email, acompanhantes : acompanhantes, telefone : telefone, modelo : modelo, local_partida : local_partida }, function(data){

			console.log(data);

			if(data == '')
			{
				$("div.alert").removeClass('alert-danger').addClass('alert-success').html("Cadastro realizado com sucesso!");

				$("input[name='nome']").val('');
				$("input[name='email']").val('');
				$("input[name='acompanhantes']").val('');
				$("input[name='telefone']").val('');
				$("input[name='modelo']").val('');
				$("select[name='local_partida']").val('');
			}
			else
			{
				$("div.alert").removeClass('alert-success').addClass('alert-danger').html(data);
			}

		});

		return false;

	});

	// Máscara do campo

	$("input[name='telefone']").mask('(99) 9999-9999?9');
});
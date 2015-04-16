<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Vantagens Toyota</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link href="../css/jquery.bxslider.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="css/admin.css">
</head>

<body>

	<div class="header">
		<div class="content">
			<img src="../image/logo-headerr.jpg" alt="">
			<p>CONCESSIONÁRIAS TOYOTA DO RIO E GRANDE RIO</p>
			<a href="https://www.facebook.com/redetoyotarj?fref=ts" target="_blank" style="display:block;"><div class="fb"></div></a>
		</div>
	</div>

	<div class="container">

		<div class="login">
				
			<form id="loginform" class="form-horizontal" role="form">

				<div class="alert"></div>
                                    
		        <div style="margin-bottom: 25px" class="input-group">
		            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		            <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email">                                  
		        </div>
	            
		        <div style="margin-bottom: 25px" class="input-group">
		            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		            <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
		        </div>

		        <div style="margin-top:10px" class="form-group">
		            <div class="col-sm-12 controls">
		              <input type="submit" id="btn-login" href="#" class="btn" value="Enviar" />
		            </div>
		        </div>

	        </form>

		</div>

		<!-- Resultados -->

		<div class="row resultados">

			<div class="row link">
				<a href="javascript:void(0)" class="logout">Sair</a>
			</div>

			<div class="col-md-4">
				<div class="panel panel-default inscricoes">
					<div class="panel-heading">
						<h3 class="panel-title">Inscrições Gerais</h3>
					</div>
					<div class="panel-body">
						<div class="row padding-0">
							<div class="col-md-6">Total</div>
							<div class="col-md-6">Confirmados</div>
						</div>
						<div class="row padding-0">
							<div class="col-md-6 num_total"></div>
							<div class="col-md-6 num_confirmados"></div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-default carteirinhas">
					<div class="panel-heading">
						<h3 class="panel-title">Inscritos com Carteirinha</h3>
					</div>
					<div class="panel-body">
						<div class="row padding-0">
							<div class="col-md-6">Total</div>
							<div class="col-md-6">Confirmados</div>
						</div>
						<div class="row padding-0">
							<div class="col-md-6 num_total"></div>
							<div class="col-md-6 num_confirmados"></div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-default participantes">
					<div class="panel-heading">
						<h3 class="panel-title">Total de Participantes</h3>
					</div>
					<div class="panel-body">
						<div class="row padding-0">
							<div class="col-md-6">Total</div>
							<div class="col-md-6">Confirmados</div>
						</div>
						<div class="row padding-0">
							<div class="col-md-6 num_total"></div>
							<div class="col-md-6 num_confirmados"></div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<table class="table table-striped lista">
			<tr>
				<th>Nome:</th>
				<th>E-mail:</th>
				<th>Telefone:</th>
				<th>Modelo:</th>
				<th class="centralizar">Nº de Pessoas no Carro:</th>
				<th class="centralizar">Nº da Carteirinha</th>
				<th class="centralizar">Confirmado?</th>
			</tr>
		</table>

	</div>

	<div class="container">
		<div class="row">
				
		</div>
	</div>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="js/jquery.cookie.js" type="text/javascript"></script>
	<script src="js/script.js" type="text/javascript"></script>

</body>
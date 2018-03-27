<!DOCTYPE html>
<html>
<head>
	<title>Form Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<form action="/Login/cad" method="POST">
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Nome</label>
			    <input type="text" class="form-control" name="nome" required="required" id="exampleFormControlInput1" placeholder="Nome">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlInput2">Usuario</label>
			    <input type="email" class="form-control" name="usuario"  required="required" id="exampleFormControlInput2" placeholder="Usuario">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlInput3">Senha</label>
			    <input type="password" class="form-control" name="senha"  required="required" id="exampleFormControlInput3" placeholder="Senha">
			  </div>
			   <button class="btn btn-lg btn-primary btn-block" type="submit">Cadastrar</button>     
			 </form>
		</div>
	</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>


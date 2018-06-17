<form id='formLogin' action="./paginas/importacao.php" method="post">
	<div class="container">
		<div class="col-3" style="position: absolute; top: 50%; left: 50%; margin-top: -188px; margin-left: -160px;">
			<div class="card text-center" >
			 	<div class="card-header" style="background-color: #17a2b8; color: white;">
			    	Login
			  	</div>
			  	<div class="card-body">
			  		<div class="col-12">
				    	<label for="Email" style="font-style: oblique; float: left; margin-bottom: 1px;">Email:</label>
				    	<input type="email" id="T1001_Email" name="email" required style="width: 100%;">
				    </div>
				    <div class="col-12" style="margin-top: 5px;">
				    	<label for="Senha" style="font-style: oblique; float: left; margin-bottom: 1px;">Senha:</label>
				    	<input type="password" id="T1001_Senha" name="senha" required style="width: 100%;">
				    </div>
				    <input type="submit" id="login" class="btn btn-primary" style="margin-top: 15px;" value="Entrar">
			  	</div>
			  	<div class="card-footer text-muted" style="background-color: #17a2b8">   	
			  	</div>
			</div>
		</div>
	</div>
</form>
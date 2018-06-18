<?php 
	include_once '../config.php';
	include_once '../redirect.php'; 
?>

<div class="card text-center" style="height: 100%;">
 	<div class="card-header" style="background-color: #007bff; color: white;">
    	<b>Upload do Arquivo</b>
  	</div>
  	<div class="card-body">
  		<div class="container">
  			<div class="row">
  				<div class="col-2">
  					<input type="button" id="selecionarArquivo" class="btn btn-secondary" value="Selecione o Arquivo">
  				</div>
  				<div class="col-8"></div>
  				<div class="col-2">
  					<input type="button" id="logout" class="btn btn-primary" value="Logout">
  				</div>
  			</div>

  			<!-- TABELA -->
  			<div class="row" style="margin-top: 20px;">
  				<table class="table table-bordered" style="font-family: monospace;">
  					<thead>
  						<th style="text-align: center;" width="110px">AÇÃO</th>
  						<th style="text-align: center;" width="120px">EAN</th>
  						<th width="570px">NOME PRODUTO</th>
  						<th style="text-align: center;" width="100px">PREÇO</th>
  						<th style="text-align: center;" width="100px">ESTOQUE</th>
  						<th>DATA FABRICAÇÃO</th>
  					</thead>
  					<tbody id="itens">
  						
  					</tbody>
  				</table>
  			</div>
  		</div>
  	</div>
  	<div class="card-footer text-muted" style="background-color: #007bff">   	
  	</div>
</div>
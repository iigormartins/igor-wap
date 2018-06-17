$(document).ready(() => {
	//##############################################################################
	//BUSCO A TELA DE LOGIN
	buscaTela("login");
	$('#telaAtual').val('login');

	// AO CLICAR EM LOGIN
	$(document).on('click', '#formLogin #login', ()=>{
		if($('#formLogin #T1001_Email').val() == ""){
			return false;
		}

		if($('#formLogin #T1001_Senha').val() == ""){
			return false;
		}

		// VERIFICA SE LOGIN É VALIDO
		$.ajax({
			async : false,
			method: "POST",
			dataType : "json",
			url: "conexao/checkLogin.php",
			data : {
				email : $('#formLogin #T1001_Email').val(),
				senha : $('#formLogin #T1001_Senha').val()
			}
		}).done((jsonDados) => {
			if(jsonDados == true){
				buscaTela('importacao');
				$('#telaAtual').val('importacao');
				$('#alerta').css('display', 'none');
			}else{
				$('#alerta').css('display', 'block');
			}
		}).fail((jqXHR, msg) => {
			console.log("Erro: "+msg);
		});
	});

	// AO CLICAR EM LOGOUT
	$(document).on('click', '#logout', () => {
		// CHAMA O PROGRAMA PARA REALIZAR O LOGOUT
		$.ajax({
			async : false,
			method: "POST",
			dataType : "json",
			url: "conexao/logout.php",
		}).done((jsonDados) => {
			buscaTela('login');
			$('#telaAtual').val('login');
		}).fail((jqXHR, msg) => {
			console.log("Erro: "+msg);
		});
	});
});

// FUNÇÃO RESPONSAVEL POR BUSCA O PROGRAMA DA TELA
function buscaTela(nomeTela){
	$.ajax({
		async : false,
		method: "POST",
		dataType : "HTML",
		url: "paginas/" + nomeTela + ".php"
	}).done((jsonDados) => {
		$('#tela').empty();
		$('#tela').append(jsonDados);
	}).fail((jqXHR, msg) => {
		console.log("Erro: "+msg);
	});
}
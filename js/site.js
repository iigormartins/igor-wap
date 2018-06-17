$(document).ready(() => {
	//##############################################################################
	//BUSCO A TELA DE LOGIN
	buscaTela("login");
	$('#telaAtual').val('login');
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
$(document).ready(() => {
	//##############################################################################
	//BUSCO A TELA DE LOGIN
	buscaTela("login");
	$('#telaAtual').val('login');

	// AO CLICAR EM LOGIN
	$(document).on('click', '#formLogin #login', () => {
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

				// QUANDO ENTRAR NA TELA DE IMPORTAÇÃO IRA CONSULTAR E PREENCHER
				// A TELA COM OS REGISTROS ENCONTRADO NO BANCO 
				buscaDados();
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

	// AO CLICAR EM SELECIONAR ARQUIVO
	var form;
    $(document).on('change', '#arquivo',(event) => {
        form = new FormData();
        form.append('arquivo', event.target.files[0]);
    });

    $(document).on('click', '#enviarArquivo', () => {
    	if(form != null && form != "" && form != undefined){
	        $.ajax({
	            url: 'conexao/importaPlanilha.php',
	            data: form,
	            processData: false,
	            contentType: false,
	            type: 'POST',
	            success: function (data) {
	            	$('<p>'+data+'</p>').dialog({
						height : 200,
						buttons: [
					    {
					      text: "OK",
					      click: function() {
					        $( this ).dialog( "close" );
					      }
					    }
					  ]
					});
	                buscaDados();
	            }
	        });
	    }else{
	    	$('<p>Favor selecionar o arquivo que deseja importar!</p>').dialog({
				height : 200,
				buttons: [
			    {
			      text: "OK",
			      click: function() {
			        $( this ).dialog( "close" );
			      }
			    }
			  ]
			});
	    }
    });

	$(document).on('click', '.btn-danger',(event) => {
		var name = event.target.attributes[3].value;
		var linha = "dado"+name.substring(5,6);
		var ean = $('#'+linha).text();
		
		// IRE REMOVER O ELEMENTO DO BANCO DE DADOS
		$.ajax({
			async : false,
			method: "POST",
			dataType : "json",
			url: "conexao/removeDado.php",
			data :{
				Ean : ean
			}
		}).done((jsonDados) => {
			if(jsonDados == true){
				buscaDados();
			}
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

function buscaDados(){
	$.ajax({
		async : false,
		method: "POST",
		dataType : "json",
		url: "conexao/buscaDadosImportados.php"
	}).done((jsonDados) => {
		if(jsonDados != null){
			$('#itens').empty();
			for(var i=0;i<jsonDados.length; i++){
				var dado = jsonDados[i].split('|');
				var string = "";
				string += "<tr><th style='font-size: 7px'><button type='button' class='btn btn-danger' style='padding: 0px 10px;' id='linha"+i+"' name='linha"+i+"'>Remover</button></th>";
				string +="<th style='text-align: center;' id='dado"+i+"'>"+dado[0]+"</th>";
				string +="<th>"+dado[1]+"</th>";
				string +="<th style='text-align: center;'>R$ "+dado[2]+"</th>";
				string +="<th style='text-align: center;'>"+dado[3]+"</th>";
				string +="<th style='text-align: center;'>"+dado[4]+"</th></tr>";

				$('#itens').append(string);
			}
		}else{
			$('#itens').empty();
		}
	}).fail((jqXHR, msg) => {
		console.log("Erro: "+msg);
	});
}
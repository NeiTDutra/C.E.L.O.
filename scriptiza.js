	function up_impress(){
		
		var dec = confirm ('Deseja imprimir este orçamento?');
		
		if (dec == true){
		
		window.open('pdfdom.php', '_blank');
		
		}else{
		
			return false;
		
		}
	
	}

	function k(i) {

		var v = i.value.replace(/\D/g,'');
		v = (v/100).toFixed(2) + '';
		v = v.replace(".", ",");
		v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
		v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
		i.value = v;

	}

	function mascara(t, mask){

		var i = t.value.length;
		var saida = mask.substring(1,0);
		var texto = mask.substring(i)

		if (texto.substring(0,1) != saida){

			t.value += texto.substring(0,1);
			
		}

	}
	
    function CriaPDF() {
    
        var minhaTabela0 = document.getElementById('tabela0').innerHTML;
        var minhaTabela1 = document.getElementById('tabela1').innerHTML;

        var style = "<style>";
        style = style + "table {width: 100%;font: 20px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        // CRIA UM OBJETO WINDOW
        var win = window.open('', '', 'height=700,width=700');

        win.document.write('<html><head>');
        win.document.write('<title>Orçamento</title>');   // <title> CABEÇALHO DO PDF.
        win.document.write(style);                                     // INCLUI UM ESTILO NA TAB HEAD
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(minhaTabela0);
        win.document.write(minhaTabela1);                          // O CONTEUDO DA TABELA DENTRO DA TAG BODY
        win.document.write('</body></html>');

        win.document.close(); 	                                         // FECHA A JANELA

        win.print();                                                            // IMPRIME O CONTEUDO
    }


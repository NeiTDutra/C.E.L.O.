

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


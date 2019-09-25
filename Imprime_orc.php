
<?php

ini_set('display_errors', true); error_reporting(E_ALL);

	require_once 'classes.php';
	
		function info_orc(){
		
			session_start();
	
			$n_orc = isset($_SESSION['n_orc']) ? $_SESSION['n_orc'] : '00000002';
			$n_usu = isset($_SESSION['$nome']) ? $_SESSION['$nome'] : 'ababab ababab';
			$ni_usu = isset($_SESSION['$nivel']) ? $_SESSION['$nivel'] : 'cdcdcd cdcdcd';
			$n_cli = isset($_SESSION['n_cli']) ? $_SESSION['n_cli'] : 'fgfgfg fgfgfg';
			$f_cli = isset($_SESSION['f_cli']) ? $_SESSION['f_cli'] : '00 00000 0000';
			$data = date('d/m/y');
	
			$v_t_o = 0;
			
			
			echo '<!DOCTYPE html>
			<html charset="utf-8">
			<head><title>Orçamento</title>
			<link rel="stylesheet" type="text/css" href="estiliza.css">
			</head>
			<body>
			<div class="tab_ctn_impr">
			<div class="tab_impr">
			<h3>Orçamento</h3>
			<table id="tabela0" class="tabela_impr">
			<tr><td>Orçamento nº: '.$n_orc.'</td><td>Data: '.$data.'</td></tr>
			<tr><td>Usuário: '.$n_usu.'</td><td>Nível: '.$ni_usu.'</td></tr>
			<tr><td>Nome do cliente: '.$n_cli.'</td><td> Fone:  '.$f_cli.'</td></tr>
			</table><br><br><br>
			<table class="tabela_impr" id="tabela1">
			<tr>
			<th>Cod.</th>
			<th>Descrição</th>
			<th>Tam.</th>
			<th>Cor</th>
			<th>Quant.</th>
			<th>Valor u.</th>
			<th>Valor t.</th></tr>';
	
			$sql = 'SELECT * FROM tborcamento_i WHERE cod_orc = "'.$n_orc.'"';
			
			$p_sql = Conexao::getInstance()->prepare($sql);
			$p_sql->execute();
			$f_sql = $p_sql->fetchAll(PDO::FETCH_ASSOC);
			$desc = '';
			
		
			foreach($f_sql as $l){
			
				$id_prod = $l['id_prod'];
				$desc_prod = $l['desc_prod'];
				$tam_prod = $l['tam_prod'];
				$cor_prod = $l['cor_prod'];
				$quant_prod = $l['quant_prod'];
				$valor_prod = $l['valor_prod'];
				$v_t = $valor_prod * $quant_prod;
				$v_t_o = $v_t_o + $v_t;
				
				echo '<tr><td>'.$id_prod.'</td><td>'.$desc_prod.'</td><td>'.$tam_prod.'</td><td>'.$cor_prod.'</td><td>'.$quant_prod.'</td>	<td>'.$valor_prod.'</td><td>'.$v_t.'</td></tr>';
				
				$desc.= '<tr><td>'.$l['id_prod'].'</td><td>'.$l['desc_prod'].'</td><td>'.$l['tam_prod'].'</td><td>'.$l['cor_prod'].'</td><td>'.$l['quant_prod'].'</td><td>'.$l['valor_prod'].'</td><td>'.$l['quant_prod'] * $l['valor_prod'].'</td></tr>';
				
				
			}
			echo '<tr><td></td><td></td><td></td><td></td><td></td><td>Total:</td><td style="border-top:1px solid red;">'.$v_t_o.'</td></tr>';
			echo '</table></div></div></body></html>';
			
			$ass = 'Novo Orçamento';
			
			$mess = 'Recebemos uma mensagem no sistema pjCELO <br/><hr/>
				<strong>Novo orçamento foi lançado:</strong><br/>
				<strong>Orçamento numero:</strong>'.$_SESSION['n_orc'].'<br/>
				<strong>Nome do usuário:</strong>'.$_SESSION['$nome'].'<br/><hr/>
				<strong>Nome do cliente:</strong>'.$_SESSION['n_cli'].'<br/>
				<strong>Fone do cliente:</strong>'.$_SESSION['f_cli'].'<br/><hr/>
				<strong>Descriminação:</strong><br/>
				<table style="border: 1px solid red; width: 60% !important; text-align: center;">
				<tr><th>Cod.</th><th>Desc.</th><th>Tam.</th><th>Cor</th><th>Quant.</th><th>V. Uni.</th><th>V. tot.</th></tr>'
				.$desc.
				'</table><br/>
				<strong>Valor total: R$</strong>'.$v_t_o.'<br/>';
			
			require_once 'classes.php';
			
			$mail = new Mail;
			$mail->envia($ass, $mess);
			
			}
			
			$pgn = info_orc();
			echo $pgn;

?>

<?php

	ini_set('display_errors', true); error_reporting(E_ALL);
	
	class Gate{
	
		private $nome;
		private $senha;
		
		public function setNome($nome){
		
			return $this->nome = $nome;
		
		}
		
		public function getNome(){
		
			return $this->nome;
		
		}
		
		public function setSenha($senha){
		
			return $this->senha = $senha;
		
		}
		
		public function getSenha(){
		
			return $this->senha;
		
		}
		
		public function testa_login($n, $s){
		
			if ($n == null && $s == null){
			
				echo '<script>alert("Digite usuário e senha!!")</script>';
				return false;
			
			}
			
			if ($n == null || $s == null){
			
				echo '<script>alert("Falta usuário ou senha!!")</script>';
				return false;
			
			}else{
			
				try{

					require_once 'Usuario.classe.php';
					
					$du1 = new DAOusuario;	
					$du1->logado($n, $s);

				} catch (Exception $e){

					echo $e->getMessage();

				} 
			
			}
		
		} 
	
	}

    class Menu{

		function escolhe_menu(){
    
        	function limpa_sessao_orc(){

        	    unset ($_SESSION['n_orc']);
                $_SESSION['n_orc'] = null;
                unset ($_SESSION['n_cli']);
                $_SESSION['n_cli'] = null;
                unset ($_SESSION['f_cli']);
                $_SESSION['f_cli'] = null;
                unset ($_SESSION['id_prod']);
                $_SESSION['id_prod'] = null;
                unset ($_SESSION['d_prod']);
                $_SESSION['d_prod'] = null;
                unset ($_SESSION['t_prod']);
                $_SESSION['t_prod'] = null;
                unset ($_SESSION['c_prod']);
                $_SESSION['c_prod'] = null;
                unset ($_SESSION['q_prod']);
                $_SESSION['q_prod'] = null;
                unset ($_SESSION['v_prod']);
                $_SESSION['v_prod'] = null;
                unset ($_SESSION['cod_cli']);
                $_SESSION['cod_cli'] = null;

                unset ($_POST['id_orc']);

            }
	
			function escolhe_menu_acao($m){

			    $params = func_get_args();

			foreach ($params as $m) {

	   		    if (isset($_POST[$m])) {

				return $m;

				}
			}

		    }

			switch(escolhe_menu_acao('listar_usu', 'lancar_usu', 'alterar_usu', 'sobe_altera_usu', 'exclui_usu', 'menu_orcamento', 'menu_estoque', 'menu_usuario', 'menu_cliente', 'volta_menu', 'listar_orc', 'lancar_orc', 'alterar_orc', 'exclui_orc', 'exclui_iten_orc', 'listar_cli', 'lancar_cli', 'alterar_cli', 'exclui_cli', 'listar_est', 'lancar_est', 'alterar_est', 'exclui_prod', 'situa_prod', 'cancela', 'sobe_altera_cli', 'sobe_altera_prod', 'novo_orc', 'p_cli', 'p_prod', 'adc_prod', 'sobe_ver_orc', 'sobe_altera_orc', 'imprime', 'atualiza_info')){

				case 'sobe_ver_orc':
                                    
                    $_SESSION['cod_cli'] = isset($_POST['id_cli_orc']) ? $_POST['id_cli_orc'] : null;
                    $_SESSION['n_cli'] = isset($_POST['nome_cli_orc']) ? $_POST['nome_cli_orc'] : null;
                    $_SESSION['f_cli'] = isset($_POST['fone_cli_orc']) ? $_POST['fone_cli_orc'] : null;

                    require_once 'Orcamento.classe.php';
					
                    $info_orc = new DAOorcamento;
                    $info_orc->rtn_info_orc();
					
					return;
					
					break;

				case 'atualiza_info':

					require_once 'Orcamento.classe.php';
					$info_orc = new DAOorcamento;
					$info_orc->infoOrc();
					
					require_once 'Cliente.classe.php';
					$info_cli = new DAOcliente;
					$info_cli->infoCli();
					
					require_once 'Usuario.classe.php';
					$info_usu = new DAOusuario;
					$info_usu->infoUsu();
					
					require_once 'Estoque.classe.php';
					$info_est = new DAOestoque;
					$info_est->infoEst();
					
					require_once 'menu_inicial.php';
					
					return;
					
					break;

				case 'imprime':

					require_once('mail.php');
					limpa_sessao_orc();
					
					return;
					
					break;

				case 'menu_orcamento':

					require_once('menu_orcamento.php');
					
					require_once('Orcamento.classe.php');
					$l_orc = new DAOorcamento;
					$l_orc->lista_orc();
					
					break;

				case 'menu_estoque':

					require_once('menu_estoque.php');
					
					require_once('Estoque.classe.php');
					$l_est = new DAOestoque;
					$l_est->lista_prod('nada');
					
					break;

				case 'situa_prod':

					require_once('menu_estoque.php');
					
					require_once('Estoque.classe.php');
					$l_est = new DAOestoque;
					$l_est->lista_prod('crit');
					
					break;

				case 'menu_usuario':

					require_once('menu_usuario.php');
					
					require_once('Usuario.classe.php');
					$l_usu = new DAOusuario;
					$l_usu->lista_usu();
					
					break;

				case 'menu_cliente':

					require_once('menu_cliente.php');
					
					require_once('Cliente.classe.php');
					$l_cli = new DAOcliente;
					$l_cli->lista_cli('nada');
					
					break;

				case 'volta_menu':
				
					limpa_sessao_orc();
                    
					require_once('menu_inicial.php');
					
					break;

				case 'cancela':

					require_once('menu_inicial.php');
					
					break;

				case 'listar_orc':
                                
                    limpa_sessao_orc();
	
					require_once('menu_orcamento.php');
					require_once('Orcamento.classe.php');
					
					$lis_orc = new DAOorcamento;
					$lis_orc->lista_orc();
					
					break;
                                
                case 'novo_orc':
                    
                    require_once 'Orcamento.classe.php';
                    
                    $n_orc = new DAOorcamento;
                    $n_orc = $n_orc->lista_n_orc();
                    $_SESSION['n_orc'] = $n_orc;   
                     
                    require_once ('menu_orcamento.php');
                    
                    break;
                                
                case 'p_cli':
                
                	$s_orc = $_SESSION['n_orc'] ?? null;
                
                	if($s_orc == null){
                	
                		require_once 'menu_cliente.php';
                	
                	}else{ 
                
                    	require_once ('menu_orcamento.php');
                    
                    }
                    $nome_cli = $_POST['nome_cli'];
                    
                    require_once 'Cliente.classe.php';
                    
                    $p_cli = new DAOcliente;
                    $p_cli->lista_cli($nome_cli);
                       
                    break;
                                
                case 'p_prod':
                
                    $nome_cli = $_POST['nome_cli'] ?? null;
                    $_SESSION['n_cli'] = $nome_cli;
                    
                    if($nome_cli == null){
                    
                    	require_once 'menu_estoque.php';
                    
                    }else{
                                        
                    	require_once ('menu_orcamento.php');
                    
                    }
                    $desc_prod = $_POST['desc_prod'];
                    
                    require_once 'Estoque.classe.php';
                    
                    $p_prod = new DAOestoque;
                    $p_prod->lista_prod($desc_prod); 
                      
                    break;
                                
                case 'adc_prod':
                
                	unset ($_SESSION['id_prod']);
                	unset ($_SESSION['d_prod']);
                	unset ($_SESSION['t_prod']);
                	unset ($_SESSION['c_prod']);
                	unset ($_SESSION['q_prod']);
                	unset ($_SESSION['v_prod']);
                	
                    require_once ('menu_orcamento.php');
                    require_once 'Orcamento.classe.php';
                    
                    $adc_prod = new DAOorcamento;
                    $adc_prod->lanca_orc_prod();
                       
                    break;
                                    
				case 'lancar_orc':
                    
					require_once('Orcamento.classe.php');
					
					$lan_orc = new DAOorcamento;
					$lan_orc->lanca_orc();
					
                	limpa_sessao_orc();
					require_once('menu_orcamento.php');
					
					require_once('Orcamento.classe.php');
					$l_orc = new DAOorcamento;
					$l_orc->lista_orc();
					
					break;
					
				case 'sobe_altera_orc':
                                    
                    $_SESSION['id_prod'] = isset($_POST['id_prod']) ? $_POST['id_prod'] : null;
                    $_SESSION['d_prod'] = isset($_POST['d_prod']) ? $_POST['d_prod'] : null;
                    $_SESSION['t_prod'] = isset($_POST['t_prod']) ? $_POST['t_prod'] : null;
                    $_SESSION['c_prod'] = isset($_POST['c_prod']) ? $_POST['c_prod'] : null;
                    $_SESSION['q_prod'] = isset($_POST['q_prod']) ? $_POST['q_prod'] : null;
                    $_SESSION['v_prod'] = isset($_POST['v_prod']) ? $_POST['v_prod'] : null;

                    require_once 'Orcamento.classe.php';
					
                    $info_orc = new DAOorcamento;
                    $info_orc->rtn_info_orc();
					
					return;
					
					break;

				case 'alterar_orc':
					
					unset($_SESSION['id_prod']);
					unset($_SESSION['d_prod']);
					unset($_SESSION['t_prod']);
					unset($_SESSION['c_prod']);
					unset($_SESSION['q_prod']);
					unset($_SESSION['v_prod']);

					require_once('menu_orcamento.php');
					require_once('Orcamento.classe.php');
					
					$alt_orc = new DAOorcamento;
					$alt_orc->altera_orc();
					
					break;
					
				case 'exclui_orc':
				
					require_once 'Orcamento.classe.php';
					
					$exc_orc = new DAOorcamento;
					$exc_orc->exclui_orc();
					
					require_once 'menu_orcamento.php';
					
					$lis_orc = new DAOorcamento;
					$lis_orc->lista_orc();
				
					break;
					
				case 'exclui_iten_orc':
				
					require_once 'Orcamento.classe.php';
					
					$exc_orc = new DAOorcamento;
					$exc_orc->exclui_orc();
					
					require_once 'menu_orcamento.php';
					
					$lis_orc = new DAOorcamento;
					$lis_orc->rtn_info_orc();
				
					break;

				case 'listar_cli':

					require_once('Cliente.classe.php');
					
					$lis_cli1 = new DAOcliente;
					$lis_cli1->lista_cli('nada');
					
					break;

				case 'lancar_cli':

					if ($_POST['nome_cli'] == '' || $_POST['fone_cli'] == '' || $_POST['email_cli'] == '' ){

						echo '<script> alert ("Todos os campos devem ser preenchidos"); </script>';
						require_once('menu_cliente.php');

					}else{
	
						require_once('Cliente.classe.php');
						
						$lan_cli1 = new DAOcliente;
						$lan_cli1->lanca_cli();

					}

					break;
					
				
                    case 'sobe_altera_cli':
				
                    if (isset($_SESSION['n_orc'])){
                                            
                        $_SESSION['cod_cli'] = $_POST['id_cli'];
				        $_SESSION['n_cli'] = $_POST['n_cli'];
				        $_SESSION['f_cli'] = $_POST['f_cli'];
				        
                        require_once ('menu_orcamento.php');
                                            
                    }else{
                    
						require_once('Cliente.classe.php');
						
						$lis_cli1 = new DAOcliente;
						$lis_cli1->lista_cli('nada');
                                            
                    }
				
					break;

				case 'alterar_cli':

					if ($_POST['nome_cli'] == '' || $_POST['fone_cli'] == '' || $_POST['email_cli'] == '' ){

						echo '<script> alert ("Selecione na lista a entrada a ser alterada.");</script>';
						require_once('Cliente.classe.php');
						
						$alt_cli = new DAOcliente;
						$alt_cli->lista_cli('nada');

					}else{

						require_once('Cliente.classe.php');
						
						$alt_cli = new DAOcliente;
						$alt_cli->altera_cli();
						
					}
					
					break;
                                        
                                case 'exclui_cli':
                                    
                                    require_once 'Cliente.classe.php';
                                    
                                    $ex_cli = new DAOcliente;
                                    $ex_cli->exclui_cli();
 
                                    break;

				case 'listar_usu':

					require_once('Usuario.classe.php');
					
					$lis_usu1 = new DAOusuario;
					$lis_usu1->lista_usu();
					
					break;

				case 'lancar_usu':

					if ($_POST['nome_usu'] == '' || $_POST['senha_usu'] == '' || $_POST['nivel_usu'] == '' ){

						echo '<script> alert ("Todos os campos devem ser preenchidos"); </script>';
						require_once('menu_usuario.php');

					}else{

						require_once('Usuario.classe.php');
						
						$lan_usu1 = new DAOusuario;
						$lan_usu1->lanca_usu();

					}

					break;

				case 'sobe_altera_usu':

					require_once('Usuario.classe.php');
					
					$alter_usu = new DAOusuario;
					$alter_usu->lista_usu();

					break;

				case 'alterar_usu':

					if ($_POST['nome_usu'] == '' || $_POST['senha_usu'] == '' || $_POST['nivel_usu'] == '' ){

						echo '<script> alert ("Selecione na lista a entrada a ser alterada.");</script>';
						require_once('Usuario.classe.php');
						
						$alter_usu = new DAOusuario;
						$alter_usu->lista_usu();

					}else{

						require_once('Usuario.classe.php');
						
						$alt_usu = new DAOusuario;
						$alt_usu->altera_usu();

					}

					break;

				case 'exclui_usu':

						require_once('Usuario.classe.php');
						
						$exc_usu = new DAOusuario;
						$exc_usu->exclui_usu();
					
					break;

				case 'listar_est':
	
						require_once('menu_estoque.php');
						require_once('Estoque.classe.php');
						
						$lis_est = new DAOestoque;
						$lis_est->lista_prod('nada');
					
					break;

				case 'lancar_est':

					if($_POST['desc_prod'] == '' || $_POST['tam_prod'] == '' || $_POST['cor_prod'] == '' || $_POST['quan_prod'] == '' || $_POST['val_prod'] == ''){

						require_once('menu_estoque.php');
						echo '<script> alert ("Todos os campos devem ser preenchidos"); </script>';

					}else{

						require_once('menu_estoque.php');
						require_once('Estoque.classe.php');
						
						$lan_est = new DAOestoque;
						$lan_est->lanca_prod('nada');

					}

					break;

				case 'sobe_altera_prod':
				
					if (isset($_SESSION['n_orc'])){
						
						$_SESSION['id_prod'] = $_POST['id_prod'];
						$_SESSION['d_prod'] = $_POST['d_prod'];
						$_SESSION['t_prod'] = $_POST['t_prod'];
						$_SESSION['c_prod'] = $_POST['c_prod'];
						$_SESSION['q_prod'] = $_POST['q_prod'];
						$_SESSION['v_prod'] = $_POST['v_prod'];
						
						require_once 'menu_orcamento.php';
                        require_once('menu_orcamento_novo.php');
					
					}else{
	
						require_once('menu_estoque.php');
						require_once('Estoque.classe.php');
						
						$lis_est = new DAOestoque;
						$lis_est->lista_prod('nada');
						
					}
					
					break;

				case 'alterar_est':

					if ($_POST['desc_prod'] == '' || $_POST['tam_prod'] == '' || $_POST['cor_prod'] == ''  || $_POST['quan_prod'] == ''  || $_POST['val_prod'] == '' ){

						require_once('menu_estoque.php');
						
						echo '<script> alert ("Selecione na lista a entrada a ser alterada.");</script>';
						
						require_once('Estoque.classe.php');
						
						$alter_est = new DAOestoque;
						$alter_est->lista_prod('nada');

					}else{

						require_once('menu_estoque.php');
						require_once('Estoque.classe.php');
						
						$alt_est = new DAOestoque;
						$alt_est->altera_prod();
					
					}
					break;
                                        
                                case 'exclui_prod';
                                    
                                    require_once 'menu_estoque.php';
                                    require_once 'Estoque.classe.php';
                                    
                                    $exc_prod = new DAOestoque;
                                    $exc_prod->exclui_prod();
                                    
                                    break;

				default:

					echo '<script>alert ("Nenhuma pagina encontrada!!!</script>';
					
					break;
			}
		}	
    }

	class Conexao {
	  
		public static $instance;

		public static function getInstance() {
	  
			if(isset($instance)){

				unset($instance);

			}
		  
		    $instance = new PDO('mysql:host=localhost; dbname=pjcelo', 'root', 'Senha007');
	  
		    return $instance;
		}
	  
	}

	class Mail {
	
		private $nome;
		private $email_to;
		private $email_from;
		private $mensagem;
		
		private function setNome($nome){
		
			$this->nome = $nome;
		
		}
		
		private function getNome(){
		
			return $this->nome;
		
		}
		
		private function setEmail_to($email_to){
		
			$this->email_to = $email_to;
		
		}
		
		private function getEmail_to(){
		
			return $this->email_to;
		
		}
		
		private function setEmail_from($email_from){
		
			$this->email_from = $email_from;
		
		}
		
		private function getEmail_from(){
		
			return $this->email_from;
		
		}
		
		private function setMensagem($mensagem){
		
			$this->mensagem = $mensagem;
		
		}
		
		private function getMensagem(){
		
			return $this->mensagem;
		
		}
		
		public function envia($assunto, $mensagem){
		
		try{
		
			require_once 'mail.php';
			
			echo '<script>alert"Email enviado"</script>';
			
		}catch(Exception $e){
		
			echo $e->getMessage();
		
		}
			
		
		}
	
	}

<?php

	ini_set('display_errors', true); error_reporting(E_ALL);
	
	class Gate{
		
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

					require_once $GLOBALS['dao']. 'usuariosDAO.php';
					
					$du1 = new DAOusuario;	
					$du1->logado($n, $s);

				} catch (Exception $e){

					echo $e->getMessage();

				} 
			
			}
		
		} 
	
	}
	
	/*
	//	Classe que trata dos menus
	*/

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

			switch(escolhe_menu_acao('listar_usu', 'lancar_usu', 'alterar_usu', 'sobe_altera_usu', 'exclui_usu', 'menu_orcamento', 'menu_estoque', 'menu_usuario', 'menu_cliente', 'volta_menu', 'listar_orc', 'lancar_orc', 'alterar_orc', 'exclui_orc', 'exclui_iten_orc', 'listar_cli', 'lancar_cli', 'alterar_cli', 'exclui_cli', 'listar_est', 'lancar_est', 'alterar_est', 'exclui_prod', 'situa_prod', 'sobe_altera_cli', 'sobe_altera_prod', 'novo_orc', 'p_cli', 'p_prod', 'adc_prod', 'sobe_ver_orc', 'sobe_altera_orc', 'atualiza_info')){
			
			
			/*
			//	Tratamento de menu de orçamentos
			*/

				case 'menu_orcamento':

					require_once $GLOBALS['views']. 'menu_orcamento.php';
					
					require_once $GLOBALS['dao']. 'orcamentosDAO.php';
					
					$l_orc = new DAOorcamento;
					$l_orc->lista_orc();
					
					break;
                                
                case 'novo_orc':
                    
                    $aut = new Autoriza;
                    if($aut->aut(1) == false){
                    
                    	require_once $GLOBALS['views']. 'menu_orcamento.php';
                    
                    }
                    else{
                    
		                require_once $GLOBALS['dao']. 'orcamentosDAO.php';
		                
		                $n_orc = new DAOorcamento;
		                $n_orc = $n_orc->lista_n_orc();
		                
		                $_SESSION['n_orc'] = $n_orc;   
		                 
		                require_once $GLOBALS['views']. 'menu_orcamento.php';
                    
                    }
                    
                    break;
                    
				case 'lancar_orc':
					
                	limpa_sessao_orc();
                    
					require_once $GLOBALS['views']. 'menu_orcamento.php';
					require_once $GLOBALS['dao']. 'orcamentosDAO.php';
					
					$lan_orc = new DAOorcamento;
					$lan_orc->lanca_orc();
					
					break;

				case 'listar_orc':
                                
                    limpa_sessao_orc();
	
					require_once $GLOBALS['views']. 'menu_orcamento.php';
					require_once $GLOBALS['dao']. 'orcamentosDAO.php';
					
					$lis_orc = new DAOorcamento;
					$lis_orc->lista_orc();
					
					break;

				case 'sobe_ver_orc':
                                    
                    $_SESSION['cod_cli'] = isset($_POST['id_cli_orc']) ? $_POST['id_cli_orc'] : null;
                    $_SESSION['n_cli'] = isset($_POST['nome_cli_orc']) ? $_POST['nome_cli_orc'] : null;
                    $_SESSION['f_cli'] = isset($_POST['fone_cli_orc']) ? $_POST['fone_cli_orc'] : null;

                    require_once $GLOBALS['dao']. 'orcamentosDAO.php';
					
                    $info_orc = new DAOorcamento;
                    $info_orc->rtn_info_orc();
					
					return;
					
					break;
					
				case 'sobe_altera_orc':
                                    
                    $_SESSION['id_prod'] = isset($_POST['id_prod']) ? $_POST['id_prod'] : null;
                    $_SESSION['d_prod'] = isset($_POST['d_prod']) ? $_POST['d_prod'] : null;
                    $_SESSION['t_prod'] = isset($_POST['t_prod']) ? $_POST['t_prod'] : null;
                    $_SESSION['c_prod'] = isset($_POST['c_prod']) ? $_POST['c_prod'] : null;
                    $_SESSION['q_prod'] = isset($_POST['q_prod']) ? $_POST['q_prod'] : null;
                    $_SESSION['v_prod'] = isset($_POST['v_prod']) ? $_POST['v_prod'] : null;

                    require_once $GLOBALS['dao']. 'orcamentosDAO.php';
					
                    $info_orc = new DAOorcamento;
                    $info_orc->rtn_info_orc();
					
					
					break;

				case 'alterar_orc':
					
					unset($_SESSION['id_prod']);
					unset($_SESSION['d_prod']);
					unset($_SESSION['t_prod']);
					unset($_SESSION['c_prod']);
					unset($_SESSION['q_prod']);
					unset($_SESSION['v_prod']);

					require_once $GLOBALS['views']. 'menu_orcamento.php';
					require_once $GLOBALS['dao']. 'orcamentosDAO.php';
					
					$alt_orc = new DAOorcamento;
					$alt_orc->altera_orc();
					
					
					break;
					
				case 'exclui_orc':
				
					require_once $GLOBALS['views']. 'menu_orcamento.php';
				
					require_once $GLOBALS['dao']. 'orcamentosDAO.php';
					
					$exc_orc = new DAOorcamento;
					$exc_orc->exclui_orc();
					
				
					break;
					
				case 'exclui_iten_orc':
				
					require_once $GLOBALS['views']. 'menu_orcamento.php';
					
					require_once $GLOBALS['dao']. 'orcamentosDAO.php';
					
					$exc_orc = new DAOorcamento;
					$exc_orc->exclui_orc();
					
				
					break;
                                
                case 'adc_prod':
                
                	unset ($_SESSION['id_prod']);
                	unset ($_SESSION['d_prod']);
                	unset ($_SESSION['t_prod']);
                	unset ($_SESSION['c_prod']);
                	unset ($_SESSION['q_prod']);
                	unset ($_SESSION['v_prod']);
                	
                    require_once $GLOBALS['views']. 'menu_orcamento.php';
                    require_once $GLOBALS['dao']. 'orcamentosDAO.php';
                    
                    $adc_prod = new DAOorcamento;
                    $adc_prod->lanca_orc_prod();
                       
                    break;
					
				/*
				//	Tratamento de menu de clientes
				*/

				case 'menu_cliente':

					require_once $GLOBALS['views']. 'menu_cliente.php';
					
					require_once $GLOBALS['dao']. 'clientesDAO.php';
					$l_cli = new DAOcliente;
					$l_cli->lista_cli('nada');
					
					break;

				case 'lancar_cli':

					if ($_POST['nome_cli'] == '' || $_POST['fone_cli'] == '' || $_POST['email_cli'] == '' ){

						echo '<script> alert ("Todos os campos devem ser preenchidos"); </script>';
						require_once $GLOBALS['views']. 'menu_cliente.php';

					}else{
	
						require_once $GLOBALS['views']. 'menu_cliente.php';
						require_once $GLOBALS['dao']. 'clientesDAO.php';
						
						$lan_cli1 = new DAOcliente;
						$lan_cli1->lanca_cli();

					}

					break;

				case 'listar_cli':

					require_once $GLOBALS['views']. 'menu_cliente.php';
					require_once $GLOBALS['dao']. 'clientesDAO.php';
					
					$lis_cli1 = new DAOcliente;
					$lis_cli1->lista_cli('nada');
					
					break;
                                
                case 'p_cli':
                
                	$s_orc = $_SESSION['n_orc'] ?? null;
                
                	if($s_orc == null){
                	
                		require_once $GLOBALS['views']. 'menu_cliente.php';
                	
                	}else{ 
                
                    	require_once $GLOBALS['views']. 'menu_orcamento.php';
                    
                    }
                    
                    $nome_cli = $_POST['nome_cli'];
                    
                    require_once $GLOBALS['dao']. 'clientesDAO.php';
                    
                    $p_cli = new DAOcliente;
                    $p_cli->lista_cli($nome_cli);
                       
                    break;
				
                case 'sobe_altera_cli':
				
                    if (isset($_SESSION['n_orc'])){
                                            
                        $_SESSION['cod_cli'] = $_POST['id_cli'];
				        $_SESSION['n_cli'] = $_POST['n_cli'];
				        $_SESSION['f_cli'] = $_POST['f_cli'];
				        
                        require_once $GLOBALS['views']. 'menu_orcamento.php';
                                            
                    }else{
                    
						require_once $GLOBALS['views']. 'menu_cliente.php';
						require_once $GLOBALS['dao']. 'clientesDAO.php';
						
						$lis_cli1 = new DAOcliente;
						$lis_cli1->lista_cli('nada');
                                            
                    }
				
					break;

				case 'alterar_cli':

					if ($_POST['nome_cli'] == '' || $_POST['fone_cli'] == '' || $_POST['email_cli'] == '' ){

						echo '<script> alert ("Selecione na lista a entrada a ser alterada.");</script>';
						
						require_once $GLOBALS['views']. 'menu_cliente.php';
						require_once $GLOBALS['dao']. 'clientesDAO.php';
						
						$alt_cli = new DAOcliente;
						$alt_cli->lista_cli('nada');

					}else{

						require_once $GLOBALS['views']. 'menu_cliente.php';
						require_once $GLOBALS['dao']. 'clientesDAO.php';
						
						$alt_cli = new DAOcliente;
						$alt_cli->altera_cli();
						
					}
					
					break;
                                        
                case 'exclui_cli':
                                    
					require_once $GLOBALS['views']. 'menu_cliente.php';
                	require_once $GLOBALS['dao']. 'clientesDAO.php';
                                    
                    $ex_cli = new DAOcliente;
                    $ex_cli->exclui_cli();
 
                    break;
                    
                /*
                //	Tratamento de menu de usuários
                */

				case 'menu_usuario':

					require_once $GLOBALS['views']. 'menu_usuario.php';
					
					require_once $GLOBALS['dao']. 'usuariosDAO.php';
					$l_usu = new DAOusuario;
					$l_usu->lista_usu();
					
					break;

				case 'lancar_usu':

					if ($_POST['nome_usu'] == '' || $_POST['senha_usu'] == '' || $_POST['nivel_usu'] == '' ){

						echo '<script> alert ("Todos os campos devem ser preenchidos"); </script>';
						require_once $GLOBALS['views']. 'menu_usuario.php';

					}else{

						require_once $GLOBALS['views']. 'menu_usuario.php';
						require_once $GLOBALS['dao']. 'usuariosDAO.php';
						
						$lan_usu1 = new DAOusuario;
						$lan_usu1->lanca_usu();

					}

					break;

				case 'listar_usu':

					require_once $GLOBALS['views']. 'menu_usuario.php';
					require_once $GLOBALS['dao']. 'usuariosDAO.php';
					
					$lis_usu1 = new DAOusuario;
					$lis_usu1->lista_usu();
					
					break;

				case 'sobe_altera_usu':

					require_once $GLOBALS['views']. 'menu_usuario.php';
					require_once $GLOBALS['dao']. 'usuariosDAO.php';
					
					$alter_usu = new DAOusuario;
					$alter_usu->lista_usu();

					break;

				case 'alterar_usu':

					if ($_POST['nome_usu'] == '' || $_POST['senha_usu'] == '' || $_POST['nivel_usu'] == '' ){

						echo '<script> alert ("Selecione na lista a entrada a ser alterada.");</script>';
						
						require_once $GLOBALS['views']. 'menu_usuario.php';
						require_once $GLOBALS['dao']. 'usuariosDAO.php';
						
						$alter_usu = new DAOusuario;
						$alter_usu->lista_usu();

					}else{

						require_once $GLOBALS['views']. 'menu_usuario.php';
						require_once $GLOBALS['dao']. 'usuariosDAO.php';
						
						$alt_usu = new DAOusuario;
						$alt_usu->altera_usu();

					}

					break;

				case 'exclui_usu':

						require_once $GLOBALS['views']. 'menu_usuario.php';
						require_once $GLOBALS['dao']. 'usuariosDAO.php';
						
						$exc_usu = new DAOusuario;
						$exc_usu->exclui_usu();
					
					break;
					
				/*
				//	Tratamento de menu de estoque/produtos
				*/

				case 'menu_estoque':

					require_once $GLOBALS['views']. 'menu_estoque.php';
					
					require_once $GLOBALS['dao']. 'produtosDAO.php';
					$l_est = new DAOproduto;
					$l_est->lista_prod('nada');
					
					break;

				case 'lancar_est':

					if($_POST['desc_prod'] == '' || $_POST['tam_prod'] == '' || $_POST['cor_prod'] == '' || $_POST['quan_prod'] == '' || $_POST['val_prod'] == ''){

						require_once $GLOBALS['views']. 'menu_estoque.php';
						echo '<script> alert ("Todos os campos devem ser preenchidos"); </script>';

					}else{

						require_once $GLOBALS['views']. 'menu_estoque.php';
						require_once $GLOBALS['dao']. 'produtosDAO.php';
						
						$lan_est = new DAOproduto;
						$lan_est->lanca_prod('nada');

					}

					break;

				case 'listar_est':
	
						require_once $GLOBALS['views']. 'menu_estoque.php';
						require_once $GLOBALS['dao']. 'produtosDAO.php';
						
						$lis_est = new DAOproduto;
						$lis_est->lista_prod('nada');
					
					break;
                                
                case 'p_prod':
                
                    $nome_cli = $_POST['nome_cli'] ?? null;
                    $_SESSION['n_cli'] = $nome_cli;
                    
                    if($nome_cli == null){
                    
                    	require_once $GLOBALS['views']. 'menu_estoque.php';
                    
                    }else{
                                        
                    	require_once $GLOBALS['views']. 'menu_orcamento.php';
                    
                    }
                    
                    $desc_prod = $_POST['desc_prod'];
                    
                    require_once $GLOBALS['dao']. 'produtosDAO.php';
                    
                    $p_prod = new DAOproduto;
                    $p_prod->lista_prod($desc_prod); 
                      
                    break;

				case 'sobe_altera_prod':
				
					if (isset($_SESSION['n_orc'])){
						
						$_SESSION['id_prod'] = $_POST['id_prod'];
						$_SESSION['d_prod'] = $_POST['d_prod'];
						$_SESSION['t_prod'] = $_POST['t_prod'];
						$_SESSION['c_prod'] = $_POST['c_prod'];
						$_SESSION['q_prod'] = $_POST['q_prod'];
						$_SESSION['v_prod'] = $_POST['v_prod'];
						
						require_once $GLOBALS['views']. 'menu_orcamento.php';
                        require_once $GLOBALS['views']. 'menu_orcamento_novo.php';
					
					}else{
	
						require_once $GLOBALS['views']. 'menu_estoque.php';
						require_once $GLOBALS['dao']. 'produtosDAO.php';
						
						$lis_est = new DAOproduto;
						$lis_est->lista_prod('nada');
						
					}
					
					break;

				case 'alterar_est':

					if ($_POST['desc_prod'] == '' || $_POST['tam_prod'] == '' || $_POST['cor_prod'] == ''  || $_POST['quan_prod'] == ''  || $_POST['val_prod'] == '' ){

						require_once $GLOBALS['views']. 'menu_estoque.php';
						
						echo '<script> alert ("Selecione na lista a entrada a ser alterada.");</script>';
						
						require_once $GLOBALS['dao']. 'produtosDAO.php';
						
						$alter_est = new DAOproduto;
						$alter_est->lista_prod('nada');

					}else{

						require_once $GLOBALS['views']. 'menu_estoque.php';
						require_once $GLOBALS['dao']. 'produtosDAO.php';
						
						$alt_est = new DAOproduto;
						$alt_est->altera_prod();
					
					}
					break;
                                        
                case 'exclui_prod';
                                    
                	require_once $GLOBALS['views']. 'menu_estoque.php';
                    require_once $GLOBALS['dao']. 'produtosDAO.php';
                                    
                    $exc_prod = new DAOproduto;
                    $exc_prod->exclui_prod();
                                    
                    break;
                    
                /*
                //	Tratamento genérico e menu início
                */

				case 'volta_menu':
				
					limpa_sessao_orc();
                    
					require_once $GLOBALS['views']. 'menu_inicial.php';
					
					break;

				case 'atualiza_info':

					require_once $GLOBALS['dao']. 'orcamentosDAO.php';
					$info_orc = new DAOorcamento;
					$info_orc->infoOrc();
					
					require_once $GLOBALS['dao']. 'clientesDAO.php';
					$info_cli = new DAOcliente;
					$info_cli->infoCli();
					
					require_once $GLOBALS['dao']. 'usuariosDAO.php';
					$info_usu = new DAOusuario;
					$info_usu->infoUsu();
					
					require_once $GLOBALS['dao']. 'produtosDAO.php';
					$info_est = new DAOproduto;
					$info_est->infoEst();
					
					require_once $GLOBALS['views']. 'menu_inicial.php';
					
					break;

				case 'situa_prod':

					require_once $GLOBALS['views']. 'menu_estoque.php';
					
					require_once $GLOBALS['dao']. 'produtosDAO.php';
					$l_est = new DAOproduto;
					$l_est->lista_prod('crit');
					
					break;

				default:

					echo '<script>alert ("Nenhuma pagina encontrada!!!</script>';
					
					break;
			}
		}	
    }
    
    /*
    //  Classe que trata das autorizações
    */
    
    class Autoriza{
    
    	public function aut($acao){
    	
    		if($acao === 1  && $_SESSION['$nivel'] != 100){
    		
    			echo '<script>alert("Usuário não autorizado a executar esta ação.");</script>';
    			return false;
    		
    		}
    	
    	}
    
    }

	/*
	//	Classe que trata da conexão
	*/
	
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

	/*
	//	Classe de tratamento de envio de email
	*/
	
	class Mail {
		
		public function envia($assunto, $mensagem){
		
		try{
		
			require_once $GLOBALS['src']. 'mail.php';
			
			if(true){
			
			echo '<script>alert"Email enviado"</script>';
			
			return true;
			
			}
			
		}catch(Exception $e){
		
			echo $e->getMessage();
		
		}
			
		
		}
	
	}

<?php

	ini_set('display_errors', true); error_reporting(E_ALL);

    class Menu{

		function escolhe_menu(){
	
			function escolhe_menu_acao($m){

			    $params = func_get_args();

			foreach ($params as $m) {

	   		    if (isset($_POST[$m])) {

				return $m;

				}
			}

		    }

			switch(escolhe_menu_acao('menu_orcamento', 'menu_estoque', 'menu_usuario', 'menu_cliente', 'volta_menu', 'listar_orc', 'lancar_orc', 'alterar_orc', 'listar_cli', 'lancar_cli', 'alterar_cli', 'listar_usu', 'lancar_usu', 'alterar_usu', 'listar_est', 'lancar_est', 'alterar_est', 'cancela', 'sobe_altera_usu', 'sobe_altera_cli', 'sobe_altera_prod', 'novo_orc')){

				case 'menu_orcamento':

					require_once('menu_orcamento.php');
					break;

				case 'menu_estoque':

					require_once('menu_estoque.php');
					break;

				case 'menu_usuario':

					require_once('menu_usuario.php');
					break;

				case 'menu_cliente':

					require_once('menu_cliente.php');
					break;

				case 'volta_menu':
                                
                                        $_SESSION['n_orc'] = NULL;
                                        unset($_SESSION['n_orc']);
					require_once('menu_inicial.php');
					break;

				case 'cancela':

					require_once('menu_inicial.php');
					break;

				case 'listar_orc':
	
					require_once('menu_orcamento.php');
					require_once('Orcamento.classe.php');
					$lis_orc = new DAOorcamento;
					$lis_orc->lista_orc();
					break;
                                
                                case 'novo_orc':
                                    
                                    
                                        $n_orc = $_POST['id_orc'];
                                        $_SESSION['n_orc'] = $n_orc;    
                                        require_once ('menu_orcamento.php');
					require_once('Cliente.classe.php');
					$lis_cli1 = new DAOcliente;
					$lis_cli1->lista_cli();
                                    break;
                                    
				case 'lancar_orc':

					require_once('menu_orcamento.php');
					require_once('Orcamento.classe.php');
					$lan_orc = new DAOorcamento;
					$lan_orc->lanca_orc();
					break;

				case 'alterar_orc':

					require_once('menu_orcamento.php');
					require_once('Orcamento.classe.php');
					$alt_orc = new DAOorcamento;
					$alt_orc->altera_orc();
					break;

				case 'listar_cli':

					require_once('menu_cliente.php');
					require_once('Cliente.classe.php');
					$lis_cli1 = new DAOcliente;
					$lis_cli1->lista_cli();
					
					break;

				case 'lancar_cli':

					if ($_POST['nome_cli'] == '' || $_POST['fone_cli'] == '' || $_POST['email_cli'] == '' ){

						require_once('menu_cliente.php');
						echo '<script> alert ("Todos os campos devem ser preenchidos"); </script>';

					}else{
	
						require_once('menu_cliente.php');
						require_once('Cliente.classe.php');
						$lan_cli1 = new DAOcliente;
						$lan_cli1->lanca_cli();

					}

					break;
					
				case 'sobe_altera_cli':
				
                                        if (isset($_SESSION['n_orc'])){
                                            
                                            require_once ('menu_orcamento.php');
                                            
                                        }else{
                                            
					    require_once('menu_cliente.php');
                                            
                                        }
					require_once('Cliente.classe.php');
					$lis_cli1 = new DAOcliente;
					$lis_cli1->lista_cli();
				
					break;

				case 'alterar_cli':

					if ($_POST['nome_cli'] == '' || $_POST['fone_cli'] == '' || $_POST['email_cli'] == '' ){

						require_once('menu_cliente.php');
						echo '<script> alert ("Selecione na lista a entrada a ser alterada.");</script>';
						require_once('Cliente.classe.php');
						$alt_cli = new DAOcliente;
						$alt_cli->lista_cli();

					}else{

						require_once('menu_cliente.php');
						require_once('Cliente.classe.php');
						$alt_cli = new DAOcliente;
						$alt_cli->altera_cli();
						
					}
					
					break;

				case 'listar_usu':

					//require_once('menu_usuario.php');
					require_once('Usuario.classe.php');
					$lis_usu1 = new DAOusuario;
					$lis_usu1->lista_usu();
					break;

				case 'lancar_usu':

					if ($_POST['nome_usu'] == '' || $_POST['senha_usu'] == '' || $_POST['nivel_usu'] == '' ){

						require_once('menu_usuario.php');
						echo '<script> alert ("Todos os campos devem ser preenchidos"); </script>';

					}else{

						//require_once('menu_usuario.php');
						require_once('Usuario.classe.php');
						$lan_usu1 = new DAOusuario;
						$lan_usu1->lanca_usu();

					}

					break;

				case 'sobe_altera_usu':

					//require_once('menu_usuario.php');
					require_once('Usuario.classe.php');
					$alter_usu = new DAOusuario;
					$alter_usu->lista_usu();

					break;

				case 'alterar_usu':

					if ($_POST['nome_usu'] == '' || $_POST['senha_usu'] == '' || $_POST['nivel_usu'] == '' ){

						//require_once('menu_usuario.php');
						echo '<script> alert ("Selecione na lista a entrada a ser alterada.");</script>';
						require_once('Usuario.classe.php');
						$alter_usu = new DAOusuario;
						$alter_usu->lista_usu();

					}else{

						//require_once('menu_usuario.php');
						require_once('Usuario.classe.php');
						$alt_usu = new DAOusuario;
						$alt_usu->altera_usu();

					}

					break;

				case 'listar_est':
	
						require_once('menu_estoque.php');
						require_once('Estoque.classe.php');
						$lis_est = new DAOestoque;
						$lis_est->lista_prod();
					
					break;

				case 'lancar_est':

					if($_POST['desc_prod'] == '' || $_POST['tam_prod'] == '' || $_POST['cor_prod'] == '' || $_POST['quan_prod'] == '' || $_POST['val_prod'] == ''){

						require_once('menu_estoque.php');
						echo '<script> alert ("Todos os campos devem ser preenchidos"); </script>';

					}else{

						require_once('menu_estoque.php');
						require_once('Estoque.classe.php');
						$lan_est = new DAOestoque;
						$lan_est->lanca_prod();

					}

					break;

				case 'sobe_altera_prod':
	
						require_once('menu_estoque.php');
						require_once('Estoque.classe.php');
						$lis_est = new DAOestoque;
						$lis_est->lista_prod();
					
					break;

				case 'alterar_est':

					if ($_POST['desc_prod'] == '' || $_POST['tam_prod'] == '' || $_POST['cor_prod'] == ''  || $_POST['quan_prod'] == ''  || $_POST['val_prod'] == '' ){

						require_once('menu_estoque.php');
						echo '<script> alert ("Selecione na lista a entrada a ser alterada.");</script>';
						require_once('Estoque.classe.php');
						$alter_est = new DAOestoque;
						$alter_est->lista_prod();

					}else{

						require_once('menu_estoque.php');
						require_once('Estoque.classe.php');
						$alt_est = new DAOestoque;
						$alt_est->altera_prod();
					
					}
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
		  
		    $instance = new PDO('mysql:host=localhost; dbname=pjcelo', 'root', '');
	  
		    return $instance;
		}
	  
	}

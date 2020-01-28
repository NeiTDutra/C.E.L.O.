<?php
	// mostra os erros na execução do script (usado apenas durante o desenvolvimento/teste)
	ini_set('display_errors', true); error_reporting(E_ALL);
	
    // requisita os arquivos necessários do DOMPdf
    require_once 'dompdf-master/lib/html5lib/Parser.php';
    require_once 'dompdf-master/lib/php-font-lib-master/src/FontLib/Autoloader.php';
    require_once 'dompdf-master/lib/php-svg-lib-master/src/autoload.php';
    require_once 'dompdf-master/src/Autoloader.php';
		
    // inica gravação do buffer de saída
    ob_start();
    // inclui o arquivo no buffer
    include_once 'Imprime_orc.php';
    // armazena o arquivo html na variável
    $html = ob_get_contents();
    // finaliza e limpa o buffer
    ob_end_clean();
    // arnazena o número do orçamento da variável global de sessão na variável
    $_orc = $_SESSION['n_orc'];
    // define os namespaces
    Dompdf\Autoloader::register();
    use Dompdf\Dompdf;
    // inicializa o objeto Dompdf
    $dompdf = new Dompdf();
    // carrega o código HTML no nosso arquivo PDF
    $dompdf->loadHtml($html);
    // (Opcional) Define o tamanho (A4, A3, A2, etc) e a oritenação do papel, que pode ser 'portrait' (em pé) ou 'landscape' (deitado)
    $dompdf->setPaper('A4', 'portrait');
    // Renderiza o documento
    $dompdf->render();
    // pega o código fonte do novo arquivo PDF gerado
    $output = $dompdf->output();
    // define aqui o nome do arquivo a ser salvo
    file_put_contents ($GLOBALS['src'] . 'orcamentosPDF/Ormnt'.$_orc.'.pdf', $output);
    // redireciona o usuário para o download/impressão do arquivo
    die('<script>location.href="orcamentosPDF/Ormnt'.$_orc.'.pdf", "_blank";</script>');

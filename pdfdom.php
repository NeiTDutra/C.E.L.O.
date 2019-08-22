<?php
	ini_set('display_errors', true); error_reporting(E_ALL);
    // chamando os arquivos necessários do DOMPdf
    require_once 'dompdf-master/lib/html5lib/Parser.php';
    require_once 'dompdf-master/lib/php-font-lib-master/src/FontLib/Autoloader.php';
    require_once 'dompdf-master/lib/php-svg-lib-master/src/autoload.php';
    require_once 'dompdf-master/src/Autoloader.php';
		
    
    ob_start();
    include_once 'Imprime_orc.php';
    $html = ob_get_contents();
    ob_end_clean();
    $_orc = $_SESSION['n_orc'];
    // definindo os namespaces
    Dompdf\Autoloader::register();
    use Dompdf\Dompdf;
    // inicializando o objeto Dompdf
    $dompdf = new Dompdf();
    // coloque nessa variável o código HTML que você quer que seja inserido no PDF
    //$codigo_html = "<h1>Olá mundo!</h1><p>Geramos o arquivo com o dom pdf, ihul!</p>";
    // carregamos o código HTML no nosso arquivo PDF
    $dompdf->loadHtml($html);
    // (Opcional) Defina o tamanho (A4, A3, A2, etc) e a oritenação do papel, que pode ser 'portrait' (em pé) ou 'landscape' (deitado)
    $dompdf->setPaper('A4', 'portrait');
    // Renderizar o documento
    $dompdf->render();
    // pega o código fonte do novo arquivo PDF gerado
    $output = $dompdf->output();
    // defina aqui o nome do arquivo que você quer que seja salvo
    file_put_contents('Orçamento'.$_orc.'.pdf', $output);
    // redirecionamos o usuário para o download do arquivo
    die('<script>location.href="Orçamento'.$_orc.'.pdf", "_blank";</script>');
?>

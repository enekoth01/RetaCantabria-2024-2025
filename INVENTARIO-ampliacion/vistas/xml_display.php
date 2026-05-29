<?php    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xml_nombre = $_POST['xml_nombre'];
 
            // Usa rutas relativas fiables
            $xml_path = __DIR__ . '/../xml/consultas/' . $xml_nombre;
            $xslt_path = __DIR__ . '/../schema/xslt/recursos.xsl';
 
            // Verifica existencia
            if (!file_exists($xml_path)) {
                echo "<div class='notification is-danger'>No se encuentra el archivo XML: $xml_path</div>";
                exit;
            }
            if (!file_exists($xslt_path)) {
                echo "<div class='notification is-danger'>No se encuentra el archivo XSLT: $xslt_path</div>";
                exit;
            }
 
            // Aplica XSLT al archivo XML
            $xml = new DOMDocument;
            $xml->load($xml_path);
 
    $xsl = new DOMDocument;
    $xsl->load($xslt_path);
 
    $proc = new XSLTProcessor;
    $proc->importStyleSheet($xsl);
 
    $result = $proc->transformToXML($xml);
    echo '<div>'.$result.'</div>';
}
?>
 
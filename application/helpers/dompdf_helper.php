<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename='', $paper, $orientation, $stream=TRUE) 
{
    require_once("dompdf/dompdf_config.inc.php");

    $dompdf = new DOMPDF();
    $dompdf->set_paper($paper,$orientation);
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream($filename.".pdf",array("Attachment"=>0));
}
?>
<?php

require_once './dompdf/dompdf_config.inc.php';

$html = 'Testing PDF';

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper('A4','potrait');
$dompdf->render();
$dompdf->stream('file.pdf');

?>

<?php
require_once __DIR__.'/../vendor/autoload.php';
use Dompdf\Dompdf;

function render_pdf_or_html($html, $filename){
  if (class_exists(Dompdf::class)){
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream($filename, ['Attachment'=>true]);
    return true;
  } else {
    header('Content-Type: text/html; charset=utf-8');
    echo $html; return false;
  }
}

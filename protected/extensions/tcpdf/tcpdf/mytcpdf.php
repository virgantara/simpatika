<?php
 require_once 'tcpdf.php';
 $tgl_sekarang = date("d F Y");
 
class MyTCPDF extends TCPDF {
  
  public function Footer() {
    $this->SetY(-6);
    $this->writeHTML("<hr>", true, false, false, false, '');
    // $this->SetFont('helvetica', '', 7);
    // $this->SetY(-5);
    $html = '<table border="0" cellspacing="3" cellpadding="4">';
    $html .= '<tr><td style="color:#848484">SURAT KETERANGAN PENDAMPING IJAZAH | <i>Diploma Supplement</i></td></tr>';
    $html .= '</table>';
    $this->SetFont('dejavusans', '', 7);
    $this->writeHTMLCell($this->getPageWidth(), 10, 8, $this->getPageHeight() - 8, $html);

    $txt = 'Halaman '.$this->getAliasNumPage().' dari '.$this->getAliasNbPages().' | '.'Page '.$this->getAliasNumPage().' from '.$this->getAliasNbPages();
    $html = '<table border="0" cellspacing="3" cellpadding="4">';
    $html .= '<tr><td style="color:#848484">'.$txt.'</td></tr>';
    $html .= '</table>';
    
    $this->writeHTMLCell(130, 10, $this->getPageWidth() - 65, $this->getPageHeight() - 8, $html);
    // $this->writeHTML($txt, true, false, false, false, '');

    // $this->Cell(0, 10, 'Halaman '.$this->getAliasNumPage().' dari '.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
  } 
}


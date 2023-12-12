<?php

sc_include_lib ("tcpdf");
 

$pdf = new TCPDF();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);



sc_lookup(head, "SELECT @column1,@column2,@column3,@column4 FROM table_name WHERE tf_id=[my_var]");








$pdf->SetMargins(15, 10, 15);
$pdf->AddPage();
$pdf->Ln();
$pdf->SetFont('Helvetica', 'B', 15);
$pdf->Cell(86, 5, 'Form Penyerahan Barang', 0, 0, 'L');
$pdf->SetFont('Helvetica', 'B', 9);
$pdf->Cell(94, 5, 'Transfer No. : '.{head[0][0]}, 1, 0, 'L');

$pdf->Ln();
$pdf->SetFont('Helvetica', '', 14);
$pdf->Cell(86, 8, '(Goods Transfer Form)', 0, 0, 'L');
$pdf->SetFont('Helvetica', 'B', 9);
$pdf->Cell(94, 5, 'Transfer Date : '.{head[0][1]}, 1, 0, 'L');

$pdf->Ln();
$pdf->Cell(86, 6, '', 0, 0, 'L');
$pdf->Cell(94, 5, 'Remarks : ', 'RTL', 0, 'T', false, '', 0, False, 'T');
$pdf->Ln();
$pdf->Cell(86, 5, '', 0, 0, 'L');
$pdf->Cell(94, 15, {head[0][2]}, 'RBL', 0, 'L');

$pdf->Ln();
$pdf->Cell(86, 5, '', 0, 0, 'L');
$pdf->Ln();
sc_lookup(ds, "SELECT @column1,@column2,@column3,@column4 FROM table2_name where x2=[x]");



$pdf->SetFont('Helvetica', 'B', 9);
$pdf->Cell(8, 12, 'No.', 1, 0, 'L');
$pdf->Cell(100, 6, 'Nama Barang', 'LTR', 0, 'L');
$pdf->Cell(16, 6, 'Jumlah', 'LTR', 0, 'L');
$pdf->Cell(18, 6, 'Satuan', 'LTR', 0, 'L');
$pdf->Cell(38, 6, 'Bagian/Mesin', 'LTR', 0, 'L');
$pdf->Ln(); 
$pdf->Cell(8, 6, '', 'LBR', 0, 'L');
$pdf->Cell(100, 6, '(Item Description)', 'LBR', 0, 'L');
$pdf->Cell(16, 6, '(Qty.)', 'LBR', 0, 'L');
$pdf->Cell(18, 6, '(UoM)', 'LBR', 0, 'L');
$pdf->Cell(38, 6, '(Cost Center)', 'LBR', 0, 'L');
$pdf->Ln(); 





$pdf->SetFont('Helvetica', '', 9);
$width = 110;
$cek = 0;
$no = 1;
if (isset({ds[0][0]})) {
    foreach ({ds} as $row) {
    $pdf->Cell(8, 8, $no, 1, 0, 'L');
    foreach ($row as $cell) {
      
      if($cek == 0){
        $width = 100;
      $pdf->Cell($width, 8, $cell, 1, 0, 'L');
      }elseif($cek == 3){
        $width = 38;
      $pdf->Cell($width, 8, $cell, 1, 0, 'L');
      }elseif($cek == 1){
        $width = 16;
      $pdf->Cell($width, 8, $cell, 1, 0, 'L');
      }else{
        $width = 18;
      $pdf->Cell($width, 8, $cell, 1, 0, 'L');
      }
      $cek++;
    }
    $no++;
    $cek = 0;
    $pdf->Ln(); 
  }
}


$pdf->SetFont('Helvetica', 'B', 9);
$pdf->Cell(86, 5, '', 0, 0, 'L');
$pdf->Ln();

$pdf->Cell(60, 6, 'Nama Penerima', 'LTR', 0, 'C');
$pdf->Cell(60, 6, 'Disetujui Oleh', 'LTR', 0, 'C');
$pdf->Cell(60, 6, 'Tanggal Penerimaan Barang', 'LTR', 0, 'C');
$pdf->Ln(); 
$pdf->Cell(60, 6, '(Received by)', 'LBR', 0, 'C');
$pdf->Cell(60, 6, '(Acknowledge by)', 'LBR', 0, 'C');
$pdf->Cell(60, 6, '(Receipt Date)', 'LBR', 0, 'C');
$pdf->Ln(); 



$pdf->Cell(60, 30, '', 1, 0, 'L');
$pdf->Cell(60, 30, '', 1, 0, 'L');
$pdf->Cell(60, 30, {head[0][3]}, 1, 0, 'C');



//Close and output PDF document
$pdf->Output('Transfer Form '.{head[0][0]}.'.pdf', 'I');
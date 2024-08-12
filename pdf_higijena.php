<?php
session_start(); 
require_once("baza.php"); 
require('tfpdf/tfpdf.php');

$pdf = new tFPDF();
$pdf -> AddPage();
$pdf->Image('sve_slike/logo2.png',10,6,30);
$pdf->Ln(20);
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',13);
$pdf -> setTextColor(0,0,0);
$pdf->Cell(200, 20, "POPIS SVIH PROIZVODA ZA HIGIJENU", "0", "1", "C");

$pdf -> setLeftMargin(17);
$pdf -> setTextColor(0,0,0);

$pdf->Cell(10, 10, "ID", "1", "0", "C");
$pdf->Cell(100, 10, "Naziv", "1", "0", "C");
$pdf->Cell(40, 10, "Cijena", "1", "0", "C");
$pdf->Cell(25, 10, "Kategorija", "1", "1", "C");
$pdf->SetFont('DejaVu','',9);

$query="SELECT higijena.*, kategorija.naziv_kategorija FROM higijena INNER JOIN kategorija ON higijena.kategorija_id = kategorija.kategorija_id ORDER BY higijena_id";
$redci = $konekcija->query($query);

while ($row=$redci->fetch_assoc()) {
    $pdf->Cell(10, 10, $row['higijena_id'], "1", "0", "C");
    $pdf->Cell(100, 10, $row['naziv'], "1", "0", "C");
    $pdf->Cell(40, 10, $row['cijena'] . " kn", "1", "0", "C");
    $pdf->Cell(25, 10, $row['naziv_kategorija'], "1", "1", "C");
}

$pdf->Ln(20);
$pdf->Cell(40, 10, "Pečat: ", "0", "0");
$pdf->Ln(1);
$pdf->Image('sve_slike/pecat2.png',100,220,70);

$pdf ->Output();



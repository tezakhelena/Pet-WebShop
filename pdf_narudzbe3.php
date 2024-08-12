<?php
session_start(); 
require_once("baza.php"); 
require('tfpdf/tfpdf.php');

$korisnik_id = $_SESSION['korisnik_id'];

$pdf = new tFPDF();
$pdf -> AddPage();
$pdf->Image('sve_slike/logo2.png',10,6,30);
$pdf->Ln(20);
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',13);
$pdf -> setTextColor(0,0,0);
$pdf->Cell(200, 20, "POPIS SVIH NARUDŽBA", "0", "1", "C");

$pdf -> setLeftMargin(17);
$pdf -> setTextColor(0,0,0);
$pdf->SetFont('DejaVu','',9);

$query="SELECT*FROM narudzba";
$redci = $konekcija->query($query);

while ($row=$redci->fetch_assoc()) {
    $pdf->Ln(5);
    $pdf->Cell(40, 10, "ID", "0", "0", "C");
    $pdf->Cell(40, 10, $row['narudzba_id'], "0", "0", "C");
    $pdf->Ln(5);
    $pdf->Cell(40, 10, "Proizvod", "0", "0", "C");
    $pdf->Cell(90, 10, $row['proizvod'], "0", "0", "C");
    $pdf->Ln(5);
    $pdf->Cell(40, 10, "Telefon", "0", "0", "C");
    $pdf->Cell(40, 10, $row['telefon'], "0", "0", "C");
    $pdf->Ln(5);
    $pdf->Cell(40, 10, "Ukupno", "0", "0", "C");
    $pdf->Cell(40, 10, $row['totalna_cijena'] . " kn", "0", "0", "C");
    $pdf->Ln(10);
}

$pdf->Ln(20);
$pdf->Cell(40, 10, "Pečat: ", "0", "0");
$pdf->Ln(1);
$pdf->Image('sve_slike/pecat2.png',100,140,70);

$pdf ->Output();



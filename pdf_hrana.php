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
$pdf->Cell(200, 20, "POPIS SVE HRANE", "0", "1", "C");

$pdf -> setLeftMargin(10);
$pdf -> setTextColor(0,0,0);

$pdf->Cell(10, 10, "ID", "1", "0", "C");
$pdf->Cell(75, 10, "Naziv", "1", "0", "C");
$pdf->Cell(40, 10, "Okus", "1", "0", "C");
$pdf->Cell(40, 10, "Cijena", "1", "0", "C");
$pdf->Cell(25, 10, "Kategorija", "1", "1", "C");
$pdf->SetFont('DejaVu','',9);

$query="SELECT hrana.*, kategorija.naziv_kategorija FROM hrana INNER JOIN kategorija ON hrana.kategorija_id = kategorija.kategorija_id ORDER BY id";
$redci = $konekcija->query($query);

while ($row=$redci->fetch_assoc()) {
    $pdf->Cell(10, 10, $row['id'], "1", "0", "C");
    $pdf->Cell(75, 10, $row['naziv'], "1", "0", "C");
    $pdf->Cell(40, 10, $row['okus'], "1", "0", "C");
    $pdf->Cell(40, 10, $row['cijena'] . " kn", "1", "0", "C");
    $pdf->Cell(25, 10, $row['naziv_kategorija'], "1", "1", "C");
}

$pdf->Ln(20);
$pdf->Cell(40, 10, "Pečat: ", "0", "0");
$pdf->Ln(1);
$pdf->Image('sve_slike/pecat2.png',100,220,70);

$pdf ->Output();



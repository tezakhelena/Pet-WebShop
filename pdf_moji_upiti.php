<?php
session_start(); 
require_once("baza.php"); 
require_once("FPDF/fpdf.php");

$korisnik_id = $_SESSION['korisnik_id'];

$pdf = new FPDF();
$pdf -> AddPage();
$pdf->Image('sve_slike/logo2.png',10,6,30);
$pdf->Ln(20);
$pdf -> SetFont("Arial", "B", 16);
$pdf -> setTextColor(0,0,0);
$pdf->Cell(200, 20, "POPIS SVIH UPITA", "0", "1", "C");

$pdf -> setLeftMargin(17);
$pdf -> setTextColor(0,0,0);

$pdf->Cell(10, 10, "ID", "1", "0", "C");
$pdf->Cell(30, 10, "Korisnik", "1", "0", "C");
$pdf->Cell(40, 10, "Naslov", "1", "0", "C");
$pdf->Cell(60, 10, "Pitanje", "1", "0", "C");
$pdf->Cell(40, 10, "Odgovor", "1", "1", "C");
$pdf -> SetFont("Arial", "B", 10);

$query="SELECT*FROM upiti WHERE korisnik_id='$korisnik_id'";
$redci = $konekcija->query($query);

while ($row=$redci->fetch_assoc()) {
    $pdf->Cell(10, 10, $row['id'], "1", "0", "C");
    $pdf->Cell(30, 10, $row['korisnik_id'] . " - " . $row['korisnik'], "1", "0", "C");
    $pdf->Cell(40, 10, $row['naslov'], "1", "0", "C");
    $pdf->Cell(60, 10, $row['pitanje'], "1", "0", "C");
    $pdf->Cell(40, 10, $row['odgovor'], "1", "1", "C");
}

$pdf->Ln(20);
$pdf->Cell(40, 10, "Pečat: ", "0", "0");
$pdf->Ln(1);
$pdf->Image('sve_slike/pecat2.png',100,140,70);

$pdf ->Output();



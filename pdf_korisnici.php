<?php
session_start(); 
require_once("baza.php"); 
require_once("FPDF/fpdf.php");

$pdf = new FPDF();
$pdf -> AddPage();
$pdf->Image('sve_slike/logo2.png',10,6,30);
$pdf->Ln(20);
$pdf -> SetFont("Arial", "B", 16);
$pdf -> setTextColor(0,0,0);
$pdf->Cell(200, 20, "KORISNICI", "0", "1", "C");

$pdf -> setLeftMargin(25);
$pdf -> setTextColor(0,0,0);

$pdf -> SetFont("Arial", "B", 10);
$pdf->Cell(10, 10, "ID", "1", "0", "C");
$pdf->Cell(30, 10, "Korisnik", "1", "0", "C");
$pdf->Cell(40, 10, "Email", "1", "0", "C");
$pdf->Cell(30, 10, "Mobitel", "1", "0", "C");
$pdf->Cell(30, 10, "Odobrenje", "1", "0", "C");
$pdf->Cell(20, 10, "Odobren", "1", "1", "C");
$pdf -> SetFont("Arial", "B", 12);

$query="SELECT*FROM korisnici ORDER BY korisnik_id";
$redci = $konekcija->query($query);

while ($row=$redci->fetch_assoc()) {
    $pdf -> SetFont("Arial", "B", 10);
    $pdf->Cell(10, 10, $row['korisnik_id'], "1", "0", "C");
    $pdf->Cell(30, 10, $row['korisnik'], "1", "0", "C");
    $pdf->Cell(40, 10, $row['email'], "1", "0", "C");
    $pdf->Cell(30, 10, $row['telefon'], "1", "0", "C");
    $pdf->Cell(30, 10, $row['tip_korisnika'], "1", "0", "C");
    if($row['odobrenje'] == 0){
        $pdf->Cell(20, 10, "Da", "1", "1", "C");
    }else{
        $pdf->Cell(20, 10, "Ne", "1", "1", "C");
    }
    
}
$pdf->Ln(20);
$pdf->Cell(40, 10, "Pečat: ", "0", "0");
$pdf->Ln(1);
$pdf->Image('sve_slike/pecat2.png',100,140,70);

$pdf ->Output();



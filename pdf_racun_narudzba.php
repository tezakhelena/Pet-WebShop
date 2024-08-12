<?php
session_start(); 
require_once("baza.php"); 
require('tfpdf/tfpdf.php');

$narudzba_id = $_GET['narudzba_id'];

$pdf = new tFPDF();
$pdf->AddPage();
$pdf->Image('sve_slike/logo2.png',10,6,30);

$pdf->Ln(20);

$pdf -> setTextColor(0,0,0);
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',11);

$pdf -> setLeftMargin(115);

$pdf->Write(10,"Naziv kompanije:  PET SHOP");
$pdf->Ln(5);
$pdf->Write(10,"Kontakt / Email:  tezak.helena@gmail.com");
$pdf->Ln(5);
$pdf->Write(10,"OIB poslovnice:  400000000");
$pdf->Ln(5);
$pdf->Write(10,"Račun je izrađen automatski");

$pdf -> setLeftMargin(10);
$pdf->Ln(10);


// Select a standard font (uses windows-1252)
$pdf->Ln(10);

$query="SELECT narudzba.*, placanje_podaci.vrsta FROM narudzba INNER JOIN placanje_podaci ON narudzba.placanje_id = placanje_podaci.placanje_id WHERE narudzba.narudzba_id = $narudzba_id";
$redci = $konekcija->query($query);

while ($row=$redci->fetch_assoc()) {
    $pdf -> setTextColor(0, 0, 0);
    $pdf -> setLeftMargin(80);
    $pdf->SetFont('DejaVu','',14);
    $pdf->Write(10,"Broj narudžbe: ");
    $pdf->Cell(40, 10, $row['narudzba_id'], "0", "1");

    $pdf -> setLeftMargin(10);
    $pdf->SetFont('DejaVu','',11);
    $pdf -> Ln(10);
    $pdf->Write(10,"KUPAC:");
    $pdf->Ln(5);
    $pdf->Cell(40, 10, $row['korisnik'], "0", "1");
    $pdf->Ln(-5);
    $pdf->Cell(40, 10, "Datum narudžbe: ", "0", "0");
    $pdf->Cell(40, 10, $row['datum_narudzbe'], "0", "1");
    $pdf->Ln(-5);
    $pdf->Cell(40, 10, "Kontakt: ", "0", "0");
    $pdf->Cell(40, 10, $row['telefon'] . " / " .  $row['email'], "0", "1");
    $pdf->Ln(1);
    $pdf->Write(10,"PRIMATELJ:");
    $pdf->Ln(5);
    $pdf->Cell(40, 10, $row['primatelj'], "0", "1");
    $pdf->Ln(-5);
    $pdf->Cell(40, 10, "Adresa isporuke: ", "0", "0");
    $pdf->Cell(40, 10, $row['ulica'] . ", " . $row['grad'] . ", " . $row['postanski_broj'], "0", "1");
    $pdf->Ln(15);

    $pdf -> setRightMargin(50);
    $pdf->SetFont('DejaVu','',10);
    $pdf->Cell(40, 10, "Proizvodi: ", "1", "0");
    $pdf->Cell(135, 10, $row['proizvod'], "1", "1", "C");
    $pdf->Ln(0);
    $pdf->Cell(40, 10, "Način plaćanja: ", "1", "0");
    $pdf->Cell(135, 10, $row['vrsta'], "1", "1", "R");
    $pdf->Ln(0);
    $pdf->Cell(40, 10, "Ukupno za platiti: ", "1", "0");
    $pdf -> setTextColor(252,3,3);
    $pdf->Cell(135, 10, $row['totalna_cijena'] . " kn / " . round($row['totalna_cijena'] / 7.5, 2) . " €", "1", "1", "R");
    $pdf->Ln(5);

    $pdf->Ln(10);

    $pdf -> setTextColor(0,0,0);
    $pdf->Cell(15, 10, "Status: ", "0", "0");
        if($row['status'] == 0){
        $pdf->Cell(40, 10, "Zaprimljena narudžba", "0", "1");
        }elseif($row['status'] == 0){
            $pdf->Cell(40, 10, "Narudžba u pripremi", "0", "1");
        }else{
            $pdf->Cell(40, 10, "Narudžba isporučena", "0", "1"); 
        }
    $pdf->Cell(40, 10, "Pečat: ", "0", "0");
    $pdf->Image('sve_slike/pecat2.png',100,220,70);

    $pdf -> setTextColor(0,0,0);
}

$pdf->Output();
?>
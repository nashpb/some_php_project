<?php
require('./fpdf.php');

class PDF extends FPDF
{


function Invoice()
{
	$header = ['SERVICES','PRICE'];
	$data = [['Hair wash',100],['Hari cut',70]];
	$this->Image('logo.png',10,6,30);

	$total = 170;
	$this->SetMargins(14,14,14);
	$this->SetLineWidth(3);
	$this->Cell(80);
	$this->SetFontSize(30);
	$this->Cell(30,10,'EMPOWER SALON',0,0,'C');
	$this->SetFontSize(12);

    // Line break
	$this->Ln(60);

	
	$this->setX(30);

	$this->SetLineWidth(1.5);

	for($i=0;$i<count($header);$i++)
	{
		$this->Cell(80,7,$header[$i],1,0,'C');
	}
	$this->Ln();
	

	$this->SetLineWidth(1);

	for($j=0;$j<count($data);$j++)
	{

		$this->setX(30);
		$this->cell(80,12,$data[$j][0],'LR',0,'C');
		$this->cell(80,12,$data[$j][1],'LR',0,'C');
		$this->Ln();
	}
	
	$this->SetLineWidth(1.5);
	$this->setX(30);
	$this->cell(80,12,'Total',1,0,'C');
	$this->cell(80,12,$total,1,0,'C');
	$this->Ln();



	
}

}

$pdf = new PDF();
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->Invoice();
$pdf->Output('D',"Bill.pdf");
?>

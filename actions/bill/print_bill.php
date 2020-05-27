<?php
require('./fpdf.php');
include_once('../../configs/db.php');
include_once('../../configs/login_check.php');

class PDF extends FPDF
{


function Invoice($db_conn)
{
	if(empty($_REQUEST['id']))
	{
		$_SESSION['flash']  = "ERROR!!! Something Went wrong!Could not generate bill!";
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/view_my_appointment.php');
		exit;
	}
	$header = ['SERVICES','PRICE'];
	$on_appointments = [];
	$sql_query = 'SELECT * FROM `appointments` WHERE `id` = '.$_REQUEST['id'];
	$result = mysqli_query($db_conn,$sql_query);
	$data = [];
	$total = 0.00;
	if($result)
	{
		$on_appointments = mysqli_fetch_all($result);
		if(!empty($on_appointments))
		{
			$sel_services = [];
			$sql_query = "SELECT `service_id` FROM `appointment_services_junc` WHERE `appointment_id` = ".$on_appointments[0][0];
			$result = mysqli_query($db_conn,$sql_query);
			if($result)
			{
				$sel_services = mysqli_fetch_all($result);
				if(!empty($sel_services))
				{
					foreach($sel_services as $key_1=>$sel_service)
					{
						$sql_query = "SELECT `name`,`price` FROM `services` WHERE `id` =".$sel_service[0];
						$result = mysqli_query($db_conn,$sql_query);
						if($result)
						{
							// var_dump(mysqli_fetch_array($result)['name'],mysqli_fetch_array($result)['price']);
							$temp_array =[];
							$service_array = mysqli_fetch_all($result);
							$temp_array= $service_array[0];
							$total += $temp_array[1];
							array_push($data,$temp_array);
						}
						else
						{
							$_SESSION['flash']  = "ERROR!!! Something Went wrong!Could not generate bill!";
							header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/view_my_appointment.php');
							exit;	
						}
					}
					// var_dump($data);
					// exit;
				}
				else
				{
					$_SESSION['flash']  = "ERROR!!! Something Went wrong!Could not generate bill!";
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/view_my_appointment.php');
					exit;	
				}
			}
			else
			{
				$_SESSION['flash']  = "ERROR!!! Something Went wrong!Could not generate bill!";
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/view_my_appointment.php');
				exit;	
			}

		}
		else
		{
			$_SESSION['flash']  = "ERROR!!! Something Went wrong!Could not generate bill!";
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/view_my_appointment.php');
			exit;	
		}
	}
	
	$this->Image('logo.png',10,6,30);
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
$pdf->Invoice($db_conn);
$pdf->Output('D',"Bill".date("Y-m-d-h:i:s-A").".pdf");
header('Location:'.$_SERVER["HTTP_REFERER"]);
exit;
?>

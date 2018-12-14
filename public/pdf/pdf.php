<?php
require('../php/fpdf/fpdf.php');

class PDF extends FPDF
{
	function Header()
{
	// Logo
	$this->Image('../img/ucol-logo.png',10,5,22);
	$this->Image('../img/logo-fie.png',170,5,22);
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Movernos a la derecha
	$this->Cell(80);
	// Título
	$this->Cell(30,10,utf8_decode("Bitácora"),0,0,'C');
	// Salto de línea
	$this->Ln(20);
}
// Cargar los datos
function LoadData($file)
{
	// Leer las líneas del fichero
	$lines = file($file);
	$data = array();
	foreach($lines as $line)
		$data[] = explode(';',trim($line));
	return $data;
}

// Tabla simple
function BasicTable($header, $data)
{
	// Cabecera
	foreach($header as $col)
		$this->Cell(40,7,$col,1);
	$this->Ln();
	// Datos
	foreach($data as $row)
	{
		foreach($row as $col)
			$this->Cell(40,6,$col,1);
		$this->Ln();
	}
}

// Una tabla más completa
function ImprovedTable($header, $data)
{
	// Anchuras de las columnas
	$w = array(20, 60, 60, 22,27);
	// Cabeceras
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C');
	$this->Ln();
	// Datos
	foreach($data as $row)
	{
		$this->SetX($this->lMargin);
		$this->Cell($w[0],6,$row[0],1);
		$this->Cell($w[1],6,$row[1],1);
		$this->Cell($w[2],6,$row[2],1);
		$this->Cell($w[3],6,$row[3],1);
		$this->Cell($w[4],6,$row[4],1);
		//$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
		//$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
		//$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
		$this->Ln();
	}
	// Línea de cierre
	$this->Cell(array_sum($w),0,'','T');
}

// Tabla coloreada
function FancyTable($header, $data)
{
	// Colores, ancho de línea y fuente en negrita
	$this->SetFillColor(255,0,0);
	$this->SetTextColor(255);
	$this->SetDrawColor(128,0,0);
	$this->SetLineWidth(.3);
	$this->SetFont('','B');
	// Cabecera
	$w = array(40, 35, 45, 40,40);
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	$this->Ln();
	// Restauración de colores y fuentes
	$this->SetFillColor(224,235,255);
	$this->SetTextColor(0);
	$this->SetFont('');
	// Datos
	$fill = false;
	foreach($data as $row)
	{
		$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
		$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
		$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
		$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
		$this->Ln();
		$fill = !$fill;
	}
	// Línea de cierre
	$this->Cell(array_sum($w),0,'','T');
}
}

//codigo PHP NECESARIOOO

if(isset($_GET['type'])){
   include '../php/conecDB.php';

   $type = $_GET['type'];

   switch ($type) {
   	case "Sem":

   		$month = $_GET['mes'];
   		$day = $_GET['dia'];
   		$year = $_GET['ano'];
   		//$nuevaFecha = mktime(0,0,0,date("m"),date("d"),date("Y"));
   		$nuevaFecha = mktime(0,0,0,$month,$day,$year); 
		$diaDeLaSemana = date("w", $nuevaFecha);
		$nuevaFecha = $nuevaFecha - ($diaDeLaSemana*24*3600); //Restar los segundos totales de los dias transcurridos de la semana

					//Informacion de los pdf
					$pdf = new PDF();
					// Títulos de las columnas
					$header = array('No Cuenta', 'Alumno', 'Carrera', 'Fecha', 'Hora de Entrada');
					// Creamos archivo TXT
					$archivo = fopen("tempinfo.txt", "w");


		for($i = 1; $i <= 5; $i++){
			$fecha = date ("Y-m-d",($nuevaFecha+$i*24*3600));
			$consulta = mysqli_query($conex,"SELECT * FROM historial WHERE fecha = '$fecha'");//lune
				if(mysqli_num_rows($consulta) > 0){//existen datos
					
					while($row = mysqli_fetch_array($consulta)){
						$id = $row['id_alumno'];
						$alumno = mysqli_query($conex,"SELECT * FROM Alumno WHERE id = '$id'");
						
						$rowg = mysqli_fetch_array($alumno);
						$cuenta = $rowg['no_cuenta'];
						$alumno = $rowg['nombre'];
						$idC = $rowg['carrera'];

						$carreras = mysqli_query($conex,"SELECT * FROM carreras WHERE id_carrera = '$idC'");
						$rowc = mysqli_fetch_array($carreras);

						$carrera = $rowc['carrera'];
						$horas = $row['c_horas'];
						$fecha = $row['fecha'];
						$hora = $row['hora'];

						fputs($archivo, utf8_decode("$cuenta;$alumno;$carrera;$fecha;$hora\n"));
						//fwrite($archivo, PHP_EOL ."$id;$horas;$fecha;$hora");
					}
					

				}
		}

					fclose($archivo);
					$data = $pdf->LoadData('tempinfo.txt');
					$pdf->SetFont('Arial','',10);
					$pdf->AddPage();
					$pdf->Cell(0,15,'',0,1);
					$pdf->ImprovedTable($header,$data);
					$pdf->Output();
		

   		break;
   	case "Men":
   		$month = $_GET['mes'];
   		$ano = date("Y");

   		$fecha = $ano."-".$month."-1";
		$timestamp = strtotime( $fecha );
		$diasdelmes = date( "t", $timestamp);

			//Informacion de los pdf
			$pdf = new PDF();
			// Títulos de las columnas
			$header = array('No Cuenta', 'Alumno', 'Carrera', 'Fecha', 'Hora de Entrada');
			// Creamos archivo TXT
			$archivo = fopen("tempinfo.txt", "w");


			for($i=1;$i<= $diasdelmes;$i++){
	        	
	        	$fechaf = $ano."-".$month."-".$i;

	        	$consulta = mysqli_query($conex,"SELECT * FROM historial WHERE fecha = '$fechaf'");
	        	
	        	while($row = mysqli_fetch_array($consulta)){
	        		$id = $row['id_alumno'];
				    $alumno = mysqli_query($conex,"SELECT * FROM Alumno WHERE id = '$id'");

				    $rowg = mysqli_fetch_array($alumno);
						$cuenta = $rowg['no_cuenta'];
						$alumno = $rowg['nombre'];
						$idC = $rowg['carrera'];

						$carreras = mysqli_query($conex,"SELECT * FROM carreras WHERE id_carrera = '$idC'");
						$rowc = mysqli_fetch_array($carreras);

						$carrera = $rowc['carrera'];
						$horas = $row['c_horas'];
						$fecha = $row['fecha'];
						$hora = $row['hora'];

						fputs($archivo, utf8_decode("$cuenta;$alumno;$carrera;$fecha;$hora\n"));

	        	}
	        	

	        }

	        		fclose($archivo);
					$data = $pdf->LoadData('tempinfo.txt');
					$pdf->SetFont('Arial','',10);
					$pdf->AddPage();
					$pdf->Cell(0,15,'',0,1);
					$pdf->ImprovedTable($header,$data);
					$pdf->Output();
   		break;
   	case "Anu":
  	 		
   		break;
   	
   	default:
   		
   		break;
   }

}else{

$pdf = new PDF();
// Títulos de las columnas
$header = array('No Cuenta', 'Alumno', 'Carrera', 'fecha', 'hora');
// Carga de datos
$data = $pdf->LoadData('tempinfo.txt');
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
$pdf->Cell(0,15,'',0,1);
//$pdf->BasicTable($header,$data);
//$pdf->AddPage();
$pdf->ImprovedTable($header,$data);
//$pdf->AddPage();
//$pdf->FancyTable($header,$data);
$pdf->Output();
}
?>

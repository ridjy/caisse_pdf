<?php
class Pdf extends CI_Controller
{
public function __construct()
{
	// Obligatoire
	parent::__construct();
	define('FPDF_FONTPATH',$this->config->item('fonts_path'));
	$this->load->library('fpdf');
}


public function fiche()
{
	function int2str($a)
{
$convert = explode('.',$a);
//if (isset($convert[1]) && $convert[1]!=''){
//return int2str($convert[0]).''.' et '.int2str($convert[1]).'Ariary' ;
//}
if ($a<0) return 'moins '.int2str(-$a);
if ($a<17){
switch ($a){
//case 0: return 'zero';
case 1: return 'UN';
case 2: return 'DEUX';
case 3: return 'TROIS';
case 4: return 'QUATRE';
case 5: return 'CINQ';
case 6: return 'SIX';
case 7: return 'SEPT';
case 8: return 'HUIT';
case 9: return 'NEUF';
case 10: return 'DIX';
case 11: return 'ONZE';
case 12: return 'DOUZE';
case 13: return 'TREIZE';
case 14: return 'QUATORZE';
case 15: return 'QUINZE';
case 16: return 'SEIZE';
}
} else if ($a<20){
return 'DIX-'.int2str($a-10);
} else if ($a<100){
if ($a%10==0){
switch ($a){
case 20: return 'VINGT';
case 30: return 'TRENTE';
case 40: return 'QUARANTE';
case 50: return 'CINQUANTE';
case 60: return 'SOIXANTE';
case 70: return 'SOIXANTE-DIX';
case 80: return 'QUATRE-VINGT';
case 90: return 'QUATRE-VINGT-DIX';
}
} elseif (substr($a, -1)==1){
if( ((int)($a/10)*10)<70 ){
return int2str((int)($a/10)*10).'-ET-UN';
} elseif ($a==71) {
return 'SOIXANTE-ET-ONZE';
} elseif ($a==81) {
return 'QUATRE-VINGT-UN';
} elseif ($a==91) {
return 'QUATRE-VINGT-ONZE';
}
} elseif ($a<70){
return int2str($a-$a%10).'-'.int2str($a%10);
} elseif ($a<80){
return int2str(60).'-'.int2str($a%20);
} else{
return int2str(80).'-'.int2str($a%20);
}
} else if ($a==100){
return 'CENT';
} else if ($a<200){
return int2str(100).' '.int2str($a%100);
} else if ($a<1000){
return int2str((int)($a/100)).' '.int2str(100).' '.int2str($a%100);
} else if ($a==1000){
return 'MILLE';
} else if ($a<2000){
return int2str(1000).' '.int2str($a%1000).' ';
} else if ($a<1000000){
return int2str((int)($a/1000)).' '.int2str(1000).' '.int2str($a%1000);
}
else if ($a==1000000){
return 'MILLIONS';
}
else if ($a<2000000){
return int2str(1000000).' '.int2str($a%1000000).' ';
}
else if ($a<1000000000){
return int2str((int)($a/1000000)).' '.int2str(1000000).' '.int2str($a%1000000);
}
}


	$this->fpdf->Open();
	$this->fpdf->AddPage();
	
	$this->fpdf->Image(img_url('logo.JPG'),150,7,50);
	
	$this->fpdf->SetXY(15,10);
	$this->fpdf->SetFont('helvetica','',11);
	$this->fpdf->Cell(23,5,'Agence de','B',0);
	$this->fpdf->SetFont('helvetica','B',11);
	$this->fpdf->Cell(10,5,$this->input->post('agence'),'B');

	$this->fpdf->SetXY(65,18);
	$this->fpdf->SetFont('helvetica','B',15);
	$this->fpdf->Cell(60,10,'ENTREE DE CAISSE',1,0,'C');
	
	$this->fpdf->SetXY(15,30);
	$this->fpdf->SetFont('helvetica','',13);
	$this->fpdf->Cell(65,10,utf8_decode('Référence encaissement N°'),0,0);
	$this->fpdf->Cell(45,8,$this->input->post('journal'),'B',0,'C');
	$this->fpdf->Cell(13,8,'du',0,0,'C');
	$a=getdate();
	$this->fpdf->Cell(30,8,$a['mday'].'/'.date('m').'/'.$a['year'],'B',0,'C');

	$this->fpdf->SetXY(15,39);
	$this->fpdf->SetFont('helvetica','',13);
	$this->fpdf->Cell(65,9,'MONTANT Ar',0,0);
	$this->fpdf->Cell(75,8,'***'.number_format($this->input->post('montant'), 2, ',', ' ').'***','B',0,'C');
	

	$a=number_format($this->input->post('montant'), 2, '.', '');
	$convert = explode('.',$a);


	$this->fpdf->SetXY(15,49);
	$this->fpdf->SetFont('helvetica','',13);
	$this->fpdf->Cell(50,8,'SOMME DE (en lettre):',0,0);
	$this->fpdf->MultiCell(150,7,int2str($convert['0']).' ARIARY '.int2str($convert['1']),0,'L');

	$this->fpdf->SetXY(15,62);
	$this->fpdf->SetFont('helvetica','',13);
	$this->fpdf->Cell(60,8,'Objet de l\'encaissement :',0,0);
	$this->fpdf->Cell(70,7,'   '.$this->input->post('objet'),'B',0);

	$this->fpdf->SetXY(15,70);
	$this->fpdf->SetFont('helvetica','',13);
	$this->fpdf->Cell(60,8,utf8_decode('N° des Factures:'),0,0);
	$this->fpdf->Cell(70,7,'   '.$this->input->post('num'),'B',0);
	
	$this->fpdf->SetXY(15,78);
	$this->fpdf->SetFont('helvetica','',13);
	$this->fpdf->Cell(60,8,utf8_decode('Avance sur dossier N°:'),0,0);
	$this->fpdf->Cell(70,7,'   '.$this->input->post('avance'),'B',0);

	$this->fpdf->SetXY(15,87);
	$this->fpdf->SetFont('helvetica','',13);
	$this->fpdf->Cell(60,8,'Autres :',0,0);
	$this->fpdf->Cell(70,7,'  '.$this->input->post('autre'),'B',0);

	$this->fpdf->SetXY(15,95);
	$this->fpdf->SetFont('helvetica','',13);
	$this->fpdf->Cell(35,8,'nom du client :',0,0);
	$this->fpdf->Cell(80,7,$this->input->post('nom'),'B',0,'C');
	$this->fpdf->Cell(26,8,'REF IRIS:',0,'C');
	$this->fpdf->Cell(40,7,$this->input->post('ref'),'B',0);

	$this->fpdf->SetXY(25,104);
	$this->fpdf->SetFont('helvetica','',11);
	$this->fpdf->Cell(35,3,'Nom et signature',0,1);
	$this->fpdf->SetXY(25,108);
	$this->fpdf->Cell(35,3,'du remettant',0,0);

	$this->fpdf->SetXY(87,104);
	$this->fpdf->SetFont('helvetica','',11);
	$this->fpdf->Cell(35,3,'Chef comptable',0,0);
	
	$this->fpdf->SetXY(140,104);
	$this->fpdf->SetFont('helvetica','',11);
	$this->fpdf->Cell(35,3,utf8_decode('Caissier réceptionnaire'),0,0);


	$this->fpdf->SetXY(70,130);
	$this->fpdf->SetFont('helvetica','',11);
	$this->fpdf->Cell(35,3,utf8_decode('Caissier réceptionnaire'),0,0);	
	

	$this->fpdf->SetXY(15,140);
	$this->fpdf->Cell(150,3,'.................................................................................................................................................................',0,0);
	//PARTIE 2

	$this->fpdf->Image(img_url('logo.JPG'),150,145,50);
	
	$this->fpdf->SetXY(15,150);
	$this->fpdf->SetFont('helvetica','',11);
	$this->fpdf->Cell(23,5,'Agence de','B',0);
	$this->fpdf->SetFont('helvetica','B',11);
	$this->fpdf->Cell(10,5,$this->input->post('agence'),'B');

	$this->fpdf->SetXY(65,158);
	$this->fpdf->SetFont('helvetica','B',15);
	$this->fpdf->Cell(60,10,'ENTREE DE CAISSE',1,0,'C');
	
	$this->fpdf->SetXY(15,170);
	$this->fpdf->SetFont('helvetica','',13);
	$this->fpdf->Cell(65,10,utf8_decode('Référence encaissement N°'),0,0);
	$this->fpdf->Cell(45,8,$this->input->post('journal'),'B',0,'C');
	$this->fpdf->Cell(13,8,'du',0,0,'C');
	$a=getdate();
	$this->fpdf->Cell(30,8,$a['mday'].'/'.date('m').'/'.$a['year'],'B',0,'C');

	$this->fpdf->SetXY(15,179);
	$this->fpdf->SetFont('helvetica','',13);
	$this->fpdf->Cell(65,9,'MONTANT Ar',0,0);
	$this->fpdf->Cell(75,8,'***'.number_format($this->input->post('montant'), 2, ',', ' ').'***','B',0,'C');
	

	$a=number_format($this->input->post('montant'), 2, '.', '');
	$convert = explode('.',$a);


	$this->fpdf->SetXY(15,188);
	$this->fpdf->SetFont('helvetica','',13);
	$this->fpdf->Cell(50,8,'SOMME DE (en lettre):',0,0);
	$this->fpdf->MultiCell(150,7,int2str($convert['0']).' ARIARY '.int2str($convert['1']),0,'L');

	$this->fpdf->SetXY(15,201);
	$this->fpdf->SetFont('helvetica','',13);
	$this->fpdf->Cell(60,8,'Objet de l\'encaissement :',0,0);
	$this->fpdf->Cell(70,7,'   '.$this->input->post('objet'),'B',0);

	$this->fpdf->SetXY(15,209);
	$this->fpdf->SetFont('helvetica','',13);
	$this->fpdf->Cell(60,8,utf8_decode('N° des Factures:'),0,0);
	$this->fpdf->Cell(70,7,'   '.$this->input->post('num'),'B',0);
	
	$this->fpdf->SetXY(15,217);
	$this->fpdf->SetFont('helvetica','',13);
	$this->fpdf->Cell(60,8,utf8_decode('Avance sur dossier N°:'),0,0);
	$this->fpdf->Cell(70,7,'   '.$this->input->post('avance'),'B',0);

	$this->fpdf->SetXY(15,225);
	$this->fpdf->SetFont('helvetica','',13);
	$this->fpdf->Cell(60,8,'Autres :',0,0);
	$this->fpdf->Cell(70,7,'  '.$this->input->post('autre'),'B',0);

	$this->fpdf->SetXY(15,233);
	$this->fpdf->SetFont('helvetica','',13);
	$this->fpdf->Cell(35,8,'nom du client :',0,0);
	$this->fpdf->Cell(80,7,$this->input->post('nom'),'B',0,'C');
	$this->fpdf->Cell(26,8,'REF IRIS:',0,'C');
	$this->fpdf->Cell(40,7,$this->input->post('ref'),'B',0);

	$this->fpdf->SetXY(25,243);
	$this->fpdf->SetFont('helvetica','',11);
	$this->fpdf->Cell(35,3,'Nom et signature',0,1);
	$this->fpdf->SetXY(25,247);
	$this->fpdf->Cell(35,3,'du remettant',0,0);

	$this->fpdf->SetXY(87,243);
	$this->fpdf->SetFont('helvetica','',11);
	$this->fpdf->Cell(35,3,'Chef comptable',0,0);
	
	$this->fpdf->SetXY(140,243);
	$this->fpdf->SetFont('helvetica','',11);
	$this->fpdf->Cell(35,3,utf8_decode('Caissier réceptionnaire'),0,0);

	$this->fpdf->SetAutoPageBreak(0,1);

	$this->fpdf->SetXY(70,279);
	$this->fpdf->SetFont('helvetica','',11);
	$this->fpdf->Cell(35,3,utf8_decode('Caissier réceptionnaire'),0,0);	

	$this->fpdf->Output();
}

}
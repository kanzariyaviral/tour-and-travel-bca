<?php
require 'config.php';
require_once('TCPDF-main/tcpdf.php');
if(isset($_GET['pdf_report_generate'])){
    $sel=$_GET['cars'];
    
if($sel=='user'){
    $repo='Users';
    $sql = "SELECT * FROM user WHERE `role_role_id` = '1'";
    $query = mysqli_query($conn ,$select);
    while($row=mysqli_fetch_array($query)){
        $username = $row['user_name'];
        $email = $row['email'];
        $dob = $row['dob'];
        $phone = $row['contact_no'];
        $gender = $row['gender'];
        $img = $row['user_image']; 
    }


// if($_SERVER['REQUEST_METHOD']=="POST"){
//     $gid = $_POST['cars'];
//     $sql = "SELECT * FROM `$gid`";
//     $res = mysqli_query($conn, $sql);
//     while($row = mysqli_fetch_assoc){
//         $row = 
//     }
// }




class PDF extends TCPDF
{
    public function Header(){
        $imageFile=K_PATH_IMAGES.'.g.jpg';
        // $images='<img src="g.jpg" width="150" />';
        $this->Image($imageFile,20,10,20,'','jpg','','T',false,300,'',false,false,0,false,false,false);

        $this->Ln(5);
        $this->setFont('helvetica','B','20');
        $this->Cell(189,5,'Alankar Tour',0,1,'C');

        $this->setFont('helvetica','','12');
        $this->Cell(189,5,'Shop no.2, Swastik Society, ',0,1,'C');
        $this->Cell(189,5,'Near by new roop kala studio,',0,1,'C');
        $this->Cell(189,5,'Nikol gam road,Ahmedabad',0,1,'C');
        $this->Cell(189,5,'- 382350 Gujarat',0,1,'C');
        $this->Cell(189,5,'phone:+919898652615',0,1,'C');
        $this->Cell(189,5,'Email-alankartourstravels@gmail.com',0,1,'C');
        $this->setFont('helvetica','B','11');
        $this->Ln(5);
        $this->Cell(189,10,' Report Of'.$repo,0,1,'C');
    }

    public function Footer(){
        $this->setY(-50);
       


        // set font 
        $this->setY(-5);

        $this->setFont('helvetica','I',8);

        date_default_timezone_set("Asia/Dhaka");
        $today=date("F j,Y/g:i A",time());

        $this->Cell(25,1,'Date/Time:'.$today,0,0,'L');
        $this->Cell(164,1,'page'.$this->getAliasNumPage().'of'.$this->getAliasNbPages(),0,false,'R',0,'',0,false,'T','M');

    }


}


// create new PDF document
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Alankar');
$pdf->SetTitle('package');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true); 

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

$pdf->Ln(18);
$pdf->SetFont('times', 'B', 14,10);
date_default_timezone_set("Asia/Dhaka");
        $today=date("F j,Y/g:i A",time());
$pdf->Cell(189,16,'Report Date:-'.$today,0,1,'C');

$pdf->Ln(10);
$pdf->setFillColor(224,235,255);
$pdf->Cell(10,5,'NO',1,0,'c',1);
$pdf->Cell(40,5,'Name',1,0,'c',1);
$pdf->Cell(50,5,'Email',1,0,'c',1);
$pdf->Cell(25,5,'DOB',1,0,'c',1);
$pdf->Cell(35,5,'Contect',1,0,'c',1);
$pdf->Cell(18,5,'Gender',1,0,'c',1);
$pdf->setFont('times','',10);


// $sql = "SELECT * FROM user WHERE `role_role_id` = '1'";


// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');
}
}
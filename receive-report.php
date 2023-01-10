<?php
    session_start();
    if($_SESSION['pa_id']==null)
    {
        header('location: login-user.php');
    }
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    $server= "localhost";
    $username = "root";
    $password = "";
    $db = "medalexa";

    $con = mysqli_connect($server,$username,$password,$db);
    
    $jsonString = file_get_contents("php://input");
    $object = json_decode($jsonString, true);
    var_dump($object);
    
    require("vendor/autoload.php");
    require_once('TCPDF/tcpdf.php');

    // Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF {

        //Page header
        public function Header() {
            $this->SetY(15);
            $this->SetFont('helvetica', 'B', 20);
            $this->Cell(0, 15, 'Report', 1, false, 'C', 0, '', 1, false, 'M', 'M');
        }

        // Page footer
        public function Footer() {
            $this->SetY(-30); 
            $this->SetFont('times', '', 15);
            $this->Cell(0,10,"-----Get Well Soon-----",0,0,'C');
            $this->Ln(10);
            $this->SetFont('times','',12);
            $this->SetFillColor(224,235,255);
            $this->Cell(100,8,'Email : team.medalexa@gmail.com',1,0,'C',1);
            $this->SetX(109);
            $this->Cell(90,8,'Phone : 8469756025',1,1,'C',1);
            $this->SetFont('times', '', 11);
            $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
        }
    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Team Med-Alexa');
    $pdf->SetTitle('medalexa');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');


    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // add a page
    $pdf->AddPage();

    $pt_id = $_SESSION['pt_id'];
    $dr_id = $_SESSION['dr_id'];
    $dname = $_SESSION['dr_name'];
    $pname =  $_SESSION['pname'];
    date_default_timezone_set('Asia/Calcutta'); 
    $date = date('m/d/y h:i:s a',time());
    $email = $_SESSION['pt_email'];
    // set some text to print

    $pdf->SetFont('times','',12);
    $pdf->SetX(120);
    $pdf->Cell(70,5,'Report Date : '.$date.'',0,0);
    $pdf->Ln(20);
    $pdf->SetX(20);
    $pdf->Cell(150,5,'Doctor ID     :   '.$dr_id.'',0,0);
    $pdf->SetX(100);
    $pdf->Cell(150,5,'Doctor Name    :   '.$dname.'',0,0);
    $pdf->Ln(10);
    $pdf->SetX(20);
    $pdf->Cell(150,5,'Patient ID     :   '.$pt_id.'',0,0);
    $pdf->SetX(100);
    $pdf->Cell(150,5,'Patient Name    :   '.$pname.'',0,0);
    // $pdf->Ln(10);
    // $pdf->SetX(20);
    // $pdf->Cell(150,5,'Patient Age   :   '.$age.'',0,0);
    // $pdf->SetX(100);
    // $pdf->Cell(150,5,'Patient Gender  :   '.$gender.'',0,0);
    // $pdf->Ln(10);

    // $pdf->SetFont('times','B',15);
    // $pdf->Cell(0,10,"Prescription",0,0,'C');
    $pdf->Ln(20);

    $pdf->SetFont('times','B',10);
    $pdf->SetX(19);
    $pdf->SetFillColor(224,235,255);
    $pdf->Cell(30,10,'Sr No. ',1,0,'C',1);
    $pdf->Cell(80,10,'Report Name',1,0,'C',1);
    $pdf->Cell(60,10,'Report Description',1,0,'C',1);
    $pdf->Ln(15);
    $pdf->SetFillColor(255,255,255);
    for($i=0;$i<count($object);$i++)
    {
        $pdf->SetFont('times','',12);
        $pdf->SetX(19);
        $pdf->Cell(30,5,$i+1,0,0,'C',1);
        $pdf->Cell(80,5,$object[$i][0],0,0,'C',1);
        $pdf->Cell(60,5,$object[$i][1],0,0,'C',1);
        $pdf->Ln(8);
    }

    $mail=new PHPMailer();
    $mail->HOST = 'smtp.gmail.com';
    $mail->SMTPAuth= true;
    $mail->SMTPSecure='ssl';
    $mail->Port=587;
    $mail->Username="team.medalexa@gmail.com";
    $mail->Password="Medalexa@162410";
    $mail->From="team.medalexa@gmail.com";
    $mail->FromName="Team Med-Alexa";
    $mail->addAddress($_SESSION['pt_email']);
    $mail->Subject="Report List From Med-Alexa";
    $mail->Body=" Dr. $dname has sent you report List, Please go through it";

    $doc=$pdf->Output('Report.pdf','S');
    $mail->AddStringAttachment($doc,'report.pdf','base64','application/pdf');
    if($mail->send())
    {
        // echo "<br>Successfull !";
    }
    else{
        echo "Error Occured : ".$mail->ErrorInfo;
    }
    $_SESSION['pt_email'] = "";
    $pt_id=$_SESSION['pt_id'];
    for($i=0;$i<count($object);$i++)
    {
        $var1=$object[$i][0];
        $var2=$object[$i][1];
        $sql = "INSERT INTO `pt_report` ( `pt_id`, `report`,`description`) VALUES ( '$pt_id' , '$var1' , '$var2')";
        if($con->query($sql)){

        }
        else
            $array['db'] = "error while inserting data";
    }
?>
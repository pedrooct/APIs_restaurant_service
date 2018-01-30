<?php
session_start();
require_once __DIR__ . "/../../vendor/autoload.php";

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class ICS {
    var $data;
    var $name;
    function ICS($start,$end,$name,$description,$location) {
        $this->name = $name;
        $this->data = "BEGIN:VCALENDAR\nVERSION:2.0\nMETHOD:PUBLISH\nBEGIN:VEVENT\nDTSTART:".date("Ymd\THis\Z",strtotime($start))."\nDTEND:".date("Ymd\THis\Z",strtotime($end))."\nLOCATION:".$location."\nTRANSP: OPAQUE\nSEQUENCE:0\nUID:\nDTSTAMP:".date("Ymd\THis\Z")."\nSUMMARY:".$name."\nDESCRIPTION:".$description."\nPRIORITY:1\nCLASS:PUBLIC\nBEGIN:VALARM\nTRIGGER:-PT10080M\nACTION:DISPLAY\nDESCRIPTION:Reminder\nEnd:VALARM\nEnd:VEVENT\nEnd:VCALENDAR\n";
    }
    function save() {
        file_put_contents($this->name.".ics",$this->data);
    }
    function show() {
        header("Content-type:text/calendar");
        header('Content-Disposition: attachment; filename="'.$this->name.'.ics"');
        Header('Content-Length: '.strlen($this->data));
        Header('Connection: close');
        echo $this->data;
    }
}

class Mail
{

  public function mail_send_reserva($nome,$email,$data,$hora,$qtd_pessoas,$rota)
  {
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    $re=file_get_contents('http://engprows.dev/obtain/id/'.$rota);
    $re=json_decode($re);
    try {
      //Server settings
      $mail->SMTPDebug = 0;                                 // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'labproaulas@gmail.com';                 // SMTP username
      $mail->Password = 'Labproaulas10';                           // SMTP password
      $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587;

      // TCP port to connect to
      //Recipients
      $mail->setFrom('labproaulas@gmail.com','Recover');
      $mail->addAddress($email,$nome);     // Add recipient
      $mail->setFrom('labproaulas@gmail.com','Reserva efetuada no '.$re[0]->nome);
      $mail->isHTML(false);                                  // Set email format to HTML
      $mail->Subject = 'Reserva';
      $mail->Body    = 'Acabou de efetuar uma reserva no restaurante '.$re[0]->nome.' na rua '.$re[0]->morada.' ,para o dia '.$data.' ,hora '.$hora.' , para '.$qtd_pessoas. ' pessoa/s.

      Que corra tudo bem!';

      $event = new ICS($data." ".$hora , $data , "Reserva no ".$re[0]->nome , "Reserva para ".$qtd_pessoas, $re[0]->morada);
      $event->save();
      $ics="Reserva no ".$re[0]->nome.".ics";
      $mail->addAttachment($ics);
      $mail->send();
      //echo 'Message has been sent';
    }
    catch (Exception $e)
    {
      echo $email.'Mailer Error:'. $mail->ErrorInfo;
    }
  }
}
?>

<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Classe para envio de email com o PHPMailer
 */
class Email {

    public function __construct(){
    }

    public function enviar($arrDe, $arrPara, $strAssunto, $strMensagem, $arrReplyTo = null, $arrAnexo = null){

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->SMTPDebug = 0;                                         //Enable verbose debug output
            $mail->isSMTP();                                              //Send using SMTP
            $mail->Host       = MAIL_HOST;                                //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                     //Enable SMTP authentication
            $mail->Username   = MAIL_USUARIO;                             //SMTP username
            $mail->Password   = MAIL_SENHA;                               //SMTP password
            $mail->CharSet    = "UTF-8";
            //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->SMTPSecure = MAIL_TIPO;
            $mail->Port       = MAIL_PORTA;                               //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //To load the Brazil version
            $mail->setLanguage('pt_br', PATH_SISTEMA.'core/PHPMailer/language/phpmailer.lang-pt_br.php');

            //Recipients
            if(!empty($arrDe[1])){
                $mail->setFrom($arrDe[0], $arrDe[1]);
            }else{
                $mail->setFrom($arrDe[0]);
            }

            foreach ($arrPara as $arrParaEmailNome){
                if(!empty($arrParaEmailNome[1])){
                    $mail->addAddress($arrParaEmailNome[0], $arrParaEmailNome[1]);
                }else{
                    $mail->addAddress($arrParaEmailNome[0]);
                }
            }

            if(is_array($arrReplyTo)){
                $mail->addReplyTo($arrReplyTo[0], $arrReplyTo[1]);
            }

            /*
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');
            */

            /*
            //Attachments
            $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            */
            if(is_array($arrAnexo)){
                foreach ($arrAnexo as $arrAnexoEmailNome){
                    $mail->addAttachment($arrAnexoEmailNome[0], $arrAnexoEmailNome[1]);
                }
            }

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $strAssunto;
            $mail->Body = $strMensagem;
            $mail->AltBody = $strMensagem;

            $mail->send();
            return 1;

        } catch (Exception $e) {
            echo "Não foi possível enviar a mensagem. Erro no mailer: {$mail->ErrorInfo}";
            Controller::debug($e);
            return 0;
        }

        /*
        EXEMPLO DE USO

        $arrDe = array('contato@xweb.com.br', 'Xweb - contato');
        $arrPara[] = array('jonathangibim@gmail.com', 'Jonathan G');
        $arrPara[] = array('jonathangibimborges@gmail.com', 'Jonathan GB');
        $arrReplyTo = array('suporte@xweb.com.br', 'Xweb - Suporte');
        $arrAnexo[] = array(PATH.'assets/img/logo-p.png', 'logo-preto.png');

        Controller::emailEnviar($arrDe, $arrPara, $strAssunto, $strMensagem, $arrReplyTo, $arrAnexo);

        */
    }
}
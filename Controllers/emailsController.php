<?php
class emailsController extends Controller {

    function enviar(){
        require(ROOT . 'Models/Cartorios.php');
        $cartorios= new Cartorios();
        $d['emails'] = $cartorios->selecionaEmails();
        $d['emailsAtivos'] = $cartorios->selecionaEmailsAtivos();
		if(isset($_POST['send'])) {
            // Create the Transport
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                            ->setUsername('vikinganoreg@gmail.com')
                            ->setPassword('wsqydqxzeulwwjcp');

            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);

            // Create a message
            $message = (new Swift_Message($_POST['assunto']))
                            ->setFrom(['vikinganoreg@gmail.com'])
                            ->setTo(explode(',',str_replace(' ', '', $_POST['para'])))
                            ->setBody($_POST['texto']);

            // Send the message
            $result = $mailer->send($message);
        }
        $this->set($d);
        $this->render('enviar');
    }
}
?>
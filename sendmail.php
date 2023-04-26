<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';
    function sendMail($email, $name, $body){
        $mail = new PHPMailer(true);
        try {
            // Try to create a new instance of PHPMailer class
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            // Personal data
            $mail->Host = 'ssl://smtp.gmail.com:465';
            $mail->Port = "465";
            $mail->Username = "phuonglannguyen963@gmail.com";
            $mail->Password = "hrzoxxkmhzcvmhoj";

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            // Sender
            $mail->setFrom('phuonglannguyen963@gmail.com', 'Dang ky tai khoan');
            // Recipient, the name can also be stated
            $mail->addAddress($email, $name);

            $mail->isHTML(true);
            // Subject : noi dung email gui
            $mail->Subject = 'Dang ki tai khoan';
            // HTML content
            $mail->Body = $body;

            //gui di
            $mail-> send();

            return [
                'message' => 'Email da duoc gui',
                'status' => true,
            ];

        } catch (Exception $e) {
            return [
                'message' => 'Email khong gui dc '.$mail->ErrorInfo,
                'status' => false,
            ];

            //echo "Mailer Error: ".$mail->ErrorInfo;
        }
}
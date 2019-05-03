<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function mailto($to,$title,$content){
	$mail = new PHPMailer(true);

	try {
		//Server settings
		$mail->SMTPDebug = 0;                                       // Enable verbose debug output
		$mail->isSMTP();                                            // Set mailer to use SMTP
		$mail->Host       = 'smtp.163.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = 'hanzttech@163.com';                     // SMTP username
		$mail->Password   = '1990h10z12t';                               // SMTP password
		$mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
		$mail->Port       = 587;                                    // TCP port to connect to
        $mail->CharSet = 'UTF-8';
	
		//Recipients
		$mail->setFrom('hanzttech@163.com','hzt');
		$mail->addAddress($to);
	
	
		// Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $title;
		$mail->Body    = $content;
	
		return $mail->send();
		
	} catch (Exception $e) {
		// echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		exception($mail->ErrorInfo,1001);
	}
}

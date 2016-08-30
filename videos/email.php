<?php
require_once("class.phpmailer.php");

    function SendUserWelcomeEmail(&$user_rec)
    {
        $mailer = new PHPMailer();

        $mailer->CharSet = 'utf-8';

        $mailer->AddAddress($user_rec['email'],$user_rec['username']);

        $mailer->Subject = "Welcome to ".MS_WEBNAME;

        $mailer->From = MS_FROM_EMAIL;

        $mailer->Body ="Hello ".$user_rec['username']."\r\n\r\n".
        "Welcome! Your registration  with ".MS_WEBNAME." is completed.\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        MS_WEBNAME;

        if(!$mailer->Send())
        {
            HandleError("Failed sending user welcome email.");
            return false;
        }
        return true;
    }

    function SendAdminRegCompleteEmail(&$user_rec)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();

        $mailer->CharSet = 'utf-8';

        $mailer->AddAddress(MS_ADMIN_EMAIL);

        $mailer->Subject = "Registration Completed: ".$user_rec['username'];

        $mailer->From = MS_FROM_EMAIL;

        $mailer->Body ="A new user registered at ".MS_WEBNAME."\r\n".
        "Name: ".$user_rec['username']."\r\n".
        "Email address: ".$user_rec['email']."\r\n";

        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }

    function SendUserConfirmationEmail($formvars)
    {
        $mailer = new PHPMailer();

        $mailer->CharSet = 'utf-8';

        $mailer->AddAddress($formvars['email'],$formvars['username']);

        $mailer->Subject = "Your registration with ".MS_WEBNAME;

        $mailer->From = MS_FROM_EMAIL;

        $confirmcode = $formvars['confirmcode'];

        $confirm_url = GetAbsoluteURLFolder().'/confirmreg.php?code='.$confirmcode;

        $mailer->Body ="Hi ".$formvars['username']."\r\n\r\n".
        "Thank you for registering at Mega Electronic Fest.  You are now a valuable member of MEF nation.  It is in appreciation of your loyalty to this Mega event in Puerto Rico that we reward you with a special discount code to purchase your PR MEF Week tickets through Ticketpop.com.  This discount code is only available to MEF Facebook registered fans.\r\n\n".
        "Your discount code is:  PR MEF Week"."\n\n"."Your code entitles you to purchase a maximum of (2) Two tickets through Ticketpop.com of any of the price ranges. The code is only valid for one purchase.  Please encourage all your friends that are attending PR MEF Week to go to www.megaelectronicfest.com to register.".
        "\r\n\n"."Visit Ticketpop right now to purchase your PR MEF Week tickets.
Click here: www.ticketpop.com \r\n\n Offer is only valid January 22, 2012 at 10am to January 25, 2012 11:59pm \r\n\n PR MEF Week promises to be the most amazing week of electronic music.  Do not miss out.  Continue to follow us on facebook.com/megaelectronicfest for the latest information. \r\n\n ".
        "Thank You, \r\n".
        "MEF Team \r\n";

        if(!$r=$mailer->Send())
        {
			echo $r;
            HandleError("Failed sending registration confirmation email.");
            return false;
        }
        return true;
    }

    function SendAdminRegisterEmail(&$formvars)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();

        $mailer->CharSet = 'utf-8';

        $mailer->AddAddress(MS_ADMIN_EMAIL);

        $mailer->Subject = "New registration: ".$formvars['username'];

        $mailer->From = $this->GetFromAddress();

        $mailer->Body ="A new user registered at ".MS_WEBNAME."\r\n".
        "Name: ".$formvars['username']."\r\n".
        "Email address: ".$formvars['email'];

        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }

?>
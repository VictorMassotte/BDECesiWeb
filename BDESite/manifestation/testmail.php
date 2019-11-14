<?php
$headers = 'From: projet.webcesi92@gmail.com' ."\r\n".
            'MIME-Version: 1.0' ."\r\n".
            'Content-type: text/html; charset=utf-8';

 mail("quentin.butel@viacesi.fr", "hello world","this is body", $headers);

?>
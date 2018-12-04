<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $subject ?></title>
    </head>
    <body>        
        <h1>Dear, Management</h1>
        <p>subject: <?= $subject ?></p>
        <p>leave reason: <?= $leave_reason ?></p>
        <p>leave type: <?= $leave_type ?></p>

        <p>I humbly request to you that I need leave on <?= $from_date ?> to <?= $to_date ?>.</p>
        <p>because <?= $text ?></p>
        <p>Please allow me a leave. I would be very thank full to you for this act of compassion.</p>
        <hr>
        <p>Thanks & regards</p>
        <p><?= $user_name ?></p>
    </body>
</html>

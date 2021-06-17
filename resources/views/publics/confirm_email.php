<?php 
if (isset($user)) {

?>
<h1>
    You have received payment confirm email.
</h1>

<span>
    Hi <?= $user->name?>!<br><br>
    You have just successfully paied our Bogars shopping site.<br>
    Thanks for your join in us. <br>
    We will send you the shopping things soon. <br>
    Thanks for your consideration. <br><br>

    Best regards.<br>
    Bogars Support Team.<br>
</span>
<?php
} else {
?>
<h1>
    There is no user to send.
</h1>
<?php
}
?>
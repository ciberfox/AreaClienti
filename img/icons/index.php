<?php
session_start(); // avvio sessione
foreach ($_POST as $key => $value) {
 $_SESSION['post'][$key] = $value;
}
if(isset($_SERVER['HTTP_REFERER']))
    header('Location: ' . $_SERVER['HTTP_REFERER']);
else
    header("location:javascript://history.back()");

?>
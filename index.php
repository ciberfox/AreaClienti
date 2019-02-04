<?php
/**
 * Area Clienti
 * Aggiornato il 04.02.2019
 * Basato su https://github.com/devplanete/php-login-advanced
 * @license http://opensource.org/licenses/MIT MIT License
 */

if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
   
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
   
    exit;
}

require_once("PHPLogin.php");
$login = new PHPLogin();

include('views/_header.php');


if (isset($_GET['register']) && ! $login->isRegistrationSuccessful() && 
   (ALLOW_USER_REGISTRATION || (ALLOW_ADMIN_TO_REGISTER_NEW_USER && $_SESSION['user_access_level'] == 255))) {
    include('views/register.php');


} else if (isset($_GET['password_reset']) && ! $login->isPasswordResetSuccessful()) {
    if (isset($_REQUEST['user_name']) && isset($_REQUEST['verification_code']) && $login->isPasswordResetLinkValid()) {

        include("views/password_reset.php");
    } else {
        include('views/password_reset_request.php');
    }


} else if (isset($_GET['edit']) && $login->isUserLoggedIn()) {
    include('views/edit.php');


} else if ($login->isUserLoggedIn()) {
    include('views/logged_in.php');


} else {
    include('views/login.php');
}

include('views/_footer.php');

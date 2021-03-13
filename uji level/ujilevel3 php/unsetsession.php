<?php
session_start();
if (isset($_GET['session']) && isset($_SESSION[$_GET['session']])) {
    unset($_SESSION[$_GET['session']]);
}

<?php
session_start();
if (isset($_GET['session'])) {
    (isset($_SESSION[$_GET['session']]) && $_SESSION[$_GET['session']] > 1) ?
        $_SESSION[$_GET['session']]-- :
        $_SESSION[$_GET['session']] = 1;
}

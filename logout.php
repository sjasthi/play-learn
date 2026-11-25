<?php
require_once __DIR__ . '/includes/auth.php';
$lang = current_lang();
$_SESSION = [];
session_destroy();
session_start();
$_SESSION['lang'] = $lang;   // keep the same language on the login page
flash('You have been logged out.', 'info');
redirect('login.php');

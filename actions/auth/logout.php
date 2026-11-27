<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../middleware/auth.php';

sessionStart();
$_SESSION = [];
session_destroy();
redirect('/index.php');

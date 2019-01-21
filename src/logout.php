<?php

/*
 * Password-Manager
 * An online keepass-like tool with client-side AES encryption.
 * https://github.com/zeruniverse/Password-Manager
 *
 * Copyright by Jeffery Zhao and Benjamin Häublein.
 * Licensed under The MIT License (MIT), see file LICENSE.
 */

require_once 'function/sqllink.php';
session_start();
invalidateSession();
$reason = '';
if (isset($_GET['reason'])) {
    $reason = '?reason=' . urlencode($_GET['reason']);
}
header('Location: ./' . $reason);

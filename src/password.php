<?php

/*
 * Password-Manager
 * An online keepass-like tool with client-side AES encryption.
 * https://github.com/zeruniverse/Password-Manager
 *
 * Copyright by Jeffery Zhao and Benjamin Häublein.
 * Licensed under The MIT License (MIT), see file LICENSE.
 */

require_once 'Classes/View.php';
$view = new \PasswordManager\View();
echo $view->renderPage('password');

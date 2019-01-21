<?php
namespace PasswordManager;

/*
 * Password-Manager
 * An online keepass-like tool with client-side AES encryption.
 * https://github.com/zeruniverse/Password-Manager
 *
 * Copyright by Jeffery Zhao and Benjamin Häublein.
 * Licensed under The MIT License (MIT), see file LICENSE.
 */

class View
{
    /**
     * Instruct clients to expire page after this number of seconds.
     *
     * @access private
     * @var int
     */
    private $expires = 86400;

    /**
     * Path to template files, relative to DocumentRoot.
     *
     * @access private
     * @var string
     */
    private $templatePath = 'Resources/Templates/';

    /**
     * Send HTTP headers and render entire page with HTML header, body and footer part.
     *
     *
     * @access public
     */
    public function renderPage($template = null)
    {
        // Send HTTP headers
        $this->getHttpHeaders();
        // Render page parts
        return
            $this->getPageHeader() .
            $this->getPageBody($template) .
            $this->getPageFooter();
    }

    /**
     * Send HTTP headers.
     *
     * @access public
     * @return void
     */
    public function getHttpHeaders()
    {
        header('X-Frame-Options: DENY');
        header("Content-Security-Policy: default-src 'self';");
        header('Pragma: public');
        header('Cache-Control: max-age=' . $this->expires . ', must-revalidate');
        header('Expires: '.gmdate('D, d M Y H:i:s', time() + $this->expires).' GMT');
    }

    /**
     * Returns the header part of the HTML page.
     *
     * @access public
     * @return string
     */
    public function getPageHeader()
    {
        return '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Password Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Password Manager">
    <meta name="author" content="Jeffery">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="js/lib/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="favicon.ico">
    <script src="js/lib/jquery.min.js"></script>
    <script src="js/lib/bootstrap.min.js"></script>
    <script src="js/common/commonFunctions.js"></script>
</head>
<body>';
    }

    /**
     * Returns the body part of the HTML page.
     *
     * @access public
     * @param string Template name
     * @return string HTML body part (string). Can be empty if an error occurred.
     */
    public function getPageBody($template = null)
    {
        $body = false;
        // Determine sanitized template path and file name
        $file = $this->templatePath . '/' . preg_replace('/[^a-z]/', '', $template) . '.html';
        if (is_readable($file)) {
            $body = file_get_contents($file);
        }
        return (is_string($body) ? $body : '');
    }

    /**
     * Returns the footer part of the HTML page.
     *
     * @access public
     * @return string
     */
    public function getPageFooter()
    {
        return '
<footer class="footer">
<p>&copy;2015 Jeffery<br /><br />ALL RIGHTS RESERVED</p>
</footer>
</body>
</html>';
    }
}

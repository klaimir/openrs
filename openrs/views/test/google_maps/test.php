<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Google Maps</title>
        <style type="text/css" rel="stylesheet">
            html, body {font-family:sans-serif;}
            h2 a {text-decoration: none; color: #009900; font-size: 14px;}
            pre {font-size: 10px; background-color: #f9f9f9; border:1px solid #4F5155; padding: 10px; display:none;}
        </style>
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <?php echo $map['js']; ?>
    </head>
    <body>
        <div id="container">
            <h1>Welcome to Google Maps</h1>

            <div id="body">
                <?php echo $map['html']; ?>
            </div>
        </div>
    </body>
</html>
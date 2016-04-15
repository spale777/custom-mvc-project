<?php
$host = 'http://' . $_SERVER['HTTP_HOST'];

$doc_root = $_SERVER['DOCUMENT_ROOT'];

$dir =
    dirname($_SERVER['SCRIPT_NAME']) == '\\' ||
    dirname($_SERVER['SCRIPT_NAME']) == '/' ? '' : dirname($_SERVER['SCRIPT_NAME']);

define ('URI', $host . $dir);
define ('ROOT', $doc_root . $dir );

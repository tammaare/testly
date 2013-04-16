<?php

require'config.php';

require 'classes/Request.php';

if(file_exists('controllers/'.$request->controller.`.php))
{
require 'controllers/'.$request->controller.'php';
$controller = new $request->controller;
if (isset(
?>
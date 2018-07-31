<?php

include_once 'Users.php';

$test = new Users;
echo"<pre>";
$get = $test->create_user('alex','azerty','alex@alex.com');
//$get=$test->get_task(2);
var_dump($get);
echo"</pre>";
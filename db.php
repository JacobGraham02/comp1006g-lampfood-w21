<?php
// aws
$db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', '');

// local
//$db = new PDO('mysql:host=localhost;dbname=Rich100', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
// file name
$name = $_FILES['myFile']['name'];
echo "Name: $name<br />";

$size = $_FILES['myFile']['size'];
echo "Size: $size<br />"; // size is in bytes: 1024 bytes = 1 kb

$tmp_name = $_FILES['myFile']['tmp_name'];
echo "Tmp Name: $tmp_name<br />";

//$type = $_FILES['myFile']['type'];  type only checks the extension NOT the actual file type
$type = mime_content_type($tmp_name);
echo "Type: $type<br />";

// save a copy to the uploads folder.  overwrites existing file w/same name
session_start();
$name = session_id() . "-$name"; // prefix the file name w/the session Id
move_uploaded_file($tmp_name, "uploads/$name");

?>

</body>
</html>

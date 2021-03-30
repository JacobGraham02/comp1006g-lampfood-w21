<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <form method="post" action="process-upload-test.php" enctype="multipart/form-data">
        <fieldset>
            <label for="myFile">Choose a File</label>
            <input name="myFile" id="myFile" type="file" accept=".gif,.jpg,.jpeg,.png,.doc,.docx" />
        </fieldset>
        <button>Upload Now</button>
    </form>
</body>
</html>

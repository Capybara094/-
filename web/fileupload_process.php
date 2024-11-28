<?php

move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $_FILES["fileToUpload"]["name"]);

header('location:fileupload.php');

?>
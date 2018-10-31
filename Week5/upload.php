<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Upload File</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <style type="text/css">
            body {
                background-image: linear-gradient(bisque, white);
                background-attachment: fixed;
                width: 75%;
                margin: 0px auto;
            }
            form {
                width: 30%;
                margin: 0px auto;
            }
            input {
                margin-top: 20px;
            }
            h1 {
                padding-top: 100px;
            }
        </style>
    </head>
    <body>
        <?php
            include './functions.php';

            if ($_SESSION["User"] != null)
            {
                if (isPostRequest())
                {
                    if (isset($_FILES['file1'])) {
                        $db = getDatabase();
                        
                        $db->query("DELETE FROM schools");
                        
                        $tmp_name = $_FILES['file1']['tmp_name'];
                        $path = getcwd() .DIRECTORY_SEPARATOR . 'uploads';
                        $new_name = $path . DIRECTORY_SEPARATOR . $_FILES['file1']['name'];
                        move_uploaded_file($tmp_name, $new_name);
                        
                        
                        $stmt = $db->prepare("INSERT INTO schools (school, city, state) VALUES (:school, :city, :state)");
                        
                        $file = fopen ($new_name, 'rb');
                        while (!feof($file)) {
                           $school = fgetcsv($file);
                           
                           $binds = array(
                            ":school" => $school[0],
                            ":city" => $school[1],
                            ":state" => $school[2]
                           );
                           
                           $stmt->execute($binds);
                        }
                        
                        header('Location: search.php');
                    }
                }
            } else {
                header('Location: login.php');
            }
        ?>
        <center><h1>Upload File</h1></center><br>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="file1">
                <label class="custom-file-label" for="customFile" id="fileLabel">Choose file</label>
            </div>
            <br /><br /><center><input type="submit" value="Upload File" class="btn btn-primary" /></center>
        </form>
        <script type="text/Javascript">
            var fileInput = document.getElementById('customFile');
            
            fileInput.addEventListener('change', changeName);
            
            function changeName(e) {
                
                var fileLabel = document.getElementById('fileLabel')
                fileLabel.innerHTML = fileInput.files[0].name;
                
           }
        </script>
    </body>
</html>

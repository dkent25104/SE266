<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
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
        
            if (isPostRequest())
            {
                if (isset($_POST['uname']) && isset($_POST['pword']) && $_POST['uname'] != "" && $_POST['pword'] != "") {
                    $result = "";
                    $user = IsValidUser(filter_input(INPUT_POST, 'uname'), sha1(filter_input(INPUT_POST, 'pword')));
                    if ($user == true) {
                        $_SESSION["User"] = filter_input(INPUT_POST, 'uname');
                        header('Location: upload.php');
                    } else {
                        $result = "Invalid username or password";
                    }
                } else {
                    $result = "Please enter a username and password";
                }
            }
        
        ?>
        <center><h1>Please Log In</h1></center><br>
        <form action="#" method="post" id="login">
            <input type="text" name="uname" class="form-control" />
            <input type="password" name="pword" class="form-control" />
            <center><input type="submit" name="login" value="Log In" class="btn btn-primary" /></center>
        </form>
        <br /><center><h3><?php if (isPostRequest()) {echo $result;} ?></h3></center>
    </body>
</html>

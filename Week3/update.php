<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>
    <body>
        <a href="crud.php"><input type="button" class="btn btn-success" value="View Corporations"></a><br />
        <?php
        include './dbconnect.php';
        include './functions.php';
        
        $feedback = '';
        $results = '';
        
        if (isPostRequest()) {
            if (isset($_POST['corp']) && isset($_POST['email']) && isset($_POST['zipcode']) && isset($_POST['owner']) && isset($_POST['phone'])) {
                $db = getDatabase();
                $id = filter_input(INPUT_GET, 'id');
                $stmt = $db->prepare("UPDATE corps SET corp = :corp, email = :email, zipcode = :zipcode, owner = :owner, phone = :phone where id = :id");

                $corp = filter_input(INPUT_POST, 'corp');
                $email = filter_input(INPUT_POST, 'email');
                $zipcode = filter_input(INPUT_POST, 'zipcode');
                $owner = filter_input(INPUT_POST, 'owner');
                $phone = filter_input(INPUT_POST, 'phone');

                $binds = array(
                    ":corp" => $corp,
                    ":email" => $email,
                    ":zipcode" => $zipcode,
                    ":owner" => $owner,
                    ":phone" => $phone,
                    ":id" => $id
                );

                /*
                 * empty()
                 * isset()
                 */

                if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                    $feedback = 'Corporation Updated';
                } else {
                    $feedback = 'Failed to Update Corporation';
                }
            } else {
                $feedback = 'Please fill in all fields';
            }
        } else {
            $db = getDatabase();
            $id = filter_input(INPUT_GET, 'id');
            $stmt = $db->prepare("SELECT * FROM corps where id = :id");
            $binds = array(
                ":id" => $id
            );
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
               $results = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            if ( !isset($id) ) {
                die('Record not found');
            }
            $corp = $results['corp'];
            $email = $results['email'];
            $zipcode = $results['zipcode'];
            $owner = $results['owner'];
            $phone = $results['phone'];
        }
        
        
        ?>

        <form method="post" action="#">            
            Corporation Name <input type="text" value="<?php echo $corp; ?>" name="corp" /><br />
            Email <input type="text" value="<?php echo $email; ?>" name="email" /><br />
            Zip Code <input type="text" value="<?php echo $zipcode; ?>" name="zipcode" /><br />
            Owner <input type="text" value="<?php echo $owner; ?>" name="owner" /><br />
            Phone Number <input type="text" value="<?php echo $phone; ?>" name="phone" /><br />
            <input type="submit" value="Submit" />
        </form>
        
        <h1><?php echo $feedback; ?></h1>
    </body>
</html>

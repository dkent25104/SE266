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
        
        if (isPostRequest()) {
            if (isset($_POST['corp']) && isset($_POST['email']) && isset($_POST['zipcode']) && isset($_POST['owner']) && isset($_POST['phone'])) {
                $db = getDatabase();

                $stmt = $db->prepare("INSERT INTO corps SET corp = :corp, incorp_dt = now(), email = :email, zipcode = :zipcode, owner = :owner, phone = :phone");

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
                    ":phone" => $phone
                );

                /*
                 * empty()
                 * isset()
                 */

                if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                    $feedback = 'Corporation Added';
                } else {
                    $feedback = 'Failed to Add Corporation';
                }
            } else {
                $feedback = 'Please fill in all fields';
            }
        }
        
        
        ?>
        
        <form method="post" action="#">            
            Corporation Name <input type="text" value="" name="corp" /><br />
            Email <input type="text" value="" name="email" /><br />
            Zip Code <input type="text" value="" name="zipcode" /><br />
            Owner <input type="text" value="" name="owner" /><br />
            Phone Number <input type="text" value="" name="phone" /><br />
            <input type="submit" value="Submit" class="btn btn-primary" />
        </form>
        
        <h1><?php echo $feedback; ?></h1>
    </body>
</html>

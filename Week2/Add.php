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
    </head>
    <body>
        <?php
        include './Actors.php';
        include './dbconnect.php';
        include './functions.php';

        $results = '';

        if (isPostRequest()) {
            $db = getDatabase();

            $stmt = $db->prepare("INSERT INTO actors SET firstname = :dataone, lastname = :datatwo, dob = :datathree, height = :datafour");

            $dataone = filter_input(INPUT_POST, 'firstname');
            $datatwo = filter_input(INPUT_POST, 'lastname');
            $datathree = filter_input(INPUT_POST, 'dob');
            $datafour = filter_input(INPUT_POST, 'height');

            $binds = array(
                ":dataone" => $dataone,
                ":datatwo" => $datatwo,
                ":datathree" => $datathree,
                ":datafour" => $datafour
            );

            /*
             * empty()
             * isset()
             */

            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $results = 'Data Added';
            }
        }
        ?>
        
        <form method="post" action="#">            
            First Name <input type="text" value="" name="firstname" />
            <br />
            Last Name <input type="text" value="" name="lastname" />
            <br />
            Date of Birth <input type="date" value="" name="dob" />
            <br />
            Height <input type="number" value="" name="height" />inches<br />
            <input type="submit" value="Submit" />
        </form>
        
        <h1><?php echo $results; ?></h1>
    </body>
</html>

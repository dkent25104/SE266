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
        
        $db = getDatabase();
        $id = filter_input(INPUT_GET, 'id');
        $stmt = $db->prepare("DELETE FROM corps where id = :id");

        $binds = array(
            ":id" => $id
        );
        
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $feedback = 'Record ' . $id . ' Deleted';
        } else {
            $feedback = 'Failed to Delete Record ' . $id;
        }
        
        ?>
        <h1><?php echo $feedback; ?></h1>
    </body>
</html>

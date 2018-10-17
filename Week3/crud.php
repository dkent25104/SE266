<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Corporations</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <style type="text/css">
            body {
                text-align: center;
                background-image: linear-gradient(bisque, white);
                background-attachment: fixed;
            }
            table {
                margin-top: 50px;
                text-align: left;
                margin: 0px auto;
                margin-top: 50px;
                margin-bottom: 50px;
            }
            tbody tr {
                border-top: 2px solid green;
            }
            td {
                padding: 5px;
            }
        </style>

    </head>
    <body>
        <h1>Corporations</h1><br />
        <a href="add.php"><input type="button" class="btn btn-success" value="Add Corporations"></a><br />
        <?php
        include './dbconnect.php';
        include './functions.php';

        $db = getDatabase();

        $stmt = $db->prepare("SELECT * FROM corps");

        $results = array();
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>Corporation Name</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?php echo $row['corp']; ?></td>
                    <td><a href="read.php?id=<?php echo $row['id']; ?>"><input type="button" class="btn btn-primary" value="Read"></a></td>
                    <td><a href="update.php?id=<?php echo $row['id']; ?>"><input type="button" class="btn btn-warning" value="Update"></a></td>
                    <td><a href="delete.php?id=<?php echo $row['id']; ?>"><input type="button" class="btn btn-danger" value="Delete"></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <a href=""><input type="button" class="btn btn-success" value="Back to Top"></a><br /><br/><br/>
    </body>
</html>

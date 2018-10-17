<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Read Corporations</title>
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
                padding: 20px 35px 0px 0px;
            }
        </style>
    </head>
    <body>
        <h1>Read Corporations</h1><br/>
        <a href="crud.php"><input type="button" class="btn btn-success" value="View Corporations"></a><br />
        <?php
        include './dbconnect.php';
        include './functions.php';

        $db = getDatabase();
        
        $id = filter_input(INPUT_GET, 'id');
        $stmt = $db->prepare("SELECT * FROM corps where id = :id");

        $binds = array(
                    ":id" => $id
        );

        $results = array();
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>Corporation Name</th>
                    <th>Incorporation Date</th>
                    <th>Email</th>
                    <th>Zip Code</th>
                    <th>Owner</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row): ?>
                <tr>
                    <td><?php echo $row['corp']; ?></td>
                    <td><?php echo $row['incorp_dt']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['zipcode']; ?></td>
                    <td><?php echo $row['owner']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>

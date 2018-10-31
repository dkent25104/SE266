<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Search Schools</title>
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
                width: 50%;
                margin: 0px auto;
            }
            h1 {
                padding-top: 100px;
            }
            table {
                text-align: center;
                margin-top: 50px;
                text-align: left;
                margin: 0px auto;
                margin-bottom: 50px;
                table-layout: fixed;
            }
            tbody tr {
                border-top: 2px solid royalblue;
            }
            td {
                padding: 5px;
            }
            .short {
                width: 200px;
            }
            .long {
                width: 800px;
            }
            .reallyshort {
                width: 75px;
            }
        </style>
    </head>
    <body>
        <?php
            include './functions.php';

            if ($_SESSION["User"] != null)
            {
                $school = filter_input(INPUT_POST, 'school');
                $city = filter_input(INPUT_POST, 'city');
                $state = filter_input(INPUT_POST, 'state');

                $results = searchData($school, $city, $state);
                
            } else {
                header('Location: login.php');
            }
        ?>
        <center><h1>Search Schools</h1></center><br>
        <form action="#" method="post" >
            <div class="form-group row">
                <label for="searchName" class="col-sm-2 col-form-label">School:</label>
                <div class="col-sm-10">
                  <input type="text" name="school" class="form-control" id="searchName">
                </div>
            </div>
            <div class="form-group row">
                <label for="searchCity" class="col-sm-2 col-form-label">City:</label>
                <div class="col-sm-10">
                  <input type="text" name="city" class="form-control" id="searchCity">
                </div>
            </div>
            <div class="form-group row">
                <label for="searchState" class="col-sm-2 col-form-label">State:</label>
                <div class="col-sm-10">
                  <input type="text" name="state" class="form-control" id="searchState">
                </div>
            </div>
            <br /><center><input type="submit" name="search" value="Search" class="btn btn-primary" /></center>
        </form><br/><br/>
        
        <table>
            <thead>
                <tr>
                    <th>Institution Name</th>
                    <th>City</th>
                    <th>State</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td class="long"><?php echo $row['school']; ?></td>
                    <td class="short"><?php echo $row['city']; ?></td>
                    <td class="reallyshort"><?php echo $row['state']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <center><a href=""><input type="button" class="btn btn-success" value="Back to Top"></a></center><br /><br/><br/>
    </body>
</html>

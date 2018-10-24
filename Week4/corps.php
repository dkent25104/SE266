<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Corporations</title>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        
        <style type="text/css">
            body {
                background-image: linear-gradient(goldenrod, white);
                background-attachment: fixed;
                width: 75%;
                margin: 0px auto;
            }
            form {
                width: 20%;
            }
            .forminput {
                height: 150px;
            }
            form legend {
                border-bottom: 2px solid royalblue;
            }
            .form-control {
                width: 125px;
            }
            #sort {
                float: left;
                margin: 5% 5% 0% 25%;
            }
            #search {
                float: right;
                margin: 5% 25% 0% 5%;
            }
            table {
                text-align: center;
                margin-top: 50px;
                text-align: left;
                margin: 0px auto;
                margin-top: 425px;
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
                width: 500px;
            }
        </style>
    </head>
    <body>
        <br /><center><h1>Corporation Search</h1></center>
        <?php
        
        include "./functions.php";
        include "./sort.php";
        include "./keyword.php";
        
        $results = getAllData();
        
        if (isGetRequest()) {
            $action = filter_input(INPUT_GET, 'action');
            if (filter_input(INPUT_GET, 'reset')) {
                $results = getAllData();
            }
            else if ($action == "sort") {
                $results = sortData(filter_input(INPUT_GET, 'column'), filter_input(INPUT_GET, 'order'));
            } else if ($action == "search") {
                $results = searchData(filter_input(INPUT_GET, 'column'), filter_input(INPUT_GET, 'keyword'));
            }
            else {
                
            }
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
                    <td class="long"><?php echo $row['corp']; ?></td>
                    <td class="short"><?php echo date("m-d-Y", strtotime($row['incorp_dt'])); ?></td>
                    <td class="long"><?php echo $row['email']; ?></td>
                    <td class="short"><?php echo $row['zipcode']; ?></td>
                    <td class="short"><?php echo $row['owner']; ?></td>
                    <td class="short"><?php echo $row['phone']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <center><a href=""><input type="button" class="btn btn-success" value="Back to Top"></a></center><br /><br/><br/>
    </body>
</html>

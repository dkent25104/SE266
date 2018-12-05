<?php
    //starts session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Country Populations</title>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <style type="text/css"> 
            body {
                background-color: cornflowerblue;
            }
            nav ul li {
                text-decoration: none;
                display: inline;
                padding: 20px;
            }
            #main {
                width: 80%;
                margin: 0px auto;
                background-color: white;
                padding: 5%;
                min-height: 90vh;
            }
            hr {
                border-width: 3px;
                background-color: black;
            }
        </style>
    </head>
    <body>
        <?php
            include './functions.php';
        
            $table = getTopTen();
            
            
            
            include './header.php';
        ?>
        
        <div id='main'>
            <h1>Top 10 Countries by Population</h1><hr><br />
            
            <table class="table table-sm table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Country</th>
                        <th>Region</th>
                        <th>Population (thousands)</th>
                        <th>Size (square miles)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($table as $row): ?>
                        <tr>
                            <td><a href="edit.php?id=<?php echo $row['CountryDetailID']; ?>"><?php echo $row['CountryName']; ?></a></td>
                            <td><?php echo $row['CountryRegion']; ?></td>
                            <td><?php echo $row['CountryPopulation']; ?></td>
                            <td><?php echo $row['CountrySize']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        
        <?php
            include './footer.php';
        ?>
    </body>
</html>
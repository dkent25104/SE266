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
            form {
                width: 30%;
                margin: 0px auto;
            }
            table {
                margin-bottom: 100px;
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
        
            $regions = regionList();
            $table = '';
            $name = '';
            $region = '';
            
            if (isPostRequest()) {
                $name = filter_input(INPUT_POST, 'name');
                $region = filter_input(INPUT_POST, 'region');
                $_SESSION['name'] = $name;
                $_SESSION['region'] = $region;

                $table = searchCountries($name, $region);
            }
            
            include './header.php';
        ?>
        
        <div id='main'>
            <h1>Search Countries</h1><hr><br />
            
            <form method="post" action="#">
                <div class="form-group">
                    <label for="name">Country Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?php
                    if(!isPostRequest() && isset($_SESSION['name'])) { echo $_SESSION['name']; }
                    else { echo $name; }
                ?>" />
                </div>
                <div class="form-group">
                    <label for="region">Region:</label>
                    <select class="form-control" name="region" id="region">
                        <option></option>
                        <?php foreach ($regions as $r): ?>
                            <option <?php
                                if (!isPostRequest() && isset($_SESSION['region']) && ($r['CountryRegion'] ==  $_SESSION['region'])) { echo 'selected="selected"'; }
                                else { if($region == $r['CountryRegion']) { echo 'selected="selected"'; } }
                            ?>><?php echo $r['CountryRegion']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <center><input type="submit" class="btn btn-primary" value="Search" /></center>
            </form>

            <?php if($table != ''): ?>
                <br /><h1>Results</h1><br />
                
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
                                <td><?php echo $row['CountryName']; ?></td>
                                <td><?php echo $row['CountryRegion']; ?></td>
                                <td><?php echo $row['CountryPopulation']; ?></td>
                                <td><?php echo $row['CountrySize']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        
        <?php
            include './footer.php';
        ?>
    </body>
</html>

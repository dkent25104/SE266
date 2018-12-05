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
                width: 50%;
                margin: 0px auto;
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
            
            $countryId = filter_input(INPUT_GET, 'id');
            $country = '';
            $name = '';
            $region = '';
            $population = '';
            $size = '';
            $feedback = '';
            
            if(isPostRequest()) {
                if (isset($_POST['name']) && isset($_POST['region']) && isset($_POST['population']) && isset($_POST['size'])) {
                $name = filter_input(INPUT_POST, 'name');
                $region = filter_input(INPUT_POST, 'region');
                $population = filter_input(INPUT_POST, 'population');
                $size = filter_input(INPUT_POST, 'size');
                $result = updateCountry($countryId, $population, $size);
                if ($result == true) { $feedback = 'Successfully updated record'; }
                else { $feedback = 'Failed to update record'; }
                }
            } else {
                $country = getOneCountry($countryId);

                $name = $country[0]['CountryName'];
                $region = $country[0]['CountryRegion'];
                $population = $country[0]['CountryPopulation'];
                $size = $country[0]['CountrySize'];
            }
            
            include './header.php';
        ?>
        
        <div id='main'>
            <h1>Edit Country</h1><hr><br />
            
            <form method="post" action="#">
                <div class="form-group">
                    <label for="name">Country Name:</label>
                    <input type="text" name="name" id="name" class="form-control" readonly="true" value="<?php echo $name ?>" />
                </div>
                <div class="form-group">
                    <label for="region">Region:</label>
                    <input type="text" name="region" id="region" class="form-control" readonly="true" value="<?php echo $region; ?>" />
                </div>
                <div class="form-group">
                    <label for="population">Population (thousands):</label>
                    <input type="text" name="population" id="population" class="form-control" value="<?php echo $population; ?>" />
                </div>
                <div class="form-group">
                    <label for="size">Size (square miles):</label>
                    <input type="text" name="size" id="size" class="form-control" value="<?php echo $size; ?>" />
                </div>
                <center><input type="submit" class="btn btn-primary" value="Edit" /></center>
            </form><br />

            <center><h4><?php echo $feedback; ?></h4></center>
        </div>
        
        <?php
            include './footer.php';
        ?>
    </body>
</html>

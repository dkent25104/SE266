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
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        
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
            #table {
                float: left;
                width: 45%;
            }
            .chart {
                width: 45%;
                float: right;
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
        
            $table = getRegion();
            
            
            
            include './header.php';
        ?>
        
        <div id='main'>
            <h1>Population by Region</h1><hr><br />
            
            <div id="table">
                <table class="table table-sm table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Region</th>
                            <th>Population (thousands)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($table as $row): ?>
                            <tr>
                                <td><?php echo $row['CountryRegion']; ?></td>
                                <td><?php echo $row['population']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        
            <div class="chart">
                
                <canvas id="myChart"></canvas>
            </div>
        </div>
        
        <?php
            include './footer.php';
        ?>
        <script>
        $(document).ready(function () {

            $.get ("chart.php", function (data) {
               regions = JSON.parse (data);

               new Chart(document.getElementById("myChart"), {
                type: 'pie',
                data: {
                  labels: regions[0],
                  datasets: [{
                    label: "Population (thousands)",
                    backgroundColor: regions[2],
                    data: regions[1]
                  }]
                },
                options: {
                  title: {
                    display: true,
                    text: 'Population in thousands'
                  }
                }
                });
            });
        })
    </script>
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Disney Votes</title>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        
        <style type="text/css">
            html {
                background: #ffe4c4; /* Old browsers */
                background: -moz-linear-gradient(left, #ffe4c4 0%, #ffffff 33%, #ffffff 66%, #ffe4c4 100%); /* FF3.6-15 */
                background: -webkit-linear-gradient(left, #ffe4c4 0%,#ffffff 33%,#ffffff 66%,#ffe4c4 100%); /* Chrome10-25,Safari5.1-6 */
                background: linear-gradient(to right, #ffe4c4 0%,#ffffff 33%,#ffffff 66%,#ffe4c4 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffe4c4', endColorstr='#ffe4c4',GradientType=1 ); /* IE6-9 */
            }
            body {
                width: 50%;
                margin: 0px auto;
                background-color: transparent;
            }
            h1 {
                padding: 25px;
            }
            table {
                text-align: center;
                margin: 0px auto;
                border: 10px solid black;
            }
            table img {
                width: 200px;
            }
            table th {
                font-size: 30px;
            }
            table td {
                padding: 20px;
                margin: 0px 5px 0px 5px;
            }
            .chart {
                margin: 0px auto;
                width: 500px;
                margin-top: 25px;
            }
            .idx1 {
                background-color: #000f89;
                color: white;
            }
            .idx2 {
                background-color: #e32636;
                color: white;
            }
            .idx3 {
                background-color: #e3a857;
                color: white;
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
        
            $characters = selectCharacters();
        ?> 
        
        <center><h1>Disney Character Voting</h1></center>

        <table>
            <tr>
                <?php foreach ($characters as $char): ?>
                    <th class="idx<?php echo $char['DisneyCharacterID']; ?>"><?php echo $char['DisneyCharacterName']; ?></th>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($characters as $char): ?>
                    <td class="idx<?php echo $char['DisneyCharacterID']; ?>"><img src="images/<?php echo $char['DisneyCharacterImage']; ?>"></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($characters as $char): ?>
                    <td class="idx<?php echo $char['DisneyCharacterID']; ?>"><input type="button" data-index="<?php echo $char['DisneyCharacterID']; ?>" class="btn btn-primary" value="&nbsp;&raquo;&nbsp;&nbsp;&nbsp;VOTE&nbsp;&nbsp;&nbsp;&laquo;&nbsp;"></td>
                <?php endforeach; ?>
            </tr>
        </table><br /><hr>

        <div class="chart">
            <center><h2>Vote Standings</h2></center>
            <canvas id="myChart" width="400" height="200" style="display: block; width: 400px; height: 200px;"></canvas>
        </div>
        
        <script type="text/javascript">
            function displayChart(e) {
                $.get("vote.php", function(data) {
                    votes = JSON.parse(data);
                    //console.log(data);

                    new Chart(document.getElementById("myChart"), {
                        type: 'bar',
                        data: {
                            labels: votes[0],
                            datasets: [{
                                label: "Number of Votes",
                                backgroundColor: ["#000f89", "#e32636", "#e3a857"],
                                data: votes[1],
                                borderWidth: 10
                            }]
                        },
                        options: {
                            legend: { display: false },
                            title: {
                                display: true,
                                text: 'Number of votes per character'
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });
                });
            }
            $(document).ready(function() {
                displayChart();
                $(":button").click( function(e) {
                    //alert(this.getAttribute('data-index'));
                    $.post("vote.php", {id:this.getAttribute('data-index')}, function(data) {
                        JSON.parse(data);
                        //alert(data);
                        displayChart();
                    });
                });
            });
        </script>
    </body>
</html>
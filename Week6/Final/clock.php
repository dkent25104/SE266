<?php
    //starts session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Timecard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <style type="text/css">
            body {
                background-image: linear-gradient(firebrick, bisque);
                background-attachment: fixed;
                width: 75%;
                margin: 0px auto;
            }
            h1 {
                padding-top: 100px;
                padding-bottom: 50px;
                color: white;
            }
            #searchDiv {
                width: 450px;
                margin: 0px auto;
            }
            table {
                text-align: center;
                text-align: left;
                margin: 0px auto;
                margin-bottom: 50px;
                margin-top: 100px;
                table-layout: fixed;
            }
            tbody tr {
                border-top: 2px solid royalblue;
            }
            td {
                padding: 5px;
            }
            .short {
                width: 150px;
            }
            .long {
                width: 400px;
            }
            .medium {
                width: 250px;
            }
        </style>
    </head>
    <body>
        <?php
            include './functions.php';
            
            $table = getAllProjects();
            $results = '';
            $searchName = '';
            
            if (isPostRequest()) {
                if (isset($_POST['projectName']) && $_POST['projectName'] != "") {
                    $searchName = filter_input(INPUT_POST, 'projectName');
                    $table = searchProjects($searchName);
                    
                } else {
                    $results = "Please fill in search criteria";
                }
            } else if (isset($_GET['cin_id'])) {
                //check if other project not checked in, can only check in one project at a time
                if (checkWorking() == false)
                {
                    $id = filter_input(INPUT_GET, 'cin_id');
                    $clockInTime = getCurrentTime();
                    $_SESSION["clockInTime"] = $clockInTime;
                    
                    $results = clockIn($clockInTime, $id);
                    if ($results == true) { header('Location: clock.php'); }
                    
                } else {
                    $results = 'Only one project can be checked out at a time';
                }
            } else if (isset($_GET['cout_id'])) {
                $id = filter_input(INPUT_GET, 'cout_id');
                $clockInTime = $_SESSION["clockInTime"];
                $clockOutTime = getCurrentTime();
                $timeSpentWorking = timeSpent($clockInTime, $clockOutTime);
                
                $results = clockOut($timeSpentWorking, $id);
                if ($results == true) { header('Location: clock.php'); }
                
            }
            
        ?>
        
        <center>
            <h1>Project Manager</h1>
            <a href="timeCard.php"><input type="button" class="btn btn-success" value="Home"></a>
        </center><br /><br />
    
        <form method="post" action="#">
            <div class="form-inline" id="searchDiv">
                <label for="SearchProject">Search Project Name:</label>&nbsp;&nbsp;&nbsp;
                <input name="projectName" type="search" placeholder="Name...." class="form-control" id="SearchProject" />&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Search" class="btn btn-primary" />
            </div>
        </form>
        <center><br /><h4><?php echo $results; ?></h4></center>
        
        <table>
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Total Time Spent</th>
                    <th>Currently Working</th>
                    <th>Clock In Time</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($table as $row): ?>
                    <tr>
                        <td class="long"><?php echo $row['name']; ?></td>
                        <td class="short"><?php echo $row['totalTime']; ?> Minutes</td>
                        <td class="short"><?php
                            //displays true or false instead of 0 or 1
                            if ($row['working'] == 0) {echo 'false'; }
                            else {echo 'true'; }
                        ?></td>
                        <td class="medium"><?php echo $row['clockIn']; ?></td>
                        <td><a href="clock.php?<?php
                            //changes id added to url if clocking in or out
                            if ($row['working'] == 0) {echo 'cin_id='; }
                            else {echo 'cout_id='; }
                        ?><?php echo $row['id']; ?>"><input type="submit" class="btn btn-primary" value="<?php
                            //changes value of button if clocked in or out
                            if ($row['working'] == 0) {echo 'Clock In'; }
                            else {echo 'Clock Out'; }
                        ?>" name="<?php
                            //changes name of button if clocked in or out
                            if ($row['working'] == 0) {echo 'clockIn'; }
                            else {echo 'clockOut'; }
                        ?>"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <center><a href=""><input type="button" class="btn btn-success" value="Back to Top"></a></center><br /><br/><br/>
    </body>
</html>

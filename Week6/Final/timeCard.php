<?php
    //starts session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>   
<html>
    <head>
        <title>Project Manager</title>
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
        </style>
    </head>
    <body>
        <?php
            include './functions.php';
            
            $table = getAllProjects();
            $results = '';
            $searchName = '';
            $id = '';
            $editName = '';
            
            if (isPostRequest()) {
                if (isset($_POST['add']) && $_POST['add'] != "") {
                    $name = filter_input(INPUT_POST, 'add');
                    
                    $results = addProject($name);
                    if ($results == true) { header('Location: timeCard.php'); }
                    
                } else if (isset($_POST['projectName']) && $_POST['projectName'] != "") {
                    $searchName = filter_input(INPUT_POST, 'projectName');
                    $table = searchProjects($searchName);
                    
                } else if (isset($_POST['edit']) && $_POST['edit'] != "") {
                    $id = filter_input(INPUT_GET, 'Ed_id');
                    $editName = filter_input(INPUT_POST, 'edit');
                    
                    $results = editProject($editName, $id);
                    if ($results == true) { header('Location: timeCard.php'); }
                    
                } else {
                    $results = "Please fill in field";
                }
            } else if (isset($_GET['Ed_id'])) {
                $id = filter_input(INPUT_GET, 'Ed_id');
                $editName = $_SESSION['project'.$id];
                
            } else if (isset($_GET['Del_id'])) {
                $id = filter_input(INPUT_GET, 'Del_id');
                
                $results = deleteProject($id);
                if ($results == true) { header('Location: timeCard.php'); } 
            }
            
            
        ?>
        <center>
            <h1>Project Manager</h1>
            <a href="clock.php"><input type="button" class="btn btn-success" value="Timecard"></a>
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
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($table as $row): ?>
                        <tr>
                            <td class="long"><?php echo $row['name']; ?></td>
                            <td><a href="timeCard.php?Ed_id=<?php
                            //creates session variable with project name that correspondes to row
                            echo $row['id'];
                            $_SESSION['project'.$row['id']] = $row['name'];
                            ?>"><input type="submit" class="btn btn-warning" value="Edit" name="edit"></a></td>
                            <td><a href="timeCard.php?Del_id=<?php echo $row['id']; ?>"><input type="submit" class="btn btn-danger" value="Delete" name="delete"></a></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <form method="post" action="#"> 
                            <td><input type="text" value="<?php
                                //changes text value if editing
                                if (isset($_GET['Ed_id'])) {
                                    echo $editName;
                                }
                            ?>" name="<?php 
                                //changes name of input if editing
                                if (isset($_GET['Ed_id'])) {
                                    echo 'edit';
                                } else {
                                    echo 'add';
                                }
                            ?>" class="form-control" id="projectName" /></td>
                            <td><input type="submit" class="btn btn-primary" value="<?php 
                                //changes value of button if editing
                                if (isset($_GET['Ed_id'])) {
                                    echo 'Update Project';
                                } else {
                                    echo 'Add Project';
                                }
                            ?>"></td>
                            <td></td>
                        </form>
                    </tr>
                </tbody>
            </table>
            
        <center><a href="timeCard.php"><input type="button" class="btn btn-success" value="Back to Top"></a></center><br /><br/><br/>
    </body>
</html>


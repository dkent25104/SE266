<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Credit Card</title>
        <style type="text/css">
            table {
                border-collapse: collapse;
            }
            tr {
                border-top: 1px solid salmon;
            }
            td {
                padding: 10px;
                padding-right: 50px;
            }
        </style>
    </head>
    <body>
        <form name="moneyform" method="post">
            <p>Amount Owed</p>
            <input type="text" name="amount"><br>
            <p>Interest Rate</p>
            <input type="text" name="interest"><br>
            <p>Monthly Payment</p>
            <input type="text" name="monthly"><br><br>
            <input type="submit" value="Show me the damage" name="submit"><br><br>
        </form>
        <?php
            if (isset($_POST['amount']) && isset($_POST['interest']) && isset($_POST['monthly']))
            {
                if ($_POST['amount'] > 0 && $_POST['interest'] > 0 && $_POST['monthly'] > 0)
                {
                    $total = 0;
                    $months = 0;
                    $owed = $_POST['amount'];
                    $interest = $_POST['interest'] / 100 / 12;
                    $totalInterest = 0;
                    $monthly = $_POST['monthly'];
                    echo "<table><tr><td><b>Month</b></td><td><b>Interest Paid</b></td><td><b>Owed</b></td></tr>";
                    while ($owed > 0)
                    {
                        $months++;
                        $totalInterest = round($owed * $interest, 2);
                        $owed += $totalInterest;
                        
                        if ($monthly < $owed)
                        {
                            $total += $monthly;
                            $owed -= $monthly;
                            
                            echo "<tr><td>" . $months . "</td><td>$" . $totalInterest . "</td><td>$" . $owed . "</td></tr>";
                        }
                        else
                        {
                            $total += $owed;
                            $owed = 0;
                            
                            echo "<tr><td>" . $months . "</td><td>$" . $totalInterest . "</td><td>$" . $owed . "</td></tr>";

                        }
                    }
                    echo "</table><br>Total amount spent over " . $months . " months is $" . $total;
                    
                }
                else
                {
                    echo "ERROR: Please fill in all fields";
                }
            }
            else
            {
                echo "Please fill in all fields";
            }
        ?>
    </body>
</html>


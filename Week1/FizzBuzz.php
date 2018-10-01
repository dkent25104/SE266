<html>
    <head>
        <title>Fizz Buzz</title>
    </head>
    <body>
        <?php
            for ($i = 1; $i <= 100; $i++)
            {
                if ($i%2 == 0)
                {
                    if ($i%3 == 0)
                    {
                        echo "fizz buzz<br />";
                    }
                    else
                    {
                        echo "fizz<br />";
                    }
                }
                else if ($i%3 == 0)
                {
                    echo "buzz<br />";
                }
                else
                {
                    echo $i . "<br />";
                }
            }
        ?>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>SE266 - Daniel Kent</title>
</head>
<body>
    <header>
        <h1><center>SE266 Web Development Using PHP and MySQL</center></h1>
    </header>
    <article>
        <table>
			<tr>
				<th>Assignment Links</th>
				<th>Zipped Solutions</th>
			</tr>
            <tr>
                <td colspan="2" class="subheader"><center>Week 1</center></td>
            </tr>
            <tr>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week1/w1c1Demo.php">Hello World!</a></td>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week1/w1c1Demo.zip">Zip File</a></td>
            </tr>
            <tr>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week1/FizzBuzz.php">Fizz Buzz</a></td>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week1/FizzBuzz.zip">Zip File</a></td>
            </tr>
            <tr>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week1/CreditCard.php">Credit Card</a></td>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week1/CreditCard.zip">Zip File</a></td>
            </tr>
            <tr>
                <td colspan="2" class="subheader"><center>Week 2</center></td>
            </tr>
            <tr>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week2/dbconnect.php">DB Connect</a></td>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week2/dbconnect.zip">Zip File</a></td>
            </tr>
            <tr>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week2/03add.php">Add</a></td>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week2/03add.zip">Zip File</a></td>
            </tr>
            <tr>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week2/03view.php">View</a></td>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week2/03view.zip">Zip File</a></td>
            </tr>
            <tr>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week2/Add.php">Actors</a></td>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week2/Actors.zip">Zip File</a></td>
            </tr>
            <tr>
                <td colspan="2" class="subheader"><center>Week 3</center></td>
            </tr>
            <tr>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week3/crud.php">CRUD</a></td>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week3/crud.zip">Zip File</a></td>
            </tr>
            <tr>
                <td colspan="2" class="subheader"><center>Week 4</center></td>
            </tr>
            <tr>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week4/corps.php">Corp Search/Sort</a></td>
                <td><a href="http://ict.neit.edu/008000162/public_html/SE266/SE266/Week3/corps.zip">Zip File</a></td>
            </tr>
            <tr>
                <td colspan="2" class="subheader"><center>Week 5</center></td>
            </tr>
            <tr>
                <td colspan="2" class="subheader"><center>Week 6</center></td>
            </tr>
            <tr>
                <td colspan="2" class="subheader"><center>Week 7</center></td>
            </tr>
            <tr>
                <td colspan="2" class="subheader"><center>Week 8</center></td>
            </tr>
            <tr>
                <td colspan="2" class="subheader"><center>Week 9</center></td>
            </tr>
            <tr>
                <td colspan="2" class="subheader"><center>Week 10</center></td>
            </tr>
        </table>
		<section>
			<div>
				<h2>Dan Kent's<br />PHP & MySQL<br />Course Index</h2>
			</div>
			<div>
				<a href="https://github.com/dkent25104/SE266">SE266 Github Repository</a>
			</div>
			<div>
				<h3>PHP Resources</h3><br />
				<ul>
					<li><a href="https://www.w3schools.com/php/">w3schools</a></li>
					<li><a href="http://php.net/manual/en/tutorial.php">php.net manual</a></li>
					<li><a href="https://phptherightway.com/">PHP the right way</a></li>
				</ul>
			</div>
			<div>
				<h4>
				<?php
					$file = "index.php";
					$mod_date=date("F d Y", filemtime($file));
					$mod_time=date("h:i:s A", filemtime($file));

					echo "Last Modified<br />$mod_date<br />$mod_time";
				?>
				</h4>
			</div>
		</section>
    </article>
</body>
</html>
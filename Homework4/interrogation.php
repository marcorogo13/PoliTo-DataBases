<?php
    //additional fuctions for printing
    function error($error){
        return '<div style="background-color: red; padding: 10px; border: 1px solid red; text-align: center;">
                <h3>'.$error.'</h3>
                </div>';
    }

    function no_result($message){
        return '<div style="background-color: orange; padding: 10px; border: 1px solid orange; text-align: center;">
                <h2>'.$message.'</h2>
                </div>';
    }

    function yes_result($message){
        return '<div style="background-color: #cfc ; padding: 10px; border: 1px solid #cfc; text-align: center;">
                <h2>'.$message.'</h2>
                </div>';
    }

    function print_h($result){
		echo "<tr>";

		for ($i=0; $i < mysqli_num_fields($result); $i++) { 
			$title = mysqli_fetch_field($result);
			$name = $title->name;
			echo "<th> $name </th>";
		}

		echo "</tr>";
	}

	function print_rows($result){
		while ($row = mysqli_fetch_row($result)) {

			echo "<tr>";

			foreach ($row as $cell) {
				echo "<td>$cell</td>";
			}

			echo "</tr>";
		}
	}

    function print_table($result){
		echo "<table border=1 cellpadding=10>";
		
		print_h($result);

		print_rows($result);

		echo "</table>";
	}
?>


<html>
    <head>
        <title>Interrogation Results</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
        <?php

            //reading parameter
            if (!isset($_REQUEST["SSN"])){
                $error_message = "No SSN selected!";
		        print(error($error_message));
		        die();
            }

            $SSN = $_REQUEST["SSN"];

            // DATABASE CONNECTION
            $con = mysqli_connect('localhost','root','','multimedia_platform'); 
            if (mysqli_connect_errno())
            {
                $error_message = 'Failed to connect to MySQL: ' . mysqli_connect_error();
                print(error($error_message));
                die();
            }

            //EXECUTE QUERY
            $sql  = "
                SELECT ssn, Evaluation, Date
                FROM rating r, content c
                WHERE SSN = '$SSN' AND r.CodC = c.CodC 
                ORDER BY date;
            ";

            $result = mysqli_query($con,$sql);
            if( !$result ){
                $error_message = 'Query error: ' . mysqli_error($con);
                print(error($error_message));
                die();
            }


            if(mysqli_num_rows($result) > 0){
                print("<h3>List of evalutions given by the user ".$SSN.":</h3>");
                print_table($result);
            } else {
                print(no_result("No evaluation assigned by the user ".$SSN."!"));
            }
            

        ?>
    </body>
</html>
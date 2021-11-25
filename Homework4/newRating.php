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
            if (empty($_REQUEST["SSN"]) or 
                empty($_REQUEST["CodC"]) or
                empty($_REQUEST["Evaluation"]) or
                empty($_REQUEST["Date"])
                )
                {                
                    $error_message = "Insert all data!";
                    print(error($error_message));
                    die();
                }

            $SSN = $_REQUEST["SSN"];
            $CodC = $_REQUEST["CodC"];
            $Date = $_REQUEST["Date"];
            $Evaluation = $_REQUEST["Evaluation"];

            //costraint on var type and format

            if (!is_numeric($Evaluation) || 
                !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$Date)){
                $error_message = "wrong format of date or evaluation!";
		        print(error($error_message));
		        die();
            }

            if ((int)$_REQUEST["Evaluation"] > 10 || (int)$_REQUEST["Evaluation"] < 1){
                $error_message = "evaluation must be in the 1-10 range!";
		        print(error($error_message));
		        die();
            }

            $Evaluation = (int)$_REQUEST["Evaluation"];
            $CodC = (int)$_REQUEST["CodC"];


            // DATABASE CONNECTION
            $con = mysqli_connect('localhost','root','','multimedia_platform'); 
            if (mysqli_connect_errno())
            {
                $error_message = 'Failed to connect to MySQL: ' . mysqli_connect_error();
                print(error($error_message));
                die();
            }

            //start transaction
            mysqli_query($con,"SET autocommit=0;");
            mysqli_query($con,"START TRANSACTION;");
            
            
            //check if SSN is present in db
            $sql  = "
                SELECT SSN
                FROM users u
                WHERE SSN = '$SSN'
                ";

            $result = mysqli_query($con,$sql);
            if( !$result ){
                $error_message = 'Query error: ' . mysqli_error($con);
                print(error($error_message));
                die();
            }

            
            if(mysqli_num_rows($result) == 0){
                $error_message = 'SSN not present!';
                print(error($error_message));
                mysqli_query($con,"ROLLBACK;");
            }
            
            //check if CodC is present in db
            $sql  = "
                SELECT CodC
                FROM content c
                WHERE CodC = $CodC
                ";
            $result = mysqli_query($con,$sql);
            if( !$result ){
                $error_message = 'Query error: ' . mysqli_error($con);
                print(error($error_message));
                die();
            }


            if(mysqli_num_rows($result) == 0){
                $error_message = 'CodC not present!';
                print(error($error_message));
                mysqli_query($con,"ROLLBACK;");
            }
            

            //query to insert new rating
            $sql  = "
                INSERT INTO rating(SSN, CodC, Date, Evaluation)
                VALUES ('$SSN', $CodC, '$Date', $Evaluation);
                ";

            $result = mysqli_query($con,$sql);
            if( !$result ){
                $error_message = 'Query error: ' . mysqli_error($con);
                print(error($error_message));
                die();
            }
            mysqli_query($con,"COMMIT;");
            print(yes_result("the new rating on content: ".$CodC." by ".$SSN." has been inserted!"));
            mysqli_close($con);

        ?>
    </body>
</html>
<html>
    <head>
    <title>Homework 4</title>
    </head>
    
    <p>
    <body>
    
        <form method="get" action="interrogation.php">
            <h2>  Querying of the database: </h2>
            
            <table>
                <tr>
                    <td>
                        Select SSN:
                    </td>
                    <td>
                        <?php
                        // DATABASE CONNECTION
                        $con = mysqli_connect('localhost','root','','multimedia_platform'); 
                        if (mysqli_connect_errno())
                        {
                            $error_message = 'Failed to connect to MySQL: ' . mysqli_connect_error();
                            print(get_alert_html($error_message));
                            die();
                        }
                        
                        //SELECT SSN FOR DROPDOWN
                        $sql = "SELECT  SSN 
                                FROM users";
                        
                        //PRINT DROPDOWN
                        $result = mysqli_query($con,$sql);
                        if( !$result ){
                            $error_message = 'Query error: ' . mysqli_error($con);
                            print(get_alert_html($error_message));
                            die();
                        }
                        
                        echo "<select name ='SSN'>";

                        while ($row = $result->fetch_assoc()) {
                    
                                    unset($SSN);
                                    $SSN = $row['SSN'];
                                    echo '<option value="'.$SSN.'">'.$SSN.'</option>';
                                    
                        }
                    
                        echo "</select>";

                        ?>
                    </td>
                </tr>
            </table>
            <input class="btn btn-primary" type="submit" value="Send" />
            <input class="btn" type="reset" value="Cancel" />
        </form>
        </p>

        </br>
        </br>
        </br>

        <p>
        <form method="get" action="newUser.php">
            <h2>  Data entry transaction: </h2>
            <h3>  insertion of a new user: </h3>
                <table>
                        <tr>
                            <td>
                                SSN:
                            </td>
                            <td>
                                <input type="text" maxlength="16" size="16" name="SSN">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Name:
                            </td>
                            <td>
                                <input type="text" name="Name" maxlength="16" size="16">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Surname:
                            </td>
                            <td>
                                <input type="text" name="Surname" maxlength="16" size="16">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Year of birth:
                            </td>
                            <td>
                                <input type="text" name="Year" maxlength="4" size="4">
                            </td>
                        </tr>
                </table>
            </br>                        
            <input class="btn btn-primary" type="submit" value="Send" />
            <input class="btn" type="reset" value="Cancel" />
        </form> 
        
        <form method="get" action="newRating.php">       
            <h3>   insertion of a rating made by a user regarding a content present in the database: </h3>
                <table>
                        <tr>
                            <td>
                                SSN:
                            </td>
                            <td>
                            <?php
                                // DATABASE CONNECTION
                                $con = mysqli_connect('localhost','root','','multimedia_platform'); 
                                if (mysqli_connect_errno())
                                {
                                    $error_message = 'Failed to connect to MySQL: ' . mysqli_connect_error();
                                    print(get_alert_html($error_message));
                                    die();
                                }
                                
                                //SELECT SSN FOR DROPDOWN
                                $sql = "SELECT  SSN 
                                        FROM users";
                                
                                //PRINT DROPDOWN
                                $result = mysqli_query($con,$sql);
                                if( !$result ){
                                    $error_message = 'Query error: ' . mysqli_error($con);
                                    print(get_alert_html($error_message));
                                    die();
                                }
                                
                                echo "<select name ='SSN'>";

                                while ($row = $result->fetch_assoc()) {
                            
                                            unset($SSN);
                                            $SSN = $row['SSN'];
                                            echo '<option value="'.$SSN.'">'.$SSN.'</option>';
                                            
                                }
                            
                                echo "</select>";

                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                CodC:
                            </td>
                            <td>
                            <?php
                                // DATABASE CONNECTION
                                $con = mysqli_connect('localhost','root','','multimedia_platform'); 
                                if (mysqli_connect_errno())
                                {
                                    $error_message = 'Failed to connect to MySQL: ' . mysqli_connect_error();
                                    print(get_alert_html($error_message));
                                    die();
                                }
                                
                                //SELECT SSN FOR DROPDOWN
                                $sql = "SELECT  CodC 
                                        FROM content
                                        ORDER BY CodC";
                                
                                //PRINT DROPDOWN
                                $result = mysqli_query($con,$sql);
                                if( !$result ){
                                    $error_message = 'Query error: ' . mysqli_error($con);
                                    print(get_alert_html($error_message));
                                    die();
                                }
                                
                                echo "<select name ='CodC'>";

                                while ($row = $result->fetch_assoc()) {
                            
                                            unset($CodC);
                                            $CodC = $row['CodC'];
                                            echo '<option value="'.$CodC.'">'.$CodC.'</option>';
                                            
                                }
                            
                                echo "</select>";

                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Date:
                            </td>
                            <td>
                                <input type="Date" id="Date" name="Date">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Evaluation:
                            </td>
                            <td>
                                <input type="text" maxlength="2" size="2" name="Evaluation">
                            </td>
                        </tr>
                </table>
            </br> 
            <input class="btn btn-primary" type="submit" value="Send" />
            <input class="btn" type="reset" value="Cancel" />
        </form>
    </p>
    </body>

</html>
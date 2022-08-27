<?php

            require_once "conn.php";
            //	mysqli_close($conn);
            if($_POST['type']=="1")
            {      	// hospital login
               
                $id = mysqli_real_escape_string($conn,$_POST['id']);
                
                    $sql = "SELECT message,msg_received FROM donor WHERE id='$id' limit 1";
                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            $tem = $row;
                            //  echo "User found";
                            $array = array("status"=>"ok","message_"=>"successful","message"=>$row['message'],"msg_received"=>$row['msg_received']);
                            
                            echo json_encode($array);
                            
                        }  
                    }else{
                    $array = array("status"=>"false","message"=>"could not get the events");
                    
                    echo json_encode($array);
                    
                }
            }

            
            if($_POST['type']=="2")
            {      	// hospital login
                
                $id = mysqli_real_escape_string($conn,$_POST['id']);
                
                $sql = "UPDATE donor SET msg_received='false' WHERE id='$id'";
                
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_query($conn, $sql)) {
                    //echo json_encode(array("statusCode"=>200));
                  
                }
                else {
                   
                }
                
            }


?>
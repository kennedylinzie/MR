<?php

require_once "conn.php";
if($_POST['type']=="1")
{      	// check if user is present and pull data
  $UU_ID = mysqli_real_escape_string($conn,$_POST['UU_ID']);

                            $sql = "SELECT * FROM patient_table WHERE  UU_ID='$UU_ID'";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                  $tem = $row;
                                //echo "User found";

                      $array = array("status"=>"ok","message"=>"successful","UU_ID"=>$row['UU_ID'],"First_name"=>$row['First_name'],"Last_name"=>$row['Last_name']
                      ,"Age"=>$row['Age'],"Weight"=>$row['Weight'],"Bloodpressure"=>$row['Bloodpressure'],"Email"=>$row['Email']
                      ,"Phone_number"=>$row['Phone_number'],"Existing_illness"=>$row['Existing_illness'],"Location"=>$row['Location']
                      ,"Prescription"=>$row['Prescription'],"Verified"=>$row['Verified'],"Latitude"=>$row['Latitude'],"Longitude"=>$row['Longitude']);

                                  echo json_encode($array);

                                }
                      }else {
                        $array = array("status"=>"failed","message"=>"User doesnt exits");
                        echo json_encode($array);
                      }

}


    if($_POST['type']=="2")
    {

    //	user update other details
    $UU_ID = mysqli_real_escape_string($conn,$_POST['UU_ID']);
    $First_name = mysqli_real_escape_string($conn,$_POST['First_name']);
    $Last_name = mysqli_real_escape_string($conn,$_POST['Last_name']);
    $Age = mysqli_real_escape_string($conn,$_POST['Age']);
    $Weight = mysqli_real_escape_string($conn,$_POST['Weight']);
    $Bloodpressure = mysqli_real_escape_string($conn,$_POST['Bloodpressure']);
    $Email = mysqli_real_escape_string($conn,$_POST['Email']);
    $phone_number = mysqli_real_escape_string($conn,$_POST['Phone_number']);
    $Existing_illness = mysqli_real_escape_string($conn,$_POST['Existing_illness']);
    $Location = mysqli_real_escape_string($conn,$_POST['Location']);
    $Prescription = mysqli_real_escape_string($conn,$_POST['Prescription']);
    $Latitude = mysqli_real_escape_string($conn,$_POST['Latitude']);
    $Longitude = mysqli_real_escape_string($conn,$_POST['Longitude']);


            if($First_name == "" || $Last_name == "" || $Age == "" || $Weight == "" || $Bloodpressure == "" || $Email == "" || $phone_number == ""  || $Location == ""
            && $Password == "" || $Prescription == "" || $Latitude == "" || $Longitude == "")
                {
    				
                    $array = array("status"=>"success","message"=>"data missing somewhere");
                    echo json_encode($array);

                    die();
    			}else
    			{
    				$duplicate=mysqli_query($conn,"select * from patient_table where  UU_ID='$UU_ID'");

    						if (mysqli_num_rows($duplicate)>0)
    						{

                                                                                       

                $sql = "UPDATE `patient_table` SET  First_name='$First_name' , Last_name='$Last_name' , Age='$Age' , Weight='$Weight' , Bloodpressure='$Bloodpressure',
                Email='$Email', phone_number='$phone_number' , Existing_illness='$Existing_illness', Location='$Location', Prescription='$Prescription', Latitude='$Latitude', Longitude='$Longitude' WHERE UU_ID='$UU_ID'";

                        if (mysqli_query($conn, $sql)) {
                                         
                                  $array = array("status"=>"success","message"=>"Successful");
                                  echo json_encode($array);
                                }
                                else {
                                    //echo json_encode(array("statusCode"=>201));
                                   // echo "NOT successful";
                                    $array = array("status"=>"failed","message"=>"Unsuccessful");
                                    echo json_encode($array);
                                }

    						}

    			   }


    		}


        if($_POST['type']=="3")
        {
        //	user changes password
        	    $old_pass = mysqli_real_escape_string($conn,$_POST['old_pass']);
        	    $new_pass = mysqli_real_escape_string($conn,$_POST['new_pass']);
        		$UU_ID    = mysqli_real_escape_string($conn,$_POST['UU_ID']);


        			if($old_pass == "" || $new_pass == "" || $UU_ID == "" )
        			{
        				
                        $array = array("status"=>"failed","message"=>"data missing somewheressful");
                        die();
        			}else
        			{
        				$duplicate=mysqli_query($conn,"select * from patient_table where  UU_ID='$UU_ID' and Password='$old_pass'");

        						if (mysqli_num_rows($duplicate)>0)
        						{

                                  $sql = "UPDATE `patient_table` SET  Password='$new_pass' WHERE UU_ID='$UU_ID'";

                                if (mysqli_query($conn, $sql)) {
                                             
                                        $array = array("status"=>"success","message"=>"Successful");
                                        
                                        }
                                        else {
                                        
                                            $array = array("status"=>"failed","message"=>"Not successful");
                                        }
                                        echo json_encode($array);
        						}
                                else 
                                {
                                  
                                    $array = array("status"=>"failed","message"=>"Wrong password");
                                }

        		}
        	}


                
                if($_POST['type']=="7")
                {
                    
                    //	hospital update location
                    
                    $id = mysqli_real_escape_string($conn,$_POST['id']);
                    $lat = mysqli_real_escape_string($conn,$_POST['latitude']);
                    $lon = mysqli_real_escape_string($conn,$_POST['longitude']);
                 
                    
                    
                    
                    if($id == "" || $lat == "" || $lon == "" )
                    {
                        echo "data missing somewhere";
                        die();
                    }else
                    {
                        $duplicate=mysqli_query($conn,"select * from hospital where  id='$id'");
                        
                        if (mysqli_num_rows($duplicate)>0)
                        {
                            
                            $sql = "UPDATE `hospital` SET  latitude='$lat',longitude='$lon' WHERE id='$id'";
                            
                            if (mysqli_query($conn, $sql)) {
                                //echo json_encode(array("statusCode"=>200));
                                echo "successful";
                            }
                            else {
                                //echo json_encode(array("statusCode"=>201));,receive_notes='$rec'
                                echo "NOT successful";
                            }
                            
                        }else {
                            echo "Wrong password";
                        }
                        
                    }
                    
                    
                }
                
                
                
                



    ?>

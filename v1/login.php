<?php

require_once "conn.php";
if($_POST['type']=="1")
{      	// donor login
      $Email = mysqli_real_escape_string($conn,$_POST['Email']);
      			$Password = mysqli_real_escape_string($conn,$_POST['Password']);
      			
      		//	$password = md5($password);

      			$duplicate=mysqli_query($conn,"SELECT * FROM patient_table WHERE  Email='$Email' AND Password='$Password'");
      					if (mysqli_num_rows($duplicate)>0)
      					{
                            $sql = "SELECT * FROM patient_table WHERE  Email='$Email' AND Password='$Password'";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                  $tem = $row;
                                //  echo "User found";
                      $array = array("status"=>"success","message"=>"successful","UU_ID"=>$row['UU_ID'],"First_name"=>$row['First_name'],"Last_name"=>$row['Last_name']
                      ,"Age"=>$row['Age'],"Weight"=>$row['Weight'],"Bloodpressure"=>$row['Bloodpressure'],"Email"=>$row['Email']
                      ,"Phone_number"=>$row['Phone_number'],"Existing_illness"=>$row['Existing_illness'],"Location"=>$row['Location']
                      ,"Prescription"=>$row['Prescription'],"Verified"=>$row['Verified'],"Latitude"=>$row['Latitude'],"Longitude"=>$row['Longitude']);

                                  echo json_encode($array);

                                }  }
      					}
      					else{
                  $array = array("status"=>"failed","message"=>"Wrong Email or password");
                  echo json_encode($array);

      			}
		}
		
	//	mysqli_close($conn);
  if($_POST['type']=="2")
  {      	// hospital login
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        			$password = mysqli_real_escape_string($conn,$_POST['password']);
        			
        			$password = md5($password);

        			$duplicate=mysqli_query($conn,"SELECT * FROM hospital WHERE  email='$email' AND password='$password'");
        					if (mysqli_num_rows($duplicate)>0)
        					{
                              $sql = "SELECT * FROM hospital WHERE  email='$email' AND password='$password'";
                              $result = mysqli_query($conn, $sql);

                              if (mysqli_num_rows($result) > 0) {
                                  // output data of each row
                                  while($row = mysqli_fetch_assoc($result)) {
                                    $tem = $row;
                                  //  echo "User found";
                        $array = array("status"=>"success","message"=>"successful","id"=>$row['id'],"hospital_name"=>$row['hospital_name'],"email"=>$row['email']
                        ,"district"=>$row['district'],"licence"=>$row['licence'],"latitude"=>$row['latitude'],"longitude"=>$row['longitude']
                        ,"usertype"=>$row['usertype'],"verified"=>$row['verified']);

                                    echo json_encode($array);

                                  }  }
        					}
        					else{
                    $array = array("status"=>"failed","message"=>"Wrong username or password");

                    echo json_encode($array);

        			}
  		}


?>

<?php

require 'conn.php';

if($_POST['type']=="1")
{

//PATIENT register


	    $First_name = mysqli_real_escape_string($conn,$_POST['First_name']);
	    $Last_name = mysqli_real_escape_string($conn,$_POST['Last_name']);
		$Age = mysqli_real_escape_string($conn,$_POST['Age']);
	    $Weight = mysqli_real_escape_string($conn,$_POST['Weight']);
	    $Bloodpressure = mysqli_real_escape_string($conn,$_POST['Bloodpressure']);
		$Email = mysqli_real_escape_string($conn,$_POST['Email']);
	    $phone_number = mysqli_real_escape_string($conn,$_POST['Phone_number']);
	    $Existing_illness = mysqli_real_escape_string($conn,$_POST['Existing_illness']);
		$Location = mysqli_real_escape_string($conn,$_POST['Location']);
		$Password = mysqli_real_escape_string($conn,$_POST['Password']);
		$Prescription = mysqli_real_escape_string($conn,$_POST['Prescription']);
		$Latitude = mysqli_real_escape_string($conn,$_POST['Latitude']);
		$Longitude = mysqli_real_escape_string($conn,$_POST['Longitude']);
	
			$verified = "";

			if($First_name == "" || $Last_name == "" || $Age == "" || $Weight == "" || $Bloodpressure == "" || $Email == "" || $phone_number == ""  || $Location == ""
			&& $Password == "" || $Prescription == "" || $Latitude == "" || $Longitude == "")
			{
				
				  $array = array("status"=>"failed","message"=>"data missing somewhere");
                  echo json_encode($array);
                  die();
			}else
			{


				$duplicate=mysqli_query($conn,"select * from patient_table where  phone_number='$phone_number' and Email='$Email'");
						if (mysqli_num_rows($duplicate)>0)
						{
						
							
							$array = array("status"=>"failed","message"=>"User phone or email already exists");
							echo json_encode($array);
              die();
						}
						else{

						   // $password = md5($password);
							
				$sql = "INSERT INTO `patient_table`(First_name,Last_name,Age,Weight,Bloodpressure,Email,Phone_number,Existing_illness,Location,Password,Prescription,Verified,Latitude,Longitude)
				VALUES ('$First_name','$Last_name','$Age','$Weight','$Bloodpressure','$Email','$phone_number','$Existing_illness','$Location','$Password','$Prescription','$verified','$Latitude','$Longitude')";
				if (mysqli_query($conn, $sql)) {

										
							$array = array("status"=>"success","message"=>"Successful");
							echo json_encode($array);
								

								}
								else {
										
										$array = array("status"=>"failed","message"=>"NOT Successful");
							            echo json_encode($array);
								
								}
				}
			}


		}else {
		//	echo "wrong api key";
		}
//.................................


if($_POST['type']=="2")
{

//  hospital register

	    $hospital_name = mysqli_real_escape_string($conn,$_POST['hospital_name']);
	    $email = mysqli_real_escape_string($conn,$_POST['email']);
	    $district = mysqli_real_escape_string($conn,$_POST['district']);
			$licence = mysqli_real_escape_string($conn,$_POST['licence']);
	    $latitude = mysqli_real_escape_string($conn,$_POST['latitude']);
	    $longitude = mysqli_real_escape_string($conn,$_POST['longitude']);
			$password = mysqli_real_escape_string($conn,$_POST['password']);
	    $usertype = mysqli_real_escape_string($conn,$_POST['usertype']);
	    $verified = mysqli_real_escape_string($conn,$_POST['verified']);
	    $phone_number = mysqli_real_escape_string($conn,$_POST['phone_number']);

			if($hospital_name == "" || $email == "" || $district == "" || $licence == "" || $latitude == "" || $longitude == "" || $password == ""
			    || $usertype == "" || $verified == ""|| $phone_number == "")
			{
				echo "data missing somewhere";
              die();
			}

			$duplicate=mysqli_query($conn,"select * from hospital where  hospital_name='$hospital_name'");
					if (mysqli_num_rows($duplicate)>0)
					{
						echo "Hospital name already exists";
             die();
					}

			$duplicate=mysqli_query($conn,"select * from hospital where  hospital_name='$hospital_name' and email='$email'");
					if (mysqli_num_rows($duplicate)>0)
					{
						echo "Hospital already exists";

					}
					else{

					    $password = md5($password);


			$sql = "INSERT INTO `hospital`(hospital_name,email,district,licence,latitude,longitude,password,usertype,verified,phone_number)
			VALUES ('$hospital_name','$email','$district','$licence','$latitude','$longitude','$password','$usertype','$verified','$phone_number')";
			if (mysqli_query($conn, $sql)) {
												//echo json_encode(array("statusCode"=>200));
								echo "successful";


								$message = "welcome " .$hospital_name. " your registration was successfull please wait for verification,thank you";



								$sql_ = "INSERT INTO messages (id, number, message, status)VALUES ('', '$phone_number', '$message', 'false')";
								//$result_ = mysqli_query($conn, $sql_);


								if (mysqli_query($conn, $sql_)) {
								    //echo json_encode(array("statusCode"=>200));
								    //show_error("UPDATE SUCCESSFUL WILL BE UPDATED NEXT TIME YOU LOG IN");

								}
								else {


								}




							}
							else {
								  //echo json_encode(array("statusCode"=>201));
									echo "NOT successful";
							}
			}
		}else {
		//	echo "wrong api key";
		}





		//mysqli_close($conn);


?>

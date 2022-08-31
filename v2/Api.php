<?php 
 
 require_once 'DbConnect.php';
 

 
 if(isset($_GET['apicall'])){
 
 switch($_GET['apicall']){
 
 case 'signup':
            if(isTheseParametersAvailable(array('First_name','Last_name','Age','Weight','Bloodpressure','Phone_number','Email','Existing_illness','Location','Password','Prescription','Latitude','Longitude','Membership_number'))){
            
        //PATIENT register
        $First_name = $_POST['First_name']; 
        $Last_name = $_POST['Last_name']; 
        $Age = $_POST['Age']; 
        $Weight = $_POST['Weight']; 
        $Bloodpressure = $_POST['Bloodpressure']; 
        $Phone_number = $_POST['Phone_number']; 
        $Existing_illness = $_POST['Existing_illness']; 
        $Email = $_POST['Email']; 
        $Location = $_POST['Location']; 
        $Password = $_POST['Password']; 
        $Prescription = $_POST['Prescription']; 
        $Latitude = $_POST['Latitude']; 
        $Longitude = $_POST['Longitude']; 
        $Membership_number = $_POST['Membership_number']; 
      

    $verified = "";

    if($First_name == "" || $Last_name == "" || $Age == "" || $Weight == "" || $Bloodpressure == "" || $Email == "" || $Phone_number == ""  || $Location == ""
    && $Password == "" || $Prescription == "" || $Latitude == "" || $Longitude == "" || $Membership_number ="")
    {
        
          $array = array("status"=>"failed","message"=>"data missing somewhere");
          echo json_encode($array);
          die();
    }else
    {


        $duplicate=mysqli_query($conn,"select * from patient_table where  Phone_number='$Phone_number' and Email='$Email'");
                if (mysqli_num_rows($duplicate)>0)
                {
                
                    
                    $array = array("status"=>"failed","message"=>"User phone or email already exists");
                    echo json_encode($array);
                    die();
                }
                else{

                   // $password = md5($password);

    
                    
        $sql = "INSERT INTO `patient_table`(First_name,Last_name,Age,Weight,Bloodpressure,Email,Phone_number,Existing_illness,Location,Password,Prescription,Verified,Latitude,Longitude,Membership_number)
        VALUES ('$First_name','$Last_name','$Age','$Weight','$Bloodpressure','$Email','$Phone_number','$Existing_illness','$Location','$Password','$Prescription','$verified','$Latitude','$Longitude','$Membership_number')";
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
}else{
    $array = array("status"=>"failed","message"=>"NOT Successful");
    echo json_encode($array);
}
            
 break; 
 
 case 'login':
 
                if(isTheseParametersAvailable(array('Email', 'Password'))){
    
             $Email = $_POST['Email']; 
            // $Password = md5($_POST['Password']);
             $Password = $_POST['Password'];
 
 
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
                     ,"Prescription"=>$row['Prescription'],"Verified"=>$row['Verified'],"Latitude"=>$row['Latitude'],"Longitude"=>$row['Longitude'],"Membership_number"=>$row['Membership_number']);
 
                                 echo json_encode($array);
 
                                 }  }
                         }
                         else{
                 $array = array("status"=>"failed","message"=>"Wrong Email or password");
                 echo json_encode($array);
 
                 }

                
                }
 break; 


 case '':
 
    if(isTheseParametersAvailable(array('id','username','email','gender'))){
    
    
    }
break; 


case 'pullUserData':
 //fetch user data
 if(isTheseParametersAvailable(array('UU_ID'))){
              
    	// check if user is present and pull data
  $UU_ID = $_POST['UU_ID'];

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
            ,"Prescription"=>$row['Prescription'],"Verified"=>$row['Verified'],"Latitude"=>$row['Latitude'],"Longitude"=>$row['Longitude'],"Membership_number"=>$row['Membership_number']);

                    echo json_encode($array);

                }
            }
    
    }
break; 

case 'Update_user':
    //fetch user data
    if(isTheseParametersAvailable(array('UU_ID','First_name','Last_name','Weight','Bloodpressure','Email','Phone_number','Existing_illness','Location','Prescription','Latitude','Longitude','Membership_number'))){
                 
    //	user update other details
    $UU_ID = $_POST['UU_ID'];
    $First_name = $_POST['First_name'];
    $Last_name = $_POST['Last_name'];
    $Age = $_POST['Age'];
    $Weight = $_POST['Weight'];
    $Bloodpressure = $_POST['Bloodpressure'];
    $Email = $_POST['Email'];
    $phone_number = $_POST['Phone_number'];
    $Existing_illness = $_POST['Existing_illness'];
    $Location = $_POST['Location'];
    $Prescription = $_POST['Prescription'];
    $Latitude = $_POST['Latitude'];
    $Longitude = $_POST['Longitude'];
    $Membership_number = $_POST['Membership_number'];


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
                Email='$Email', phone_number='$phone_number' , Existing_illness='$Existing_illness', Location='$Location', Prescription='$Prescription', Latitude='$Latitude', Longitude='$Longitude', Membership_number='$Membership_number' WHERE UU_ID='$UU_ID'";

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
   break; 



   case 'Update_password':
    //fetch user data
    if(isTheseParametersAvailable(array('old_pass','new_pass','UU_ID'))){
                 
  
                //	user changes password
                $old_pass = $_POST['old_pass'];
                $new_pass = $_POST['new_pass'];
                $UU_ID    = $_POST['UU_ID'];


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
   break; 


   case 'Update_prescription':
    //fetch user data
    if(isTheseParametersAvailable(array('UU_ID','Prescription'))){
                 
    //	user update other details
    $UU_ID = $_POST['UU_ID'];
    $Prescription = $_POST['Prescription'];
   


            if($UU_ID == "" || $Prescription == "")
                {
    				
                    $array = array("status"=>"success","message"=>"data missing somewhere");
                    echo json_encode($array);

                    die();
    			}else
    			{
    				$duplicate=mysqli_query($conn,"select * from patient_table where  UU_ID='$UU_ID'");

    						if (mysqli_num_rows($duplicate)>0)
    						{

                                                                                       

                $sql = "UPDATE `patient_table` SET Prescription='$Prescription' WHERE UU_ID='$UU_ID'";

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
   break; 



case 'add_gurdian':
    if(isTheseParametersAvailable(array('g_name','g_lastname','g_relation','g_phone_number','g_email','patient_id'))){
    
//guardian register
$g_name = $_POST['g_name']; 
$g_lastname = $_POST['g_lastname']; 
$g_relation = $_POST['g_relation']; 
$g_phone_number = $_POST['g_phone_number']; 
$g_email = $_POST['g_email'];  
$patient_id = $_POST['patient_id'];



if($g_name == "" || $g_lastname == "" || $g_relation == "" || $g_phone_number == "" || $g_email == "" || $g_phone_number == "" || $patient_id == "" )
{

  $array = array("status"=>"failed","message"=>"data missing somewhere");
  echo json_encode($array);
  die();
}else
{
                                                  
    $sql = "SELECT COUNT(g_uuid) FROM guardian Where patient_id='$patient_id'";

    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
     
      while($row = mysqli_fetch_assoc($result)) {
       $count = $row["COUNT(g_uuid)"];

       if( $count == 3){
        $array = array("status"=>"failed","message"=>"A minimum of three is allowed");
        echo json_encode($array);
        die();
       }
      }
    } 


$duplicate=mysqli_query($conn,"select * from guardian where  g_name='$g_name' and g_phone_number='$g_phone_number'");
        if (mysqli_num_rows($duplicate)>0)
        {
        
            
            $array = array("status"=>"failed","message"=>"Name or phone number already exists");
            echo json_encode($array);
            die();
        }
        else{

           // $password = md5($password);


                    
        $sql = "INSERT INTO `guardian`(g_name,g_lastname,g_relation,g_phone_number,g_email,patient_id)
        VALUES ('$g_name','$g_lastname','$g_relation','$g_phone_number','$g_email','$patient_id')";
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
}else{
$array = array("status"=>"failed","message"=>"NOT Successful");
echo json_encode($array);
}
    
break;

case 'pullguardData':
    if(isTheseParametersAvailable(array('patient_id'))){
        $patient_id = $_POST['patient_id'];  

               $sql = "SELECT * FROM guardian WHERE patient_id='$patient_id'";

               $result = mysqli_query($conn, $sql);
       
               if (  mysqli_num_rows($result) > 0) {
       
                   // output data of each row
                   while($row[] = mysqli_fetch_assoc($result)) {
       
                       $tem = $row;
       
                       $json = json_encode($tem);
       
    
                   }
       
               } 
                   echo $json;
            }
           
   break; 

    case 'Delete_guard':
        if(isTheseParametersAvailable(array('patient_id','g_name'))){
        $g_name = $_POST['g_name'];  
        $patient_id = $_POST['patient_id'];  
        $duplicate=mysqli_query($conn,"SELECT * FROM guardian WHERE  patient_id='$patient_id' and g_name='$g_name'");
            if (mysqli_num_rows($duplicate)>0)
            {
                    if($g_name == "" )
                    {
                        //echo "data missing somewhere";
                         die();
                    }
                  else
                {
                    $sql = "DELETE FROM `guardian` WHERE g_name='$g_name' and patient_id='$patient_id'";
                    if (mysqli_query($conn, $sql)) 
                    {
                        $array = array("status"=>"success","message"=>"Successful");
                        echo json_encode($array);
                    }                 
                }
            }
        }
   break; 

case 'ping':
    
// Check if server is alive
if (mysqli_ping($conn)) {

    $array = array("status"=>"success","message"=>"ok");
    echo json_encode($array);
  }

break; 
 


 
 default: 
    $array = array("status"=>"failed","message"=>"Invalid Operation Called");
    echo json_encode($array);
 }
 
 }else{
        $array = array("status"=>"failed","message"=>"Invalid API Call");
        echo json_encode($array);
 }
 

 
 function isTheseParametersAvailable($params){
 
    foreach($params as $param){
        if(!isset($_POST[$param])){
            return false; 
        }
    }
 return true; 
 }
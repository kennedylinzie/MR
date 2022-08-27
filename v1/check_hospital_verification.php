<?php

require_once "conn.php";


if($_POST['type']=="1")
{      	// donor login
    $id = mysqli_real_escape_string($conn,$_POST['id']);
 
    
 
        $sql = "SELECT * FROM hospital WHERE  id='$id'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $tem = $row;
                //  echo "User found";
                $array = array("status"=>"ok","message"=>"successful","verified"=>$row['verified']);
                
                echo json_encode($array);
                
            } 
            
         }
   
    else{
        $array = array("status"=>"false","message"=>"Wrong search");
        
        echo json_encode($array);
        
    }
}
?>


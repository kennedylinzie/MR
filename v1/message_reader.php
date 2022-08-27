<?php

require "conn.php";


if($_POST['type']=="1")
{      	// donor login
    
    
    $sql = "SELECT * FROM messages where status='false'";
    
    $result = mysqli_query($conn, $sql);
    
    if (  mysqli_num_rows($result) > 0) {
        
        // output data of each row
        while($row[] = mysqli_fetch_assoc($result)) {
            //  var_dump($row[0]);
            //  echo array(4) {["id"]=>string(1)};
            $tem = $row;
            
            $json = json_encode($tem);
            
        }
        
    } else {
        echo "0 results";
    }
    echo $json;
    //  $conn->close();
    
}else {
    //  echo "give me something";
}







if($_POST['type']=="2")
{      	// donor login
    
    
    //    $sql = "SELECT * FROM messages where status='false'";
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    
    $sql = "UPDATE `messages` SET  status='true'  WHERE status='false' and id='$id'";
    
    if (mysqli_query($conn, $sql)) {
        //echo json_encode(array("statusCode"=>200));
        echo "successful";
    }
    else {
        //echo json_encode(array("statusCode"=>201));
        //  echo "NOT successful";
    }
    
    
    //  $conn->close();
    
}else {
    //echo "give me something";
}





?>

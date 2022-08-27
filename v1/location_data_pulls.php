<?php

require_once "conn.php";


    if($_POST['type']=="1")
    {      	// donor login


            $sql = "SELECT * FROM hospital";

            $result = mysqli_query($conn, $sql);

            if (  mysqli_num_rows($result) > 0) {

             // output data of each row
             while($row[] = mysqli_fetch_assoc($result)) {

             $tem = $row;

             $json = json_encode($tem);


             }

            } else {
             echo "0 results";
            }
             echo $json;
          //  $conn->close();

    }



    if($_POST['type']=="2")
    {      	// donor login
        $id = mysqli_real_escape_string($conn,$_POST['id']);

        $sql = "SELECT * FROM hospital WHERE id='$id'";

        $result = mysqli_query($conn, $sql);

        if (  mysqli_num_rows($result) > 0) {

            // output data of each row
            while($row[] = mysqli_fetch_assoc($result)) {

                $tem = $row;

                $json = json_encode($tem);


            }

        } else {
            echo "0 results";
        }
        echo $json;
        //  $conn->close();

    }


    if($_POST['type']=="3")
    {      	// donor login
        $hosname = mysqli_real_escape_string($conn,$_POST['name']);

        $sql = "SELECT * FROM hospital WHERE hospital_name='$hosname'";

        $result = mysqli_query($conn, $sql);

        if (  mysqli_num_rows($result) > 0) {

            // output data of each row
            while($row[] = mysqli_fetch_assoc($result)) {

                $tem = $row;

                $json = json_encode($tem);


            }

        } else {
            echo "0 results";
        }
        echo $json;
        //  $conn->close();

    }
?>

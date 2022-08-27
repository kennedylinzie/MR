<?php

require_once "conn.php";
if($_POST['type']=="1")
{

//delete	donor

	    $id = mysqli_real_escape_string($conn,$_POST['id']);

      $duplicate=mysqli_query($conn,"SELECT * FROM donor WHERE  id='$id'");
          if (mysqli_num_rows($duplicate)>0)
          {
          			if($id == "" )
          			{
          				echo "data missing somewhere";
                  die();
          			}
                else
          			{
              				$sql = "DELETE FROM `donor`WHERE id='$id'";
              				if (mysqli_query($conn, $sql)) {
              									echo "successful";
              					}
              					else
                        {
              										echo "NOT successful";
              					}

          			}

          }else {
               echo "User doesn't exist";
          }

		}else {
		//	echo "wrong api key";
		}
//.................................

		if($_POST['type']=="2")
		{
		    
		    //delete	donor
		    
		    $id = mysqli_real_escape_string($conn,$_POST['id']);
		    
		    $duplicate=mysqli_query($conn,"SELECT * FROM hospital WHERE  id='$id'");
		    if (mysqli_num_rows($duplicate)>0)
		    {
		        if($id == "" )
		        {
		            echo "data missing somewhere";
		            die();
		        }
		        else
		        {
		            $sql = "DELETE FROM `hospital`WHERE id='$id'";
		            if (mysqli_query($conn, $sql)) {
		                echo "successful";
		            }
		            else
		            {
		                echo "NOT successful";
		            }
		            
		        }
		        
		    }else {
		        echo "User doesn't exist";
		    }
		    
		}else {
		    //	echo "wrong api key";
		}
//.................................


?>

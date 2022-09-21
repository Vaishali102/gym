<?php
$firstName=$_POST['firstName'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$locality=$_POST['locality'];
$phoneNo=$_POST['phoneNo'];
$emailId=$_POST['emailId'];

if (!empty($firstName) || !empty($age) || !empty($gender) || !empty($locality) || !empty($phoneNo) || !empty($emailId) ){
    $host = "localhost";
    $dbUsername ="root";
    $dbPassword ="";
    $dbname ="registration";

    //create a connection
    $conn =new mysqli($host ,$dbUsername,$dbPassword , $dbname);

    if(mysqli_connect_error()){
        die('connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }else{
        $SELECT ="SELECT emailId from registration where emailId =? limit 1";
        $INSERT ="INSERT Into registration (firstName, age ,gender ,locality ,phoneNo ,emailId) values(? ,?,?,?,?,?)";

        //preparing statement 
        $stmt =$conn->prepare($SELECT);
        $stmt->bind_param("s" ,$eamilId);
        $stmt->execute();
        $stmt->bind_result($emailId);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if(rnum==0){
           $stmt->close();

            $stmt =$conn->prepare($INSERT);
            $stmt->bind_param("ssssii", $firstName, $age , $gender , $locality ,$phoneNo ,$emailId);
            $stmt->execute();
            echo "New record inserted sucessfully";
        }
        else{
            echo"Someone already register using this mail";
        }
        $stmt->close();
        $conn->close();
    }
     }else{
    echo"All field are required";
    die();
}
?>






<?php

include "header.php";
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



$data = json_decode(file_get_contents("php://input"));//contain a hero object sent from  heroservice component clas





$sql = "UPDATE AddressTB1 
        SET  address = '$data->address', city = '$data->city', state = '$data->state', zipcode = '$data->zipcode'
        WHERE type = 'home' AND personID = '$data->personID';";

$sql .= "UPDATE AddressTB1 
        SET  address = '$data->address2', city = '$data->city2', state = '$data->state2', zipcode = '$data->zipcode2'
        WHERE type = 'work' AND personID = '$data->personID'";




//free result of each query above to preapare for next sql $sql2 
if (mysqli_multi_query($conn,$sql))
{
  do
    {
    // Store first result set
    if ($result=mysqli_store_result($conn)) {
      
      /* Fetch one and one row
      while ($row=mysqli_fetch_row($result))
        {
        printf("%s\n",$row[0]);
        }
    */
      // Free result set
      mysqli_free_result($result);
      }
    }
  while (mysqli_next_result($conn));
}
                    


// need select data from database to send added data back to angular component
$sql2 = "SELECT * FROM Users WHERE username = '$data->username' ";  
$result = $conn->query($sql2);
if ($result->num_rows > 0) {
    // output data of each row
     
    while($row = $result->fetch_assoc()) {
        $data = $row; // assign new object to $data  
        //$data = json_encode($data); // won't get object value in angular component if added
    }
    echo json_encode($data);
} else {
    echo "0";
}



mysqli_close($conn);


?>

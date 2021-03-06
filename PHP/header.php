<?php

header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, X-Requested-With, Accept');

$servername = "localhost";
$username = "stwoscam_xuewei";
$password = "6466373558Fxw";
$dbname = "stwoscam_smalltown";

$conn = new mysqli($servername, $username, $password, $dbname);


$query = "SELECT personID FROM Users";
$res = mysqli_query($conn, $query);

if(empty($res)) {
                $query = "CREATE TABLE Users (
                          personID int(11) AUTO_INCREMENT,
                          username varchar(255) NOT NULL UNIQUE,
                          email varchar(255) NOT NULL,
                          password varchar(255) NOT NULL,                      
                          PRIMARY KEY  (personID)
                          );";

                $query .= "CREATE TABLE AddressTB1(
							addrID int(11) AUTO_INCREMENT, 
							address varchar(255),
							city varchar(255),
							state varchar(255),
							zipcode varchar(255),
							type varchar(255),
							personID int(11),
							PRIMARY KEY (addrID),
							FOREIGN KEY (PersonID) REFERENCES Users(personID)
							);";

                $query .= "CREATE TABLE Apartments(
							apartmentID int(11) AUTO_INCREMENT,
							address varchar(255),
							rent varchar(255),
							PRIMARY KEY  (apartmentID)

							)";

           


				//free result of each query above to preapare for next sql $sql2 
				if (mysqli_multi_query($conn,$query))
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


}
?>


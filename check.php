<?php
  $servername = "eventpal.cp4hghmjwcmi.us-west-2.rds.amazonaws.com";
  $username = "rohit";
  $password = "rohitnair987";
  $database = "eventpal";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $database);

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  echo "Connected successfully";

$query = "SELECT Name FROM Interest;";
mysqli_query($conn, $query) or die('Error querying the database.');

$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["Name"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
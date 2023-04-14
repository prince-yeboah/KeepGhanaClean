<?php
// Set database connection variables
$host = "localhost";
$user = "root";
$password = "";
$database = "sanitation";

// Connect to the database
$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
    echo "Connection done!!!";
}

// Retrieve data from the database
$sql = "SELECT username, distance_covered, trash_disposed FROM league_table";
$result = mysqli_query($conn, $sql);

// Display data in a table
echo "<table>";
echo "<tr><th>Username</th><th>Distance Covered</th><th>Trash Disposed</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>".$row["username"]."</td><td>".$row["distance_covered"]."</td><td>".$row["trash_disposed"]."</td></tr>";
}
echo "</table>";

// Close the database connection
mysqli_close($conn);
?>




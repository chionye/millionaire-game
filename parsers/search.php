<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ammony/database/connect.php';

if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT * FROM item WHERE description LIKE ?";
    
    if($stmt = $db->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_term);
        
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            // Check number of rows in the result set
            if($result->num_rows > 0){
                // Fetch result rows as an associative array
                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                    echo "<p><a href='details.php?id=".$row["tid"]."'>" . $row["description"] . "</a></p>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
     
    // Close statement
    $stmt->close();
}
if (isset($_POST['submit'])) {
   $search = $_POST['search'];
   show_search($search);
   header('location:category');
}
?>
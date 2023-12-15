<?php
session_start();
include("connection.php");

// Execute the Python script and capture the output
$python_output = shell_exec('python get_scanning_data.py');

// Convert the output to an integer
$item_value = intval(trim($python_output));

// Validate and sanitize the input
$item_value = mysqli_real_escape_string($con, $item_value);

// Get the primary key column dynamically
$primaryKeyQuery = "SHOW INDEX FROM inventory WHERE Key_name = 'PRIMARY'";
$primaryKeyResult = mysqli_query($con, $primaryKeyQuery);

if ($primaryKeyResult) {
    $primaryKeyRow = mysqli_fetch_assoc($primaryKeyResult);

    if (!empty($primaryKeyRow['Column_name'])) {
        $primaryKeyColumn = $primaryKeyRow['Column_name'];

        // Use the primary key column in the query
        $query = "SELECT * FROM inventory WHERE `$primaryKeyColumn` = $item_value";
        $result = mysqli_query($con, $query);

        // Check if the item exists
        if ($result && mysqli_num_rows($result) > 0) {
            echo "Item exists in the database";
            $row = mysqli_fetch_assoc($result);
            $_SESSION['ID'] = $row['ID'];
            $_SESSION['Name'] = $row['Name'];
            $_SESSION['Description'] = $row['Description'];
            
            // Check if the 'Image' column contains data
            if (!empty($row['Image'])) {
                // Convert the binary image data to base64
                $_SESSION['Image'] = base64_encode($row['Image']);
            } else {
                // Handle the case where 'Image' column is empty
                $_SESSION['Image'] = ""; // or provide a default image
            }
            
            // $_SESSION['Image'] = $row['Image']; 
            $_SESSION['Type'] = $row['Type'];
            $_SESSION['Place'] = $row['Place'];

            header("Location: Borrow.php");
            // header("Location: Return.php");
            // header("Location: Broken.php");
            // print_r($_SESSION); // Print the session array
        } else {
            echo "Item does not exist in the database";
        }
    } else {
        echo "Primary key column not found";
    }
} else {
    echo "Failed to retrieve primary key information";
}

// Close the database connection
mysqli_close($con);
?>

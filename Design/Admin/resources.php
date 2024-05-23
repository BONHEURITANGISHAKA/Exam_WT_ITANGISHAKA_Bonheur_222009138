<?php
// Establish connection to the MySQL database
$servername = "localhost"; // Change this to your MySQL server hostname if different
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "designthinking"; // Change this to the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize them
    if (isset($_POST['update'])) {
        $id = $conn->real_escape_string($_POST['id']);
        $name = $conn->real_escape_string($_POST['name']);
        $description = $conn->real_escape_string($_POST['description']);
        $link = $conn->real_escape_string($_POST['link']);
        $type = $conn->real_escape_string($_POST['type']);

        // SQL query to update data in the resources table
        $sql = "UPDATE resources SET Name='$name', Description='$description', Link='$link', Type='$type' WHERE ID='$id'";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Record updated successfully')</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $name = $conn->real_escape_string($_POST['name']);
        $description = $conn->real_escape_string($_POST['description']);
        $link = $conn->real_escape_string($_POST['link']);
        $type = $conn->real_escape_string($_POST['type']);

        // SQL query to insert data into the resources table
        $insert_sql = "INSERT INTO resources (Name, Description, Link, Type) VALUES ('$name', '$description', '$link', '$type')";

        // Execute the insert query
        if ($conn->query($insert_sql) === TRUE) {
            echo "<script>alert('Record inserted successfully')</script>";
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }
}

// Check if delete button is clicked
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    // SQL query to delete record from resources table
    $delete_sql = "DELETE FROM resources WHERE ID = '$delete_id'";
    // Execute the delete query
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Record deleted successfully')</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Retrieve data from the resources table
$sql = "SELECT * FROM resources";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Resource Management</title>
</head>
<style>
     body{
         background-image: url('designs.jpg');
    background-size: cover;
/*    background-position: center; /* Adjust this value as needed */*/
    background-repeat: no-repeat;
    }
</style>
<body>

<header>
    <nav>
        <div class="logo" style="font-size: 24px; padding: 10px; color: white; background-color: #333;">
            <p style="margin: 0;">My Website</p>
        </div>
        <ul style="list-style: none; margin: 0; padding: 0; display: flex; background-color: #333;">
            <!-- Navigation links -->
            <li style="margin-left: 20px;"><a href="index.html" style="text-decoration: none; color: white; padding: 10px; display: block;">Home</a></li>
            <li style="margin-left: 20px;"><a href="Users.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Users</a></li>
            <li style="margin-left: 20px;"><a href="Instructor.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Instructor</a></li>
            <li style="margin-left: 20px;"><a href="Course.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Course</a></li>
            <li style="margin-left: 20px;"><a href="enlollement.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Enrollment</a></li>
            <li style="margin-left: 20px;"><a href="Resources.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Resource</a></li>
            <li style="margin-left: 20px;"><a href="Discussion.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Discussion</a></li>
            <li style="margin-left: 20px;"><a href="Feedback.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Feedback</a></li>
            <li style="margin-left: 20px;"><a href="Progress.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Progress</a></li>
            <li style="margin-left: 20px;"><a href="Qwiz.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Quiz</a></li>
            <li style="margin-left: 20px;"><a href="Certificate.php" style="text-decoration: none; color: white; padding: 10px; display: block;">Certificate</a></li>
            <li class="dropdown" style="margin-left: 20px; position: relative;">
                <a href="#" style="text-decoration: none; color: white; padding: 10px; display: block;">Settings</a>
                <div class="dropdown-content" style="display: none; position: absolute; background-color: #333; top: 35px; right: 0; min-width: 150px;">
                    <a href="logout.php" style="text-decoration: none; color: white; padding: 10px; display: block; border-bottom: 1px solid #575757;">Log out</a>
                </div>
            </li>
        </ul>
    </nav>
</header>
<main>
<div style="background-color: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 300px; margin: 20px auto;">

    <h2 style="text-align: center; margin-bottom: 20px;">Resource Form</h2>
    
    <form id="resourceForm" method="post" action="" style="display: flex; flex-direction: column;">

        <label for="name" style="margin-bottom: 5px;">Name:</label>
        <input type="text" id="name" name="name" required style="padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc;">

        <label for="description" style="margin-bottom: 5px;">Description:</label>
        <input type="text" id="description" name="description" required style="padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc;">

        <label for="link" style="margin-bottom: 5px;">Link:</label>
        <input type="text" id="link" name="link" required style="padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc;">

        <label for="type" style="margin-bottom: 5px;">Type:</label>
        <input type="text" id="type" name="type" required style="padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc;">

        <button type="submit" name="submit" style="padding: 10px; border: none; border-radius: 5px; background-color: #007bff; color: #fff; cursor: pointer;">Submit</button>
    </form>

</div>

<table border="1" style="width: 100%; border-collapse: collapse;">
    <tr>
        <th style="padding: 8px; border: 1px solid #ddd;">Name</th>
        <th style="padding: 8px; border: 1px solid #ddd;">Description</th>
        <th style="padding: 8px; border: 1px solid #ddd;">Link</th>
        <th style="padding: 8px; border: 1px solid #ddd;">Type</th>
        <th style="padding:        <th style="padding: 8px; border: 1px solid #ddd;">Action</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td style='padding: 8px; border: 1px solid #ddd; color: white;'>" . $row["Name"] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #ddd; color: white;'>" . $row["Description"] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #ddd; color: white;'>" . $row["Link"] . "</td>";
            echo "" . $row["Type"] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #ddd;'><a href='?update=" . $row["ID"] . "' style='text-decoration: none; color: blue;'>Update</a> | <a href='Resource.php?delete=" . $row["ID"] . "' onclick='return confirm(\"Are you sure you want to delete this record?\")' style='text-decoration: none; color: red;'>Delete</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5' style='padding: 8px; border: 1px solid #ddd;'>0 results</td></tr>";
    }
    ?>
</table>

<?php
if (isset($_GET['update'])) {
    $update_id = $_GET['update'];
    $update_sql = "SELECT * FROM resources WHERE ID = '$update_id'";
    $update_result = $conn->query($update_sql);
    if ($update_result->num_rows > 0) {
        $update_row = $update_result->fetch_assoc();
?>
<div style="background-color: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 300px; margin: 20px auto;">

    <h2 style="text-align: center; margin-bottom: 20px;">Update Resource</h2>
    
    <form id="updateForm" method="post" action="" style="display: flex; flex-direction: column;">
        <input type="hidden" id="id" name="id" value="<?php echo $update_row['ID']; ?>">
        <label for="name" style="margin-bottom: 5px;">Name:</label>
        <input type="text" id="name" name="name" required style="padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc;" value="<?php echo $update_row['Name']; ?>">
        <label for="description" style="margin-bottom: 5px;">Description:</label>
        <input type="text" id="description" name="description" required style="padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc;" value="<?php echo $update_row['Description']; ?>">
        <label for="link" style="margin-bottom: 5px;">Link:</label>
        <input type="text" id="link" name="link" required style="padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc;" value="<?php echo $update_row['Link']; ?>">
        <label for="type" style="margin-bottom: 5px;">Type:</label>
        <input type="text" id="type" name="type" required style="padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc;" value="<?php echo $update_row['Type']; ?>">
        <button type="submit" name="update" style="padding: 10px; border: none; border-radius: 5px; background-color: #007bff; color: #fff; cursor: pointer;">Update</button>
    </form>
</div>
<?php 
    } else {
        echo "No record found!";
    }
}
?>

</main>
</body>  
</html>

<?php
// Close the database connection
$conn->close();
?>


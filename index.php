<?php
$conn = new mysqli("localhost", "root", "", "user_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];

    $sql = "INSERT INTO users (name, age, status) VALUES ('$name', '$age', 0)";

    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_POST['toggle'])) {
    $id = $_POST['toggle_id'];

    $conn->query(
        "UPDATE users
         SET status = IF(status = 0, 1, 0)
         WHERE id = $id"
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>User Management</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<h2>User Management</h2>

<form method="POST" onsubmit="return validateForm()">

    <input type="text"
    id="name"
    name="name"
    placeholder="Name"
    required>

    <input type="number"
    id="age"
    name="age"
    placeholder="Age"
    required>

    <button type="submit" name="submit">
        Submit
    </button>

</form>

<br>

<input type="text"
id="search"
placeholder="Search user..."
onkeyup="searchUser()">

<?php
$result = $conn->query("SELECT * FROM users");
?>

<table border="1" id="userTable">

<tr>

<th>ID</th>
<th>Name</th>
<th>Age</th>
<th>Status</th>
<th>Action</th>

</tr>

<?php while ($row = $result->fetch_assoc()) { ?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>
<?php echo $row['name']; ?>
</td>

<td>
<?php echo $row['age']; ?>
</td>

<td>
<?php echo $row['status']; ?>
</td>

<td>

<form method="POST">

<input type="hidden"
name="toggle_id"
value="<?php echo $row['id']; ?>">

<button
type="submit"
name="toggle"
onclick="return confirmStatus();">

Toggle

</button>

</form>

<a class="delete-btn"
href="delete.php?id=<?php echo $row['id']; ?>"
onclick="return confirmDelete();">

Delete

</a>

</td>

</tr>

<?php } ?>

</table>

<script src="script.js"></script>

</body>
</html>
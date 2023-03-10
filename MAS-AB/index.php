<?php
$conn = mysqli_connect("localhost", "root", "root", "midterm");

$sql = "SELECT * FROM tasks";
$result = mysqli_query($conn, $sql);


if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $date = $_POST['date'];
    $status = $_POST['status'];
   
    
    $sql = "INSERT INTO tasks VALUES (null,'$name','$desc', '$date', '$status')";
    mysqli_query($conn, $sql);
  
  }
  
if (isset($_POST['delete'])) {
   
    $id = $_POST['id'];
    $sql = "DELETE FROM tasks WHERE id=".$id;

    
    mysqli_query($conn, $sql);
  }

  if (isset($_GET['edit'])) {
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM tasks WHERE id=".$id;
    $get_result = mysqli_query($conn, $sql);
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>PHP connects to MYSQL</title>
</head>
<body>
  <h1>PHP connects to MYSQL</h1>
  
  <table border="1">
    <tr>
      <th>id</th>
      <th>Name</th>
      <th>Description</th>
      <th>Due Date</th>
      <th>Status</th>
    </tr>
    

    <?php
    
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>".$row['id']."</td>";
      echo "<td>".$row['task_name']."</td>";
      echo "<td>".$row['task_description']."</td>";
      echo "<td>".$row['task_due_date']."</td>";
      echo "<td>".$row['task_status']."</td>";
      echo "<td><form method='post'><input type='hidden' value='".$row['id']."' name='id'><button type='submit' name='delete'>delete</button></form></td>";
      echo "<td><form method='get'><input type='hidden' value='".$row['id']."' name='id'><button type='submit' name='edit'>edit</button></form></td>";
    }
    ?>
  </table>
  <br>
</body>
</html>


<form method="post">
    <label>Name:</label>
    <input type="text" name="name"><br>
    <label>Description:</label>
    <input type="text" name="des"><br>
    <label>Date:</label>
    <input type="date" name="date"><br>
    <label>Status:</label>
   <select name="status">
        <option value="incomplete">Incomplete</option>
        <option value="in progress">In Progress</option>
        <option value="complete">Complete</option>
   </select>
    <button type="submit" name="submit">Submit</button>
<form>

<?php 
if ($get_result) { 
$row = mysqli_fetch_assoc($get_result);  
?>

<form method="post">
    <label>Name:</label>
    <input type="text" name="name" value="<?php echo $row['task_name']; ?>"><br>
    <label>Description:</label>
    <input type="text" name="des"><br>
    <label>Date:</label>
    <input type="date" name="date"><br>
    <label>Status:</label>
   <select name="status">
        <option value="incomplete">Incomplete</option>
        <option value="in progress">In Progress</option>
        <option value="complete">Complete</option>  
   </select>
    <button type="submit" name="submit">Update</button>

<form>




<?php

mysqli_close($conn);

?>


<?php }?>
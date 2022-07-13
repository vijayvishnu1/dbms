<?php
    $mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    if(isset($_POST['del-btn'])){
        $username= $_POST['username'];
        $bulkWrite=new MongoDB\Driver\BulkWrite;
        $filter=array('username'=> $username);
        $bulkWrite->delete($filter, array('limit'=>1));
        $res= $mongo->executeBulkWrite('usertable.userinfo', $bulkWrite); 
        if($res && $res->getDeletedCount() > 0){
            echo '<script>alert("Record deleted sucessfully.");</script>';
        }
        else{
            echo '<script>alert("Record deleted failed. Try again !!");</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete - Record</title>
</head>
<body>
    <center>

        <br><br>
        <h2>Delete Record</h2>
        <p>Delete your desired record from the database. Please enter the valid username to want to delete.</p>
        <form action="#" method="post">
            <label for="username">Username : </label>
            <input type="text" name="username" id="username" placeholder="Enter username to delete">
            <input type="submit" name="del-btn" id="del-btn" value="Delete">
        </form>
        <br><br>
        <a href="ListRecord.php">Click here to view the list</a>
    </center>
</body>
</html>
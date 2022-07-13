<?php
    $mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    if(isset($_POST['find-btn'])){
        $username= $_POST['username'];
        $filter= array('username'=>$username);
        $options = array('limit'=>1);
        $query = new MongoDB\Driver\Query($filter, $options);
        $res= $mongo->executeQuery('usertable.userinfo', $query);          
        $res_arr= $res->toArray();
        if($res && count($res_arr) > 0)
            echo '<script>alert("Record found Successfully.");</script>';
        else
            echo '<script>alert("Record not found !! Try another valid username");</script>';
    }
    
    if(isset($_POST['update-record-btn'])){
        $fullname= $_POST['upfullname'];
        $username= $_POST['upusername'];
        $emailid= $_POST['upemailid'];
        $passwrd= $_POST['uppasswrd'];

        $bulkWrite=new MongoDB\Driver\BulkWrite;
        $filter=array('username'=> $username);
        $options=array("fullname"=>$fullname,"username"=>$username,"emailid"=>$emailid, "passwrd"=> $passwrd);
        $bulkWrite->update($filter, $options);
        $update_res= $mongo->executeBulkWrite('usertable.userinfo', $bulkWrite);
        if($update_res)
            echo '<script>alert("Update Successful.");</script>';
        else
            echo '<script>alert("Update Failed !! Try again.");</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update - Record</title>
</head>
<body id="update-body">
    <center>
        <br><br>
        <h2>Update Record</h2>
        <p>Please enter the valid username of the record you want to update and if valid username, <br> update the values from the form appearing below after the username submission.</p>
        <br>
        <form action="UpdateRecord.php" method="post">
            <label for="username">Username : </label>
            <input type="text" name="username" id="username" placeholder="Enter username">
            <input type="submit" name="find-btn" id="find-btn" value="Find Record">
        </form>
        <br><br>

        <form action="UpdateRecord.php" method="POST">
            <h2>Update Information</h2>
            <table id="form-table">
                <?php 
                    if(isset($res_arr) && $res_arr!=null){
                    foreach($res_arr as $user) {     
                ?>
                <tr>
                    <td><label for="up-username" class="formlabel">Username : </label></td>
                    <td><input type="text" class="forminput" name="upusername" id="upusername" value="<?php echo $user->username; ?>" placeholder="Enter the username..."></td>
                </tr>
                <tr>
                    <td><label for="up-fullname" class="formlabel">Full Name : </label></td>
                    <td><input type="text" class="forminput" name="upfullname" id="upfullname" value="<?php echo $user->fullname; ?>" placeholder="Enter your first name..."></td>
                </tr>
                <tr>
                    <td><label for="up-emailid" class="formlabel">Email ID : </label></td>
                    <td><input type="email" class="forminput" name="upemailid" id="upemailid" value="<?php echo $user->emailid; ?>" placeholder="Enter your Email-ID..."></td>
                </tr>
                <tr>
                    <td><label for="up-passwrd" class="formlabel">Password : </label></td>
                    <td><input type="text" class="forminput" name="uppasswrd" id="uppasswrd" value="<?php echo $user->passwrd; ?>" placeholder="Enter a new password..."></td>
                </tr>
                <tr>
                    <td><input type="submit" name="update-record-btn" id="update-record-btn" value="Update"></td>
                </tr>
                <?php }} ?>
            </table>
            
        </form>
    </center>
</body>
</html>
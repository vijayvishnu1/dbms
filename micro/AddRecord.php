<?php
    $mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    if(isset($_POST["form-submit"])){
        $fullname=$_POST["fullname"];
        $username=$_POST["username"];
        $emailid=$_POST["emailid"];
        $passwrd=$_POST["passwrd"];

        $writer=new MongoDB\Driver\Bulkwrite;
        $writer->insert(["fullname"=>$fullname,"username"=>$username,"emailid"=>$emailid,"passwrd"=>$passwrd]);
        $mongo->executeBulkWrite('usertable.userinfo',$writer);
        echo '<script>alert("Record Added Successfully.");</script>';
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - MongoDB Connection</title>
</head>
<body>
    <center>
        <h3 style="margin-top: 40px">The PHP - MongoDB Database Connection</h3>
        <p>The php-mongodb connection is explained via form submission. Please fill the form and submit to upload the data to MongoDB.</p>

        <form action="AddRecord.php" method="POST" id="index_form">
            <h2>Profile Information</h2>
            <br>

            <table id="form-table">
                <tr>
                    <td><label for="fullname" class="formlabel">Full Name : </label></td>
                    <td><input type="text" class="forminput" name="fullname" id="fullname" placeholder="Enter your first name..."></td>
                </tr>
                <tr>
                    <td><label for="username" class="formlabel">Username : </label></td>
                    <td><input type="text" class="forminput" name="username" id="username" placeholder="Enter a new username..."></td>
                </tr>
                <tr>
                    <td><label for="emailid" class="formlabel">Email ID : </label></td>
                    <td><input type="email" class="forminput" name="emailid" id="emailid" placeholder="Enter your Email-ID..."></td>
                </tr>
                <tr>
                    <td><label for="passwrd" class="formlabel">Password : </label></td>
                    <td><input type="password" class="forminput" name="passwrd" id="passwrd" placeholder="Enter a new password..."></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="form-submit" id="form-submit"></td>
                </tr>
            </table>
            
        </form>
    </center>
</body>
</html>
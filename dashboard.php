<?php 
   require_once('connection.php');

 ?>
 <?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

if ($_SESSION['username']) {
  // code...
 $currentUser =  $_SESSION['username'];

}else{
    header("Location:index.php");
}

?>
<!-- upload  id -->

<?php
   if(isset($_FILES['uploadedid'])){
      $errors= array();
      $file_name = $_FILES['uploadedid']['name'];
      $file_size =$_FILES['uploadedid']['size'];
      $file_tmp =$_FILES['uploadedid']['tmp_name'];
      $file_type=$_FILES['uploadedid']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['uploadedid']['name'])));
      
      $expensions= array("jpeg","jpg","png","pdf");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 8097152){
         $errors[]='File size must be less than 8 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"documents/".$currentUser.$file_name);
         $IDpath = "documents/".$currentUser.$file_name;
    // update insert path to database
   
        $sqlupdatepending = "UPDATE tbldocuments SET NATIONALID = '$IDpath' , STATUS = 1 WHERE ID = '{$currentUser}' ";

           if ($conn->query($sqlupdatepending) === TRUE) {
           // update status
             $sqlupdatestatus = "UPDATE tblsubmision SET NATIONALID = 1  WHERE ID = '{$currentUser}' ";

           if ($conn->query($sqlupdatestatus) === TRUE) {
            echo "<script>alert('ID submited successfully');</script>";
           } else {
           echo "Error uploading ID: " . $conn->error;
          
           }
           // end of update status
           } else {
           echo "Error uploading ID: " . $conn->error;
          
           }           

          



   // end of update insert

      }else{
         print_r($errors);
      }
   }
?>

<?php
   if(isset($_FILES['uploadedkra'])){
      $errors= array();
      $file_name = $_FILES['uploadedkra']['name'];
      $file_size =$_FILES['uploadedkra']['size'];
      $file_tmp =$_FILES['uploadedkra']['tmp_name'];
      $file_type=$_FILES['uploadedkra']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['uploadedkra']['name'])));
      
      $expensions= array("jpeg","jpg","png","pdf");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 8097152){
         $errors[]='File size must be less than 8 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"documents/".$currentUser.$file_name);
         
       $IDpath = "documents/".$currentUser.$file_name;
    // update insert path to database
   
        $sqlupdatepending = "UPDATE tbldocuments SET KRAPIN = '$IDpath' , STATUS = 1 WHERE ID = '{$currentUser}' ";

           if ($conn->query($sqlupdatepending) === TRUE) {
           // update status
             $sqlupdatestatus = "UPDATE tblsubmision SET KRAPIN = 1  WHERE ID = '{$currentUser}' ";

           if ($conn->query($sqlupdatestatus) === TRUE) {
            echo "<script>alert('KRA submited successfully');</script>";
           } else {
           echo "Error uploading KRA: " . $conn->error;
          
           }
           // end of update status
           } else {
           echo "Error uploading KRA: " . $conn->error;
          
           }           

          



   // end of update insert



      }else{
         print_r($errors);
      }
   }
?>

<?php
   if(isset($_FILES['uploadedpermit'])){
      $errors= array();
      $file_name = $_FILES['uploadedpermit']['name'];
      $file_size =$_FILES['uploadedpermit']['size'];
      $file_tmp =$_FILES['uploadedpermit']['tmp_name'];
      $file_type=$_FILES['uploadedpermit']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['uploadedpermit']['name'])));
      
      $expensions= array("jpeg","jpg","png","pdf");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 8097152){
         $errors[]='File size must be excately 8 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"documents/".$currentUser.$file_name);
         
             
       $IDpath = "documents/".$currentUser.$file_name;
    // update insert path to database
   
        $sqlupdatepending = "UPDATE tbldocuments SET BUSINESSPERMIT = '$IDpath' , STATUS = 1 WHERE ID = '{$currentUser}' ";

           if ($conn->query($sqlupdatepending) === TRUE) {
           // update status
             $sqlupdatestatus = "UPDATE tblsubmision SET PERMIT = 1  WHERE ID = '{$currentUser}' ";

           if ($conn->query($sqlupdatestatus) === TRUE) {
            echo "<script>alert('PERMIT submited successfully');</script>";
           } else {
           echo "Error uploading PERMIT: " . $conn->error;
          
           }
           // end of update status
           } else {
           echo "Error uploading PERMIT: " . $conn->error;
          
           }           

          



   // end of update insert



      }else{
         print_r($errors);

      }
   }
?>

<?php 
    $selectsubmission = "SELECT NATIONALID, KRAPIN, PERMIT FROM tblsubmision WHERE ID='$currentUser'";

    $resultselectsubmission = $conn->query($selectsubmission);
                if ($resultselectsubmission->num_rows > 0) {
              // output data of each row
              if($row = $resultselectsubmission->fetch_assoc()) {
               $IDstatus = $row["NATIONALID"];
               $KRAstatus = $row['KRAPIN'];
               $PERMITstatus = $row['PERMIT'];

              }
           }else{
              echo "Kindly Reload";
            }
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles/index.css">
    <link rel="stylesheet" type="text/css" href="styles/dash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Dashboard</title>
</head>

<body>
 <!-- start of header -->
<div class="myheader">
	<div class="logoholder"><img src="assets/logo.png" width="150px"></div>
     <div class="headerdetails"> 
     	<div class="websitename">
          <center><h3>Kenya literature bureau</h3></center>
     	 </div>
     	<div class="navbar">
           <a href="#"><?php echo $currentUser; ?></a> &nbsp; &nbsp;
           <a href="logout.php">Logout</a>&nbsp; &nbsp;
     	</div>
      </div>
</div>
<hr>
<!-- end of header -->
<!-- start of body -->
  <div>
    <center><label></label> </center>
    <!-- upload id -->
      <form action="" method="POST" enctype="multipart/form-data">
         <div class="idupload">
            <center>
                <label class="mylabel">Upload your National ID</label><br>
         <input type="file" name="uploadedid" class="browserbtn"/><br><br>
         <hr>
         <input type="submit" value="Submit my ID" class="uploadbtn" />
         </center>
         </div>
         <br>
      </form> 
      <!-- upload pin -->
      <br>
      <form action="" method="POST" enctype="multipart/form-data">
         <div class="idupload">
            <center>
                <label class="mylabel">Upload your KRA PIN</label><br>
         <input type="file" name="uploadedkra" class="browserbtn"/><br><br>
         <hr>
         <input type="submit" value="Submit my Kra Pin" class="uploadbtn" />
         </center>
         </div>
         <br>
      </form>
       <!-- upload permit-->
      <br>
      <form action="" method="POST" enctype="multipart/form-data">
         <div class="idupload">
            <center>
                <label class="mylabel">Upload your Business Permit</label><br>
         <input type="file" name="uploadedpermit" class="browserbtn"/><br><br>
         <hr>
         <input type="submit" value="Submit my Permit" class="uploadbtn" />
         </center>
         </div>
         <br>
      </form>





   </div>
    <br>

    <div>
        <h1>Your submission</h1>

<table id="customers">
  <tr>
    <th>Serial</th>
    <th>Document</th>
    <th>Status</th>
  </tr>
  <tr>
    <td>1</td>
    <td>National ID</td>
    <td><?php 
        if ( $IDstatus == 0) {
           // code...
         echo "Not Submited";
        }else{
         echo "Submited";
        }
        ?></td>
  </tr>
  <tr>
    <td>2</td>
    <td>KRA PIN</td>
    <td>
       
       <?php 
        if ( $KRAstatus == 0) {
           // code...
         echo "Not Submited";
        }else{
         echo "Submited";
        }
        ?>
    </td>
  </tr>
  <tr>
    <td>3</td>
    <td>Business Permit</td>
    <td>
       <?php 
        if ( $PERMITstatus == 0) {
           // code...
         echo "Not Submited";
        }else{
         echo "Submited";
        }
        ?>
    </td>
  </tr>
 
</table>
    </div>
    <br><br><br><br>
<!-- end of body -->
<div class="footer">
    <center>
    KLB Customer &copy; 2022
    </center>
</div>



  <script type="text/javascript" src="javascript/upload.js"></script>
</body>
</html>
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
         move_uploaded_file($file_tmp,"documents/".$file_name);
         echo "Success";
    // update insert path to database
    $sqlsubmitid = "INSERT INTO tblsubmision (ID,NATIONALID, KRAPIN, PERMIT)
    VALUES ('$EMAIL',0, 0, 0)";

    if ($conn->query($sqlsubmitid) === TRUE) {
      echo "Account created successfully";
    } else {
      echo "Error: " . $sqlsubmit . "<br>" . $conn->error;
    }


   // end of insert

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
         move_uploaded_file($file_tmp,"documents/".$file_name);
         echo "Success";
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
         move_uploaded_file($file_tmp,"documents/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }
?>

<?php 
    $selectsubmission = "SELECT NATIONALID, KRAPIN, PERMIT FROM tblsubmision WHERE ID='$currentUser'";

    $result = $conn->query($selectsubmission);
                if ($result->num_rows > 0) {
              // output data of each row
              if($row = $result->fetch_assoc()) {
               $IDstatus = $row["NATIONALID"];
               $KRAstatus = $row['KRAPIN'];
               $PERMITstatus = $row['PERMIT'];

              }
           }else{
              echo "<script>alert('Account error contact admin');</script>";
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
    <th>
       <?php 
        if ( $IDstatus == 0) {
           // code...
         echo "Not Submited";
        }else{
         echo "Submited";
        }
        ?>
    </th>
  </tr>
  <tr>
    <td>1</td>
    <td>National ID</td>
    <td>Not submitted</td>
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
<?php
$Name= $_POST['name'];
$Email= $_POST['email'];
$Age = $_POST['age'];
$Person = $_POST['role'];
if(!empty($Name)|| !empty($Email) || !empty($Age) || !empty($Person)){
$host = "localhost";
$dbUsername="root";
$dbPassword = "";
$dbname = "form" ;
$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
if (mysqli_connect_error()){
die('Connect Error('. mysqli_connect_error().')'. mysqli_connect_error());
} else{
$SELECT= "SELECT Email From submit Where Email=? Limit 1";
$INSERT = "INSERT Into submit (Name,Email,Age,Person) Values (?,?,?,?)";
$stmt=$conn->prepare($SELECT);
$stmt ->bind_param("s",$Email);
$stmt->execute();
$stmt->store_result();
$rnum=$stmt->num_rows;
if($rnum==0){ 
$stmt->close();
$stmt=$conn->prepare($INSERT);
$stmt->bind_param("ssis",$Name,$Email,$Age,$Person);
$stmt->execute();
echo '<body>
   <body>
    <div class="flex-container">
      <div class="message-container">
        <h1>Thank you!</h1>
        <p>We will review your submitted response and reply if needed.</p>
      </div>
    </div>
    <footer>
      @ 2020 <a href="http://tumainihealth.or.ke/" target="_blank">tumainihealth.or.ke</a>
    </footer>
  </body>';
}else{
echo "someone already register using this email";
}
$stmt->close();
$conn->close();
}
}else{
echo "All feild are required";
die();
}
?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <title></title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<?php
// define variables and set to empty values
$nameErr = $emailErr = $phoneErr = $dobErr = "";
$name = $email = $phone = $dob = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
  if (empty($_POST["phone"])) {
    $phoneErr = "Phone Number is required";
  } else {
    $phone = test_input($_POST["phone"]);
    if (!preg_match("/^\d{10}$/",$phone)) {
      $phoneErr = "Only 10 digit number is allowed";
    }
  }
   if(empty($_POST["dob"])){
    $dobErr = "Date of birth is required";
   }else{
    $dob = test_input($_POST["dob"]);
    if (strtotime($_POST["dob"]) > time()) {
      $dobErr = "Invalid Date";
    }
    
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12 text-center mt-2 "><h3>Form Vaildation</h3></div>
		<div class="col-12 col-md-10 col-lg-6 mx-auto mt-2 f1 shadow">
			<div class="row">
				<div class="col-md-6 col-12">
				 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			  	<label>Name</label> <span class="error">* <?php echo $nameErr;?></span>
			  	<input type="text" name="name" placeholder="Full Name"  class="form-control" >
			  	<br>
			  	<label>Email</label><span class="error">* <?php echo $emailErr;?></span>
			  	<input type="email" name="email" placeholder="Email"  class="form-control">
			  	<br>
			  	<label>Phone</label><span class="error">* <?php echo $phoneErr;?></span>
			  	<input type="text" name="phone" placeholder="Phone" pattern="^\d{10}$"  class="form-control">
			  	<br>
			  	<label>Date of Birth</label><span class="error">* <?php echo $dobErr;?></span>
			  	<input type="date" name="dob" placeholder="Date of Birth"  max="<?php echo date("Y-m-d"); ?>" class="form-control">
			  	<br>
			  	<div class="d-grid gap-3 col-6 mx-auto">
			  	<input type="Submit"  name="Submit" class="btn btn-success">
			  </div>
			  </form>
			</div>
			 
			<div class="col-md-6 col-12 border-start border-black">
				
			  	<h5>Output:</h5>
			  	<?php  

				if (isset($_POST['Submit'])) {
					echo "Name: ".$_POST["name"]."<br>";
					echo "Email: ".$_POST["email"]."<br>";
					echo "Phone Number: ".$_POST["phone"]."<br>";
					echo "Date of Birth: ".$_POST["dob"]."<br>";
				}
				?>
			</div>
			</div>

			  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		</div>
	</div>
</div>

</body>
</html>

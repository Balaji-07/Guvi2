<?php
   include("config.php");
   session_start();

   $username = "";
   $email    = "";
   $errors = array(); 

   // REGISTER USER
if (isset($_POST['register']))
{
   $username = mysqli_real_escape_string($db, $_POST['uname']);
   $email = mysqli_real_escape_string($db, $_POST['email']);
   $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
   $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
 
  
   if (empty($username)) { array_push($errors, "Username is required"); }
   elseif (!preg_match('/^[A-Za-z][A-Za-z0-9_]*$/', $username)) {
    array_push($errors, "Username must starts with Alphabet");
}
   if (empty($email)) { array_push($errors, "Email is required"); }
   if (empty($password_1)) { array_push($errors, "Password is required"); }
   if ($password_1 != $password_2)
   {
    array_push($errors, "The two passwords doesn't match");
   }
 
   $user_check_query = "SELECT * FROM reg WHERE email='$email' LIMIT 1";
   $result = mysqli_query($db, $user_check_query);
   $user = mysqli_fetch_assoc($result);
   
   if ($user)
   {
      array_push($errors, "email already exists");
   }

   $user_check_query2 = "SELECT * FROM reg WHERE uname='$username' LIMIT 1";
   $result2 = mysqli_query($db, $user_check_query2);
   $user2 = mysqli_fetch_assoc($result2);
   
   if ($user2)
   {
      array_push($errors, "Username already exists");
   }
 
   if (count($errors) == 0)
   {
      $password = md5($password_1);
 
      $query = "INSERT INTO reg (uname, email, password_1) 
              VALUES('$username', '$email', '$password')";
      mysqli_query($db, $query);
      $_SESSION['success'] = "You are now logged in";
      header("location: index.php?notify=inSuccess");
      exit();
   }
 }


// LOGIN USER
if (isset($_POST['login'])) {
   $username = mysqli_real_escape_string($db, $_POST['uname']);
   $password = mysqli_real_escape_string($db, $_POST['pass']);
 
   if (empty($username)) {
      array_push($errors, "Username is required");
   }
   if (empty($password)) {
      array_push($errors, "Password is required");
   }
   if (count($errors) == 0) {
      $password = md5($password);
      $query = "SELECT * FROM reg WHERE email='$username' AND password_1='$password'";
      $results = mysqli_query($db, $query);
      $row2 = $results->fetch_assoc();
      if (mysqli_num_rows($results) == 1) {
        $_SESSION['unameG2'] = $username;
        header('location: home.php');
      }else {
         array_push($errors, " Wrong username/password combination");
      }
   }
 }

 

 if(isset($_POST["dob"]) && isset($_POST["country"]) && isset($_POST["state"]) && isset($_POST["zip"]))
 {
   $dob = $_POST['dob'];
   $dobDateTime = new DateTime($dob);
   $now = new DateTime();
   $interval = $dobDateTime->diff($now);
   $Age = $interval->y;

   $country = $_POST['country'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];

        $query = "UPDATE reg SET dob = ?, age = ?, country = ?, stat = ?, zip = ? WHERE email = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ssssss", $dob, $Age, $country, $state, $zip, $_SESSION['unameG2']);
        $stmt->execute();
        $stmt->close();

      
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>User Authentication</title>
</head>
<body>
  <form method="post">
    Enter Your Details Here:<br>
    <input type="text" name="username"><br>
    <input type="password" name="password"><br>
    <input type="submit" name="submit">
  </form>
  
  <div>
    <form action='#' method="post">       
      <h2>User Login</h2><br/>
      <input type="text" name="username" placeholder="username" required="" /><br/>
      <input type="password" name="password" placeholder="Password" required=""/><br/>
      <button type="submit">Login</button>  
    </form>
  </div> 
</body>
</html>

<?php
              
if(isset($_POST['Submit-Button']))
    {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $text = $username . "," . $password . "\n";
    $fp = fopen('users.txt', 'a+');

    if(fwrite($fp, $text))  {
        echo 'Saved';
    }
fclose($fp);
}
    
    function check_password($username, $password){
        $pwd_file = 'users.txt';
        if(!$fh = fopen($pwd_file, "r")) {die("<p>Could not open password file");}
        $match = 0;
        $pwd = md5($password);
        while(!feof($fh)) {
          $line = fgets($fh, 4096);
          $user_pass = explode(":", $line);
          if($user_pass[0] == $username) {
            if(rtrim($user_pass[1]) == $pwd) {
              $match = 1;
              break;
            }
          }
          $match = 2; 
        }
        if($match == '1') {
           echo "<b>Login Success!</b>";
        } 
        if($match == '2') {
           echo "<b>Login Failed!</b>";
        } 
        fclose($fh);
    }
    if($_POST['username']) {
        check_password($_POST['username'], $_POST['password']);
    }
?>


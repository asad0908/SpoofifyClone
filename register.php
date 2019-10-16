<?php 
include("includes/class/Account.php"); 
include("includes/class/Constants.php"); 
$account = new Account();
?>
<?php include("includes/handlers/register-handler.php"); ?>
<?php include("includes/handlers/login-handler.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to slotify</title>
</head>
<body>
    <div id="inputContainer">
     <form action="register.php" method='POST' id="loginForm">
      <h2>Login to your account</h2>
      <p>
       <label for="loginUsername">Username</label>
       <input id="loginUsername" name="loginUsername" placeholder="e.g. John Doe" required type="text" autocomplete="off">
      </p>
      <p>
       <label for="loginPassword">Password</label>
       <input id="loginPassword" name="loginPassword" required type="password" placeholder="Your Password" autocomplete="off">
      </p>
      <button type="submit" name="loginButton">LOG IN</button>
     </form>
     
     <form action="register.php" method='POST' id="registerForm">
      <h2>Create Your Free Account</h2>
      <p>
      <?php echo $account->getError(Constants::$usernameLength) ?>
       <label for="username">Username</label>
       <input id="username" name="username" placeholder="e.g. John Doe" required type="text" autocomplete="off">
      </p>
      <p>
      <?php echo $account->getError(Constants::$firstnameLength) ?>
       <label for="firstName">First name</label>
       <input id="firstName" name="firstName" placeholder="e.g. John" required type="text" autocomplete="off">
      </p>
      <p>
      <?php echo $account->getError(Constants::$lastnameLenght) ?>
       <label for="lastName">Last name</label>
       <input id="lastName" name="lastName" placeholder="e.g. Doe" required type="text" autocomplete="off">
      </p>
      <p>
      <?php echo $account->getError(Constants::$emailInvalid) ?>
      <?php echo $account->getError(Constants::$emailMatch) ?>
       <label for="email">Email</label>
       <input id="email" name="email" placeholder="e.g. doe@gmail.com" required type="email" autocomplete="off">
      </p>
      <p>
       <label for="email2">Confirm Email</label>
       <input id="email2" name="email2" placeholder="e.g. doe@gmail.com" required type="email" autocomplete="off">
      </p>
      <p>
      <?php echo $account->getError(Constants::$passwordAlpha) ?>
      <?php echo $account->getError(Constants::$passwordLenght) ?>
      <?php echo $account->getError(Constants::$passwordMatch) ?>
       <label for="password">Password</label>
       <input id="password" name="password" required type="password" placeholder="Your Password" autocomplete="off">
      </p>
      <p>
       <label for="password2">Confirm Password</label>
       <input id="password2" name="password2" required type="password" placeholder="Confirm Password" autocomplete="off">
      </p>
      <button type="submit" name="registerButton">SIGN UP</button>
     </form>
    </div>
</body>
</html>
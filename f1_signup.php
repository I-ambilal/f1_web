<?php
include "f1_connection.php";

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, gender, age, email, password)
            VALUES ('$fname', '$lname', '$gender', $age, '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        $success = "✅ Signup successful. <a href='f1_login.php'>Login now</a>";
    } else {
        $error = "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>F1 Signup</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      background-color: #0d0d0d;
      color: white;
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .signup-box {
      background-color: #1a1a1a;
      padding: 40px;
      border-radius: 14px;
      box-shadow: 0 0 25px rgba(255, 0, 0, 0.3);
      width: 400px;
    }

    .signup-box h2 {
      text-align: center;
      color: #e10600;
      margin-bottom: 25px;
    }

    .signup-box input, .signup-box select {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      background-color: #333;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 15px;
    }

    .signup-box input[type="submit"] {
      background-color: #e10600;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .signup-box input[type="submit"]:hover {
      background-color: #ff1a1a;
    }

    .signup-box a {
      color: #999;
      text-decoration: none;
    }

    .signup-box a:hover {
      color: white;
    }

    .message {
      text-align: center;
      margin-bottom: 15px;
      font-size: 14px;
    }

    .success {
      color: #00cc66;
    }

    .error {
      color: #ff3333;
    }
  </style>
</head>
<body>

  <div class="signup-box">
    <h2>Sign Up</h2>

    <?php if ($success): ?>
      <div class="message success"><?= $success ?></div>
    <?php elseif ($error): ?>
      <div class="message error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <input type="text" name="fname" placeholder="First Name" required>
      <input type="text" name="lname" placeholder="Last Name" required>
      <select name="gender" required>
        <option disabled selected>Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
      <input type="number" name="age" placeholder="Age" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Sign Up">
    </form>

    <div style="text-align:center; margin-top:15px;">
      Already have an account? <a href="f1_login.php">Login</a>
    </div>
  </div>

</body>
</html>

<?php
session_start();
include "f1_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $pass = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if ($user && password_verify($pass, $user["password"])) {
        $_SESSION["userid"] = $user["id"];
        header("Location: f1.html");
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>F1 Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #0d0d0d;
      font-family: 'Poppins', sans-serif;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .login-box {
      background-color: #1a1a1a;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 0 30px rgba(255, 0, 0, 0.3);
      width: 350px;
    }

    .login-box h2 {
      text-align: center;
      color: #e10600;
      margin-bottom: 30px;
    }

    .login-box input[type="email"],
    .login-box input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: none;
      border-radius: 8px;
      background-color: #333;
      color: white;
      font-size: 16px;
    }

    .login-box input[type="submit"] {
      width: 100%;
      background-color: #e10600;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 8px;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      margin-top: 10px;
      transition: background 0.3s ease;
    }

    .login-box input[type="submit"]:hover {
      background-color: #ff1e1e;
    }

    .login-box a {
      color: #999;
      text-decoration: none;
      display: block;
      text-align: center;
      margin-top: 14px;
      font-size: 14px;
    }

    .login-box a:hover {
      color: #fff;
      text-decoration: underline;
    }

    .error {
      color: #ff4d4d;
      text-align: center;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <div class="login-box">
    <h2>F1 Login</h2>

    <?php if (isset($error)): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Login">
      <a href="f1_signup.php">Don't have an account? Sign up</a>
    </form>
  </div>

</body>
</html>

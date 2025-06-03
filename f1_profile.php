<?php
session_start();
include "f1_connection.php";

if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION["userid"];
$result = $conn->query("SELECT * FROM users WHERE id=$id");
$user = $result->fetch_assoc();

$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];

    $conn->query("UPDATE users SET 
      first_name='$fname', 
      last_name='$lname', 
      gender='$gender', 
      age=$age 
      WHERE id=$id");

    $success = "✅ Profile updated!";
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc(); // Refresh user data
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Profile - F1 Style</title>
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

    .edit-box {
      background-color: #1a1a1a;
      padding: 40px;
      border-radius: 14px;
      box-shadow: 0 0 25px rgba(255, 0, 0, 0.3);
      width: 380px;
    }

    .edit-box h2 {
      text-align: center;
      color: #e10600;
      margin-bottom: 25px;
    }

    .edit-box input, .edit-box select {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      background-color: #333;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 15px;
    }

    .edit-box input[type="submit"] {
      background-color: #e10600;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .edit-box input[type="submit"]:hover {
      background-color: #ff1a1a;
    }

    .edit-box a {
      display: block;
      margin-top: 16px;
      text-align: center;
      color: #999;
      text-decoration: none;
      font-size: 14px;
    }

    .edit-box a:hover {
      color: #fff;
    }

    .message {
      text-align: center;
      margin-bottom: 10px;
      color: #00cc66;
    }
  </style>
</head>
<body>

  <div class="edit-box">
    <h2>Edit Profile</h2>

    <?php if ($success): ?>
      <div class="message"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST">
      <input type="text" name="fname" placeholder="First Name" value="<?= htmlspecialchars($user['first_name']) ?>" required>
      <input type="text" name="lname" placeholder="Last Name" value="<?= htmlspecialchars($user['last_name']) ?>" required>
      <select name="gender" required>
        <option value="Male" <?= $user['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= $user['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
      </select>
      <input type="number" name="age" placeholder="Age" value="<?= htmlspecialchars($user['age']) ?>" required>
      <input type="submit" value="Update Profile">
    </form>

    <a href="f1.html">🏁 Back to Home</a>
  </div>

</body>
</html>

<?php
include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (fullname, username, password, role)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fullname, $username, $hashed_password, $role);

    if ($stmt->execute()) {
        $message = "Registration successful!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>TradeSphere Registration</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f5f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-box {
            background: white;
            padding: 30px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            color: #1d3557;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #1d3557;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #457b9d;
        }

        .message {
            text-align: center;
            color: green;
        }

        .login {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>

<div class="register-box">

    <h2>TradeSphere</h2>
    <p style="text-align:center;">Create your account</p>

    <?php if ($message != ""): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">

        <input type="text"
               name="fullname"
               placeholder="Full Name"
               required>

        <input type="text"
               name="username"
               placeholder="Username"
               required>

        <input type="password"
               name="password"
               placeholder="Password"
               required>

        <select name="role" required>
            <option value="">Select Role</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit">Register</button>

    </form>

    <div class="login">
        Already have an account?
        <a href="login.php">Login</a>
    </div>

</div>

</body>
</html>
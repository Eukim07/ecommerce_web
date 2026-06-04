<?php
session_start();
require("../config/db.php");
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $generic_error = "<p class='error-msg'>Invalid email or password.</p>";

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                // ROLE REDIRECT SWITCH MATRIX
                if ($_SESSION['role'] === 'admin') {
                    header("Location: ../pages/dashboard.php");
                } else {
                    header("Location: ../pages/homepage.php");
                }
                exit;
            } else {
                $message = $generic_error;
            }
        } else {
            $message = $generic_error;
        }
        $stmt->close();
    } else {
        $message = "<p class='error-msg'>Please fill in all fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Eukim Motors</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(../assets/black.jpg) no-repeat center center fixed;
            background-size: cover;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .login-logo {
            max-width: 120px; 
            height: auto;     
            margin-bottom: 15px;
            object-fit: contain;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 24px;
            color: #333;
            font-size: 24px;
            font-weight: 600;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-msg {
            color: #d9534f;
            background-color: #f2dede;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        p {
            margin-top: 25px;
            font-size: 14px;
            color: #555;
        }

        a {
            color: #007BFF;
            text-decoration: none;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <img src="../assets/logo.png" alt="Logo" class="login-logo">
        
        <h2>Login</h2>
        
        <?php echo $message; ?>
        
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>

</body>
</html>
<?php
include("../config/db.php");

$message = "";
$error = "";

if (isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // CHECK IF EMAIL EXISTS
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();

    $result = $check->get_result();

    if ($result->num_rows > 0) {

        $error = "Email already exists!";

    } else {

        // INSERT USER
      $stmt = $conn->prepare("INSERT INTO users(username, email, password) VALUES(?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {

            $message = "User registered successfully!";

        } else {

            $error = "Something went wrong!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Eukim Motors</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            /* INTEGRATED PREMIUM AUTOMOTIVE BACKGROUND IMAGE */
            background-image: url('https://images.unsplash.com/photo-1617788138017-80ad40651399?auto=format&fit=crop&w=1920&q=80'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            margin: 0;
            padding: 20px;
        }

        .register-card {
            width: 100%;
            max-width: 500px;
            /* Dark semi-transparent color so text is readable over your image */
            background: rgba(26, 26, 26, 0.95); 
            color: #ffffff;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .logo-image-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .brand-logo {
            max-width: 180px;    
            height: auto;        
            display: inline-block;
        }

        .form-label {
            color: #e0e0e0;
            font-weight: 500;
        }

        .btn-custom {
            border-radius: 10px;
            padding: 12px;
            font-weight: bold;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            background-color: #2b2b2b;
            border: 1px solid #444;
            color: #fff; /* Ensures text color is white when typed */
        }

        /* Changes the input text typing color to white on focus/active */
        .form-control:focus {
            background-color: #333;
            color: #fff;
            border-color: #0d6efd;
            box-shadow: none;
        }

        /* Makes the login link clear against the dark card background */
        .login-link {
            color: #3aa0ff !important;
        }
    </style>
</head>
<body>

<div class="register-card">

    <div class="logo-image-container">
        <img src="../assets/logo.png" alt="Eukim Motors Logo" class="brand-logo">
    </div>

    <?php if($message != "") { ?>
        <div class="alert alert-success">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <?php if($error != "") { ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   placeholder="Enter your full name"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="Enter your email"
                   required>
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Create password"
                   required>
        </div>

        <button type="submit"
                name="register"
                class="btn btn-primary btn-custom w-100">
            Create Account
        </button>

    </form>

    <div class="text-center mt-4">
        <small>
            Already have an account?
            <a href="login.php" class="text-decoration-none login-link">
                Login
            </a>
        </small>
    </div>

</div>

</body>
</html>
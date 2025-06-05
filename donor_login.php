<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Donor Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #0a0909;
      padding: 50px;
    }

    .container {
      max-width: 800px;
      margin: auto;
      background-color: grey;
      padding: 80px;
      border-radius: 8px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #fdd835;
      border: none;
      color: white;
      font-size: 16px;
      cursor: pointer;
      border-radius: 4px;
    }

    button:hover {
      background-color: #fbc02d;
    }

    .link {
      display: block;
      text-align: center;
      margin-top: 10px;
    }

    .link a {
      text-decoration: none;
      color: #0819d1;
    }
  </style>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    // Connect to database
    $conn = new mysqli("localhost", "root", "Rishika@1", "ngo_donors");
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Get form input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate credentials
    $sql = "SELECT * FROM donors WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
      $row = $result->fetch_assoc();

      // Check hashed password
      if (password_verify($password, $row['password'])) {
        $_SESSION['donor_name'] = $row['first_name'];
        header("Location: donor_home.html");
        exit();
      } else {
        echo "Incorrect password.";
      }
    } else {
      echo "No user found with that email.";
    }

    $conn->close();
  }
  ?>
</head>

<body>
  <div class="container">
    <h2>DONOR LOGIN</h2>
    <form action="donor_login.php" method="post">
      <input type="email" name="email" placeholder="Enter your email" required />
      <input type="password" name="password" placeholder="Enter your password" required />
      <a href="donor_home.html"><button type="submit">LOGIN</a></button>
    </form>
    <div class="link">
      <a href="new_donor_registration.html">New Donor Registration</a>
    </div>
  </div>
</body>

</html>
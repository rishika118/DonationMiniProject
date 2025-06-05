<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #19191c;
      padding: 50px;
    }

    .container {
      max-width: 800px;
      margin: auto;
      background-color: white;
      padding: 80px;
      border-radius: 10px;
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
  </style>
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $admin_name = $_POST['admin_name'];
      $admin_password = $_POST['admin_password'];

      if ($admin_name === 'admin' && $admin_password === '1234') {
          // Valid credentials — show admin dashboard
          echo "<script>window.location.href='admin_dashboard.html';</script>";
      } else {
          echo "<script>alert('Invalid credentials!'); window.location.href='admin_login.php';</script>";
      }
    }
  ?>
</head>
<body>
  <div class="container">
    <h2>ADMIN LOGIN</h2>
    <form action="admin_login.php" method="post">
      <input type="text" name="admin_name" placeholder="Enter Admin Name" required />
      <input type="password" name="admin_password" placeholder="Enter Password" required />
      <button type="submit">LOGIN</button>
    </form>
  </div>
</body>
</html>

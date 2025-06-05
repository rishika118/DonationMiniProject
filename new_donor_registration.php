<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>New Donor Registration</title>
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
  // Database connection
  $servername = "localhost"; // Your database server
  $username = "root"; // Your database username
  $password = "Rishika@1"; // Your database password
  $dbname = "ngo_donors"; // Your database name

  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check for connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Get data from form
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Password hashing

  // SQL query to insert data
  $sql = "INSERT INTO donors (first_name, last_name, email, phone, address, password) 
        VALUES ('$first_name', '$last_name', '$email', '$phone', '$address', '$password')";

  if ($conn->query($sql) === TRUE) {
    echo "<center><h2>New Donor Registered Successfully!</h2></center>";
    echo "<center><a href='donor_login.html'><button style='padding:10px 20px; font-size:16px; background-color:#4CAF50; color:white; border:none; border-radius:5px; cursor:pointer;'>Login</button></a></center>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
  ?>
</head>

<body>
  <div class="container">
    <h2>New Donor Registration</h2>
    <form action="new_donor_registration.php" method="post">
      <input type="text" name="first_name" placeholder="First Name" required />
      <input type="text" name="last_name" placeholder="Last Name" required />
      <input type="email" name="email" placeholder="Email" required />
      <input type="text" name="phone" placeholder="Phone Number" required />
      <input type="text" name="address" placeholder="Address" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">REGISTER</button>
    </form>
  </div>
</body>

</html>
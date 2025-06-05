<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Charity Registration</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef1f5;
      padding: 50px;
    }

    .container {
      max-width: 600px;
      margin: auto;
      background-color: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    input,
    button {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
    }
  </style>
  <?php
  // Database connection
  $servername = "localhost";
  $username = "root";
  $password = "Rishika@1";
  $dbname = "ngo_donors"; // Replace with your actual DB name

  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Get form data
  $charity_name = $_POST['charity_name'];
  $charity_cause = $_POST['charity_cause'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure hash

  // Insert into database
  $sql = "INSERT INTO charities (charity_name, charity_cause, email, phone, address, password)
        VALUES ('$charity_name', '$charity_cause', '$email', '$phone', '$address', '$password')";

  if ($conn->query($sql) === TRUE) {
    echo "<div style='text-align: center; font-family: Arial; margin-top: 100px;'>
            <h2>Charity registered successfully!</h2>
            <a href='charity_login.html'>
              <button style='padding: 10px 20px; font-size: 16px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;'>
                Go to Login
              </button>
            </a>
          </div>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
  ?>
</head>

<body>
  <div class="container">
    <h2>Charity Registration</h2>
    <form action="charity_register.php" method="post">
      <input type="text" name="charity_name" placeholder="Charity Name" required>
      <input type="text" name="charity_cause" placeholder="Charity Cause" required>
      <input type="email" name="email" placeholder="Email ID" required>
      <input type="text" name="phone" placeholder="Phone Number" required>
      <input type="text" name="address" placeholder="Address" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">REGISTER</button>
    </form>
  </div>
</body>

</html>
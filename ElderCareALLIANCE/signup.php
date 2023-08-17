<?php
$servername = "localhost";
$username = 'root';
$password = '';
$dbname = "webapp_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$signupMessage = ""; // For displaying success/error messages

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"])) {
    $email = $_POST["email"];
    $firstName = $_POST["first-name"];
    $lastName = $_POST["last-name"];
    $address = $_POST["address"];
    $contactNumber = $_POST["contact-number"];
    $password = $_POST["password"];

    // You should perform proper validation and sanitization here

    // Check if the email already exists
    $checkEmailQuery = "SELECT id FROM users WHERE email = '$email'";
    $emailResult = $conn->query($checkEmailQuery);

    if ($emailResult->num_rows > 0) {
        $signupMessage = "Error: Email already exists.";
    } else {
        // Insert the new user data
        $insertQuery = "INSERT INTO users (email, first_name, last_name, address, contact_number, password)
                        VALUES ('$email', '$firstName', '$lastName', '$address', '$contactNumber', '$password')";

        if ($conn->query($insertQuery) === TRUE) {
            $signupMessage = "Account created successfully";
        } else {
            $signupMessage = "Error creating account: " . $conn->error;
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
	
	<title>Signup Page</title>    
    <script>
        function togglePasswordVisibility(inputId, checkboxId) {
          var input = document.getElementById(inputId);
          var checkbox = document.getElementById(checkboxId);
          if (input && checkbox) {
            if (checkbox.checked) {
              input.type = "text";
            } else {
              input.type = "password";
            }
          }
        }
      </script>
</head>
<body>
    

    <header>
        <h2 class="logo">
                <img src="logo.png" alt="Logo">
        </h2> 
        <div class="address">Sta. Ana -  San Joaquin Bahay Ampunan Foundation Inc. 
            <div class="sub">Barangay Altura Bata, Tanauan, 4232</div> 
        </div>

        <nav class="navigation">
            <button class="btnLogin-popup" onclick="gotologin()">LOGIN</button>
            <script>
                function gotologin() {
                    window.location.href = "login.php";
                }
            </script>
        </nav> 
        <style>
            /* Add your custom styles here */
            .password-icon {
              cursor: pointer;
            }
          </style>
          <script>
            function togglePasswordVisibility(fieldId, iconId) {
              const field = document.getElementById(fieldId);
              const icon = document.getElementById(iconId);
              
              if (field.type === "password") {
                field.type = "text";
                icon.textContent = "Hide"; // Unicode for an "invisible" icon
              } else {
                field.type = "password";
                icon.textContent = "👁️"; // Unicode for an "eye" icon
              }
            }
          </script>
    </header>
    <div class ="banner">
   
        <h1 class="logo1">
        <img src="glogo.png" alt="Logo"></h1> 
        <div class="wrapper">
            <div class="form-box">  
                    <h2>Create Your Account</h2>
                    <h3>Create an account to donate</h3 >
                   
                <form action="signup.php" method="POST">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required><br><br>
                        
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first-name" required>
                        
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last-name" required><br><br>
                        
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" required><br><br>
                        
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" name="contact-number" list="country-codes" required>
                        <datalist id="country-codes">
                          <option value="+1">USA (+1)</option>
                          <option value="+44">UK (+44)</option>
                          <option value="+49">Germany (+49)</option>
                          <option value="+33">France (+33)</option>
                          <option value="+81">Japan (+81)</option>
                          <option value="+86">China (+86)</option>
                          <option value="+91">India (+91)</option>
                          <option value="+61">Australia (+61)</option>
                          <option value="+55">Brazil (+55)</option>
                          <option value="+7">Russia (+7)</option>
                          <option value="+82">South Korea (+82)</option>
                          <option value="+39">Italy (+39)</option>
                          <option value="+34">Spain (+34)</option>
                          <option value="+52">Mexico (+52)</option>
                          <option value="+971">United Arab Emirates (+971)</option>
                          <option value="+234">Nigeria (+234)</option>
                          <option value="+27">South Africa (+27)</option>
                          <option value="+966">Saudi Arabia (+966)</option>
                          <option value="+63">Philippines (+63)</option>
                          <!-- Add more countries as needed -->
                        </datalist>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required">
                        <span class="password-icon1" id="password-icon" onclick="togglePasswordVisibility('password', 'password-icon')">👁️</span><br><br>
                        
                        <label for="confirm-password">Confirm Password:</label>
                        <input type="password" id="confirm-password" name="confirm-password" required">
                        <span class="password-icon2" id="confirm-password-icon" onclick="togglePasswordVisibility('confirm-password', 'confirm-password-icon')">👁️</span><br><br>
                        
                        <button type="submit" name="signup">Create new account</button>
                </form>  
                <h4>
                        <?php
                          if (!empty($signupMessage)) {
                          if (strpos($signupMessage, "Error") !== false) {
                            echo "<p class='message_error'>$signupMessage</p>";
                          } else {
                            echo "<p class='message_success'>$signupMessage</p>";
                          }
                          }
                        ?>
                        </h4>
              </div>   
            </div>
        </div>
        <div class="bg">  
        </div>      
    </div>  
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
   
</body> 
</html>
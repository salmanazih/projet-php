<?php
session_start();
include("database.php");

$ErrorUsernameSU = "";
$ErrorEmailSU = "";
$ErrorPassSU = "";
$ErrorConfirmSU = "";
$displaySignUp = false;

// Initialize variables to retain form inputs
$usernameValueSU = $emailValueSU = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $displaySignUp = true; 

    $usernameValueSU = trim($_POST['usernameSU']);
    $emailValueSU = trim($_POST['emailSU']);
    $passValueSU = $_POST['passwordSU'];
    $ConfirmValueSU = $_POST['ConfirmSU'];

    // Validate inputs
    if (empty($usernameValueSU)) {
        $ErrorUsernameSU = "Username must be filled";
    }
    if (empty($emailValueSU)) {
        $ErrorEmailSU = "Email must be filled";
    } elseif (!filter_var($emailValueSU, FILTER_VALIDATE_EMAIL)) {
        $ErrorEmailSU = "Invalid email format";
    }
    if (empty($passValueSU)) {
        $ErrorPassSU = "Password must be filled";
    } elseif (strlen($passValueSU) < 8) {
        $ErrorPassSU = "Password must contain at least 8 characters";
    } elseif (!preg_match("/[A-Z]+/", $passValueSU)) {
        $ErrorPassSU = "Password must contain at least one capital letter";
    }
    if (empty($ConfirmValueSU)) {
        $ErrorConfirmSU = "Confirm password must be filled";
    }
    if ($passValueSU !== $ConfirmValueSU) {
        $ErrorConfirmSU = "Passwords do not match";
    }

    // If no validation errors, proceed
    if (empty($ErrorUsernameSU) && empty($ErrorEmailSU) && empty($ErrorPassSU) && empty($ErrorConfirmSU)) {
        // Check if the email already exists
        $checkEmailStmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        if ($checkEmailStmt) {
            $checkEmailStmt->bind_param("s", $emailValueSU);
            $checkEmailStmt->execute();
            $result = $checkEmailStmt->get_result();

            if ($result->num_rows > 0) {
                $ErrorEmailSU = "Email already registered";
            } else {
                // If email is unique, insert the new user
                $hpassword = password_hash($passValueSU, PASSWORD_DEFAULT);
                $insertStmt = $conn->prepare("INSERT INTO users (username, email, hpassword) VALUES (?, ?, ?)");
                if ($insertStmt) {
                    $insertStmt->bind_param("sss", $usernameValueSU, $emailValueSU, $hpassword);
                    if ($insertStmt->execute()) {
                        // Optionally, log the sign-up attempt
                        // Redirect to sign-in page
                        header("Location: signin.php");
                        exit;
                    } else {
                        echo "Error inserting data: " . $conn->error;
                    }
                    $insertStmt->close();
                } else {
                    echo "Prepare failed: " . $conn->error;
                }
            }
            $checkEmailStmt->close();
        } else {
            echo "Prepare failed: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In & Sign Up</title>
    <style>
        /* Your existing CSS styles */
        /* ... */
    </style>
</head>
<body>

<div class="form-container">
    <div class="form-box sign-in-box" <?php if ($displaySignUp) echo 'style="display: none;"'; ?>>
        <h2>Sign In</h2>
        <form id="signInForm" method="post">
            <div class="input-group">
                <label for="signInEmail">Email</label>
                <input type="email" id="signInEmail" name="emailSI" placeholder="Enter your email" value="<?php if(isset($emailValueSU)) echo htmlspecialchars($emailValueSU); ?>">
                <span style="color: red"><?php echo $ErrorEmailSI; ?></span>
            </div>
            <div class="input-group">
                <label for="signInPassword">Password</label>
                <input type="password" id="signInPassword" name="passwordSI" placeholder="Enter your password">
                <span style="color: red"><?php echo $ErrorPassSI; ?></span>
            </div>
            <button type="submit" class="btn" name="signin">Sign In</button>
            <p class="switch-form" onclick="toggleForm()">Don't have an account? Sign Up</p>
        </form>
    </div>

    <div class="form-box sign-up-box" <?php if (!$displaySignUp) echo 'style="display: none;"'; ?>>
        <h2>Sign Up</h2>
        <form id="signUpForm" method="post">
            <div class="input-group">
                <label for="signUpUsername">Username</label>
                <input type="text" id="signUpUsername" name="usernameSU" placeholder="Enter your username" value="<?php echo htmlspecialchars($usernameValueSU); ?>">
                <span style="color: red"><?php echo $ErrorUsernameSU; ?></span>
            </div>
            <div class="input-group">
                <label for="signUpEmail">Email</label>
                <input type="email" id="signUpEmail" name="emailSU" placeholder="Enter your email" value="<?php echo htmlspecialchars($emailValueSU); ?>">
                <span style="color: red"><?php echo $ErrorEmailSU; ?></span>
            </div>
            <div class="input-group">
                <label for="signUpPassword">Password</label>
                <input type="password" id="signUpPassword" name="passwordSU" placeholder="Enter your password">
                <span style="color: red"><?php echo $ErrorPassSU; ?></span>
            </div>
            <div class="input-group">
                <label for="signUpPasswordConfirm">Confirm Password</label>
                <input type="password" id="signUpPasswordConfirm" name="ConfirmSU" placeholder="Confirm your password">
                <span style="color: red"><?php echo $ErrorConfirmSU; ?></span>
            </div>
            <button type="submit" class="btn" name="signup">Sign Up</button>
            <p class="switch-form" onclick="toggleForm()">Already have an account? Sign In</p>
        </form>
    </div>
</div>

<script>
    function toggleForm() {
        const signInBox = document.querySelector('.sign-in-box');
        const signUpBox = document.querySelector('.sign-up-box');

        if (signInBox.style.display === 'none') {
            signInBox.style.display = 'block';
            signUpBox.style.display = 'none';
        } else {
            signInBox.style.display = 'none';
            signUpBox.style.display = 'block';
        }
    }
</script>

</body>
</html>

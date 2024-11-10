<?php
session_start();

$ErrorEmailSI = "";
$ErrorPassSI = "";
$ErrorUsernameSU = "";
$ErrorEmailSU = "";
$ErrorPassSU = "";
$ErrorConfirmSU = "";
$displaySignUp = false;
$ErrorEmailSI = $ErrorPassSI = "";
include("database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['signin'])) {
        
        // Traitement du formulaire Sign In
        $emailValueSI = $_POST['emailSI'];
        $passValueSI = $_POST['passwordSI'];
        
        if (empty($emailValueSI)) {
            $ErrorEmailSI = "Email must be filled";
        }
        if (empty($passValueSI)) {
            $ErrorPassSI = "Password must be filled";
        }

        if (!empty($emailValueSI) && !empty($passValueSI)) {
            
            $stmt = $conn->prepare("SELECT email, hpassword FROM users WHERE email = ?");
            $stmt->bind_param("s", $emailValueSI); // "s" means the email parameter is a string
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
            
                // Check if user exists and verify the password
                if ($user && password_verify($passValueSI, $user['hpassword'])) {
                    $_SESSION['email'] = $emailValueSI; // Store user email in session
                    header("Location: home.php");
                    exit;
                } else {
                    $ErrorPassSI = "Invalid password";
                }
            } else {
                $ErrorEmailSI = "Invalid email";
            }
              
            
        } 
    } elseif (isset($_POST['signup'])) {
        $displaySignUp = true; 

        $usernameValueSU = $_POST['usernameSU'];
        $emailValueSU = $_POST['emailSU'];
        $passValueSU = $_POST['passwordSU'];
        $ConfirmValueSU = $_POST['ConfirmSU'];

        if (empty($usernameValueSU)) {
            $ErrorUsernameSU = "Username must be filled";
        }
        if (empty($emailValueSU)) {
            $ErrorEmailSU = "Email must be filled";
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

        if (empty($ErrorUsernameSU) && empty($ErrorEmailSU) && empty($ErrorPassSU) && empty($ErrorConfirmSU)) {
            include("database.php");
            $hpassword = password_hash($passValueSU, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, hpassword) 
                    VALUES ('$usernameValueSU', '$emailValueSU', '$hpassword')";

            if (mysqli_query($conn, $sql)) {
                echo "Nouvel utilisateur ajouté avec succès!";
                header("location:signin.php");
                exit;
            } else {
                echo "Erreur lors de l'insertion des données: " . mysqli_error($conn);
            }
        } else {
            $displaySignUp = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signin&signup</title>
    <style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-image: url(./imagesweb/large_82015fcee9.jpg);
}

.form-container {
    background-color: transparent;
    border-radius: 15px;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 400px;
    max-width: 100%;
    padding: 2em;
    transition: all 0.3s ease;
}


.form-box {
    display: none;
}

.sign-in-box,
.sign-up-box {
    display: block;
}

.form-box h2 {
    font-size: 1.8rem;
    color: orange;
    margin-bottom: 1rem;
    text-align: center;
}


.input-group {
    margin-bottom: 1rem;
}

.input-group label {
    display: block;
    font-size: 0.9rem;
    color: orange;
    margin-bottom: 0.3rem;
}

.input-group input {
    width: 100%;
    padding: 0.5rem;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
    transition: all 0.2s ease-in-out;
}

.input-group input:focus {
    border-color: black;
}

.btn {
    width: 100%;
    padding: 0.7rem;
    background-color: rgb(64, 19, 19);
    color: white;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
}

.btn:hover {
    background-color: #ff4757;
}


.switch-form {
    text-align: center;
    margin-top: 1rem;
    font-size: 0.9rem;
    color: #666;
    cursor: pointer;
    transition: color 0.2s;
}

.switch-form:hover {
    color: #ff6b6b;
}


#signInError {
    color: #ff4757;
    font-size: 0.9rem;
    margin-top: 0.5rem;
    text-align: center;
}


@media (max-width: 420px) {
    .form-container {
        width: 90%;
        padding: 1.5em;
    }
}


    </style>
</head>
<body>

<div class="form-container">
    <div class="form-box sign-in-box" <?php if ($displaySignUp) echo 'style="display: none;"'; ?>>
        <h2>Sign In</h2>
        <form id="signInForm" method='post'>
            <div class="input-group">
                <label for="signInEmail">Email</label>
                <input type="email" id="signInEmail" name="emailSI" placeholder="Enter your email" value="<?php if(isset($emailValueSU)) echo htmlspecialchars($emailValueSU); ?>">
                <span style="color: red"><?php echo $ErrorEmailSI?></span>
            </div>
            <div class="input-group">
                <label for="signInPassword">Password</label>
                <input type="password" id="signInPassword" name="passwordSI" placeholder="Enter your password">
                <span style="color: red"><?php echo $ErrorPassSI?> </span>
            </div>
            <button type="submit" class="btn" name="signin">Sign In</button>
            <p class="switch-form" onclick="toggleForm()">Don't have an account? Sign Up</p>
        </form>
    </div>

    <div class="form-box sign-up-box"  <?php if (!$displaySignUp) echo 'style="display: none;"'; ?>>
        <h2>Sign Up</h2>
        <form id="signUpForm" method='post'>
            <div class="input-group">
                <label for="signUpUsername">Username</label>
                <input type="text" id="signUpUsername" name="usernameSU" placeholder="Enter your username" >
                <span style="color: red"><?php echo $ErrorUsernameSU ?></span>
            </div>
            <div class="input-group">
                <label for="signUpEmail">Email</label>
                <input type="email" id="signUpEmail" name="emailSU" placeholder="Enter your email" >
                <span style="color: red"><?php echo $ErrorEmailSU ?></span>
            </div>
            <div class="input-group">
                <label for="signUpPassword">Password</label>
                <input type="password" id="signUpPassword" name="passwordSU" placeholder="Enter your password">
                <span style="color: red"><?php echo $ErrorPassSU ?></span>
            </div>
            <div class="input-group">
                <label for="signUpPasswordConfirm">Confirm Password</label>
                <input type="password" id="signUpPasswordConfirm" name="ConfirmSU" placeholder="Confirm your password">
                <span style="color: red"><?php echo $ErrorConfirmSU ?></span>
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
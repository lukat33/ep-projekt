<?php
// Connect to the database
include_once 'dbconn.php';
$email = "";
$password = "";
$errors = array();

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else {
//    echo  mysqli_get_host_info($conn);
}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Ensure that form fields are filled properply
    if (empty($email) || empty($password)) {
        // Check empty fields
        array_push($errors, "Manjkajoče uporabniško ime ali geslo");
    }
    else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Check if email is valid
            $email = "";
            array_push($errors, "Email ni pravilen");
        }
        if (strlen($password) < 6) {
            // Password must be at least 6 chars long
            $password = "";
            array_push($errors, "Geslo mora vsebovati vsaj 6 znakov");
        }
    }

    // No errors
    if (count($errors) == 0) {
        // Check if user already exists in database
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);

        if ($rows > 0) {
            if ($row = mysqli_fetch_assoc($result)) {
                // De-hash password
                $hashedPwdCheck = password_verify($password, $row['password']);

                if ($hashedPwdCheck == false) {
                    array_push($errors, "Email/geslo je nepravilno ali ne obstaja");
                } elseif ($hashedPwdCheck == true) {
                    // Successful login, user found in database
                    echo "Success2";
                    $_SESSION['u_id'] = $row['id'];
                    $_SESSION['u_firstname'] = $row['firstname'];
                    $_SESSION['u_lastname'] = $row['lastname'];
                    $_SESSION['u_email'] = $row['email'];
                    header("Location: ../client/index.php");
                    exit();
                }
            }
        } else {
            // User not found in database
            array_push($errors, "Email/geslo je nepravilno ali ne obstaja");
        }
    }
}
?>
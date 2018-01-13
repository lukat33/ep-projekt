<?php
// Connect to the database
include_once 'dbconn.php';
$email = "";
$password = "";
$errors = array();

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Ensure that form fields are filled properply
    if (empty($email) || empty($password)) {
        // Check empty fields
        array_push($errors, "Izpolni vsa vnosna polja.");
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
                    $_SESSION['u_id'] = $row['id'];
                    $_SESSION['u_firstname'] = $row['firstname'];
                    $_SESSION['u_lastname'] = $row['lastname'];
                    $_SESSION['u_email'] = $row['email'];
                    $_SESSION['u_role'] = $row['role'];

                    if ($row['role'] == "customer") {
                        $id = $row['id'];
                        $query = "SELECT * FROM contact_data WHERE user_id='$id'";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        $_SESSION['u_street'] = $row['street'];
                        $_SESSION['u_street_number'] = $row['street_number'];
                        $_SESSION['u_city'] = $row['city'];
                        $_SESSION['u_postal_code'] = $row['postal_code'];
                        $_SESSION['u_phone'] = $row['phone'];
                    } else {
                        // Save login data to logs.txt
                        $txt = $row['firstname'] . ";" . $row['lastname'] . ";" . $row['email'] . ";" . $row['role'] . ";" . date("d-m-Y h:i:sa");
                        $myfile = file_put_contents('../api/logs/login_logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
                    }
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
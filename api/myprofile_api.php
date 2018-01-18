<?php
// Connect to the database
include_once 'dbconn.php';
$firstname = $lastname = "";
$email = "";
$street = $street_number = $city = "";
$postal_code = "";
$phone = "";
$password_1 = $password_2 = "";
$errors = array();
$pwdChange = 0;
$role = $_SESSION['u_role'];

if (isset($_POST['update'])) {
    $firstname = cleanData(mysqli_real_escape_string($conn, $_POST['firstname']));
    $lastname = cleanData(mysqli_real_escape_string($conn, $_POST['lastname']));
    $email = cleanData(mysqli_real_escape_string($conn, $_POST['email']));
    $password_1 = cleanData(mysqli_real_escape_string($conn, $_POST['password_1']));
    $password_2 = cleanData(mysqli_real_escape_string($conn, $_POST['password_2']));
    if ($role == "customer") {
        $street = cleanData(mysqli_real_escape_string($conn, $_POST['street']));
        $street_number = cleanData(mysqli_real_escape_string($conn, $_POST['street_number']));
        $city = cleanData(mysqli_real_escape_string($conn, $_POST['city']));
        $postal_code = cleanData(mysqli_real_escape_string($conn, $_POST['postal_code']));
        $phone = cleanData(mysqli_real_escape_string($conn, $_POST['phone']));
    }

    // Ensure that form fields are filled properply
    if ($role == "customer") {
        if (empty($firstname) || empty($lastname) || empty($email) && empty($street) || empty($city)
            || empty($postal_code) || empty($phone) || empty($street_number)) {
            // Check empty fields
            array_push($errors, "Izpolni vsa vnosna polja");
        } else {
            if (!preg_match("/^[a-žA-Ž]*$/", $firstname) || !preg_match("/^[a-žA-Ž]*$/", $lastname)) {
                // Check if input characters are valid
                $firstname = $lastname = "";
                array_push($errors, "Uporaba prepovedanih znakov");
            }
            if (!is_numeric($postal_code)) {
                $postal_code = "";
                array_push($errors, "Poštna številka mora vsebovati samo numerične znake");
            }
            if (!is_numeric($phone)) {
                $phone = "";
                array_push($errors, "Telefonska številka mora vsebovati samo numerične znake");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Check if email is valid
                $email = "";
                array_push($errors, "Email ni pravilen");
            }
            if (!empty($password_1) || !empty($password_2)) {
                if (strlen($password_1) < 6) {
                    // Password must be at least 6 chars long
                    $password_1 = $password_2 = "";
                    array_push($errors, "Geslo mora vsebovati vsaj 6 znakov");
                }
                if ($password_1 != $password_2) {
                    // Passwords do not match
                    $password_1 = $password_2 = "";
                    array_push($errors, "Gesli se ne ujemata");
                }
                $pwdChange = 1;
            }
        }
    }else {
        if (empty($firstname) || empty($lastname) || empty($email)) {
            // Check empty fields
            array_push($errors, "Izpolni vsa vnosna polja");
        }
        else {
            if (!preg_match("/^[a-žA-Ž]*$/", $firstname) || !preg_match("/^[a-žA-Ž]*$/", $lastname)) {
                // Check if input characters are valid
                $firstname = $lastname = "";
                array_push($errors, "Uporaba prepovedanih znakov");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Check if email is valid
                $email = "";
                array_push($errors, "Email ni pravilen");
            }
            if (!empty($password_1) || !empty($password_2)) {
                if (strlen($password_1) < 6) {
                    // Password must be at least 6 chars long
                    $password_1 = $password_2 = "";
                    array_push($errors, "Geslo mora vsebovati vsaj 6 znakov");
                }
                if ($password_1 != $password_2) {
                    // Passwords do not match
                    $password_1 = $password_2 = "";
                    array_push($errors, "Gesli se ne ujemata");
                }
                $pwdChange = 1;
            }
        }
    }

    // No errors
    if (count($errors) == 0) {
        // Update user in database
        $id = $_SESSION['u_id'];
        // If we are changing password
        if ($pwdChange == 1) {
            $hashedPassword = password_hash($password_1, PASSWORD_DEFAULT);
            $query = "UPDATE users
                  SET firstname='$firstname', lastname='$lastname', email='$email', password='$hashedPassword'
                  WHERE id = $id";
        } else {
            $query = "UPDATE users
                  SET firstname='$firstname', lastname='$lastname', email='$email'
                  WHERE id = $id";
        }
        mysqli_query($conn, $query);
        // Update session variables
        $_SESSION['u_firstname'] = $firstname;
        $_SESSION['u_lastname'] = $lastname;
        $_SESSION['u_email'] = $email;
        if ($_SESSION['u_role'] == "customer") {
            $_SESSION['u_street'] = $street;
            $_SESSION['u_street_number'] = $street_number;
            $_SESSION['u_city'] = $city;
            $_SESSION['u_postal_code'] = $postal_code;
            $_SESSION['u_phone'] = $phone;

            $query = "UPDATE contact_data
                      SET street='$street', street_number='$street_number', city='$city', postal_code='$postal_code', phone='$phone'
                      WHERE user_id = $id";
            mysqli_query($conn, $query);
        }
        if ($pwdChange == 1) {
            include_once('../api/logout_api.php');
            logout();
        }
    }
}
?>
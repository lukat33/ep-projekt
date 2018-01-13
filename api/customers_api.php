<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 11/01/2018
 * Time: 21:14
 */

// Connect to the database
include_once 'dbconn.php';

if (isset($_POST["activated"]) && isset($_POST["id"])) {
    $id =  cleanData(mysqli_real_escape_string($conn, $_POST['id']));
    $activated =  cleanData(mysqli_real_escape_string($conn, $_POST['activated']));
    $query = "UPDATE users SET activated=". $activated ." WHERE id=". $id;
    $result = mysqli_query($conn, $query);
} else {
    $result = mysqli_query($conn, "SELECT * FROM users WHERE role='customer'");
    $count = 1;

    while ($row = mysqli_fetch_array($result)) {
        $activated = $row['activated'] ? "Da" : "Ne";

        echo '<tr id="' . $count . '">
            <th scope="row"> ' . $count . ' </th>
            <td> ' . $row["firstname"] . ' </td>
            <td> ' . $row["lastname"] . ' </td>
            <td> ' . $row['email'] . ' </td>
            <td> ' . $activated . '</td>';

        if ($row["activated"]) {
            echo '<td><div onclick="updateCustomerStatus(' . $row['id'] . ', ' . $row['activated'] . ')" class="btn btn-primary btn-sm" role="button">Deaktiviraj</div></td>';
        } else {
            echo '<td><div onclick="updateCustomerStatus(' . $row['id'] . ', ' . $row['activated'] . ')" class="btn btn-primary btn-sm" role="button">Aktiviraj</div></td>';
        }
        echo '</tr>';
        $count++;
    }
}

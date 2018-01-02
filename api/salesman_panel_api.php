<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 30-Dec-17
 * Time: 17:25
 */


// Connect to the database
include_once 'dbconn.php';

$query = "SELECT * FROM article";
$result = mysqli_query($conn, $query);
$count = 1;

while($row = mysqli_fetch_array($result)) {
    $status = "Deaktiviran";
    if ($row['activated'] == 1) $status = "Aktiviran";

    echo '<tr id="' . $count . '">
        <th scope="row"> ' . $count . ' </th>
        <td> ' . $row['name'] . ' </td>
        <td> <img src="../client/images/' . $row["picture"] . '" class="img-responsive img-thumb"/></div> </td>
        <td> ' . $row['price'] . '€</td>
        <td> ' . $row['description'] . ' </td>
        <td> ' . $status . ' </td>
        <td><a href="../client/article_edit.php?id=' . $row['id'] . '" class="btn btn-info btn-sm" role="button">Uredi</a></td>
    </tr>';
    $count++;
}

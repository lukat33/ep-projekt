<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 30-Dec-17
 * Time: 17:25
 */


// Connect to the database
include_once 'dbconn.php';

if (isset($_POST["action"])) {
    if ($_POST["action"] == "send-order") {
        session_start();
        // Create order
        $query = "INSERT INTO orders VALUES(NULL, ". $_SESSION["u_id"] .", 0, 'unprocessed')";
        $result = mysqli_query($conn, $query);

        $order_id = mysqli_insert_id($conn);

        // Add articles
        for ($i = 0; $i < sizeof($_SESSION["basket_articles"]); $i++)
        {
            $article = $_SESSION["basket_articles"][$i];
            $query = "INSERT INTO order_article VALUES (". $order_id .", ". $article["id"] .", ". $article["quantity"] .")";
            $result = mysqli_query($conn, $query);
        }


        // Empty basket
        $_SESSION["basket_articles"] = [];
    }
} else {

        $articles = get_basket_content($conn, $_SESSION["basket_articles"]);
        $total = 0;

        for ($i = 0; $i < sizeof($articles); $i++) {
            $row = $articles[$i];
            $total += $row['price']*$row['quantity'];

            echo '<tr id="' . $i . '">
            <th scope="row"> ' . $i . ' </th>
            <td> <img src="../client/images/' . $row["picture"] . '" class="img-responsive img-thumb"/></div> </td>
            <td> ' . $row['name'] . ' </td>
            <td> ' . $row['price'] . '€</td>
            <td> ' . $row['quantity'] . ' </td>
            <td> ' . round($row['price']*$row['quantity']*0.22, 2) . '€</td>
            <td> ' . $row['price']*$row['quantity'] . '€</td>
        </tr>';
        }

        echo ' </tbody>
                        <tfoot>
                            <tr>
                                <td><a href="basket.php" class="btn tfn-warning"><i class="fa fa-angle-left"></i> Nazaj na košarico</a></td>
                                <td colspan="4" class="hidden-xs"></td>
                                <td class="hidden-xs text-center total"></td>
                                <td>
                                    <strong>Skupaj '. $total .'€</strong>
                                    <div><hr></div>
                                    <button onclick="sendOrder('. sizeof($articles) .');" class="btn btn-success btn-block">Oddaj naročilo!<i class=""></i></button>
                                </td>
                            </tr>
                        </tfoot>';
}


function get_basket_content($conn, $basket)
{
    $articles = array();

    if (isset($basket)) {
        for ($i = 0; $i < sizeof($basket); $i++)
        {
            $id = $basket[$i]["id"];
            $query = "SELECT * FROM article WHERE id='$id'";
            $res = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($res))
            {
                $row["id"] = $id;
                $row["quantity"] = $basket[$i]["quantity"];
                $row["description"] = limit_description_length($row["description"], 100);
                $articles[] = $row;
            }
        }
    }

    return $articles;
}

function limit_description_length($description, $length)
{
    if (strlen($description) > $length) {
        $description = substr($description, 0, $length);
        $description = $description . "...";
    }

    return $description;
}
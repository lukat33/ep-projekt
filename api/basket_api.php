<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 30/12/2017
 * Time: 12:18
 */

include_once 'dbconn.php';


if (isset($_POST["action"])) {
    session_start();
    if ($_POST["action"] == "remove")
    {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $record_id = find_record($id, $_SESSION["basket_articles"]);


        if ($record_id != -1)
        {
            $_SESSION["basket_articles"] = pop($record_id, $_SESSION["basket_articles"]);
        }
    }
    elseif ($_POST["action"] == "add") {
        if (!isset($_SESSION["basket_articles"]))
        {
            $_SESSION["basket_articles"] = array();
        }

        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $record_id = find_record($id, $_SESSION["basket_articles"]);

        if ($record_id != -1)
        {
            $_SESSION["basket_articles"][$record_id]["quantity"]++;
        }
        else
        {
            $_SESSION["basket_articles"][] = array(
                "id" => $id,
                "quantity" => 1
            );
        }
    }
    elseif ($_POST["action"] == "quantity")
    {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $record_id = find_record($id, $_SESSION["basket_articles"]);
        $_SESSION["basket_articles"][$record_id]["quantity"] = $quantity;
    }
}
else {
    render($conn);
}


function render($conn)
{
    if (isset($_SESSION["basket_articles"]))
    {
        $basket = get_basket_content($conn, $_SESSION["basket_articles"]);
        $total = 0;
        echo '</thead>
                        <tbody>';

        for ($i = 0; $i < sizeof($basket); $i++)
        {
            $article = $basket[$i];
            $total += $article["price"] * $article["quantity"];

            echo '<tr>
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-2 hidden-xs"><img src="images/'. $article["picture"] .'" alt="..." class="img-responsive img-thumb"/></div>
                        <div class="col-sm-10">
                            <h4 class="nomargin">'. $article["name"] .'</h4>
                            <p>'. $article["description"] .'</p>
                        </div>
                    </div>
                </td>
                <td class="price" id="'. $article["id"] .'"  data-th="Price">'. $article["price"] .'€</td>
                <td data-th="Quantity">
                    <input min="0" article_id="'. $article["id"] .'" type="number" class="form-control text-center quantity-selector" value="'. $article["quantity"] .'">
                </td>
                <td data-th="Subtotal" id="'. $article["id"] .'" class="text-center subtotal">'. $article["price"] * $article["quantity"] .'€</td>
                <td class="actions" data-th="">
                    <button onclick="removeArticle('. $article["id"] .')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                </td>
            </tr>';
        }
    }
    else
    {
        $total = 0.0;
        echo '<tr>
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="nomargin">V košarici ni izdelkov.</h4>
                        </div>
                    </div>
                </td>
            </tr>';
    }

    echo ' </tbody>
                    <tfoot>
                        <tr>
                            <td><a href="index.php" class="btn tfn-warning"><i class="fa fa-angle-left"></i> Nadaljujte z nakupovanjem</a></td>
                            <td colspan="2" class="hidden-xs"></td>
                            <td class="hidden-xs text-center total"><strong>Skupaj '. $total .'€</strong></td>
                            <td><a href="#" class="btn btn-success btn-block">Naprej <i class="fa fa-angle-right"></i></a></td>
                        </tr>
                    </tfoot>';
}

function pop($index, $array) {
    $out = array();

    for ($i = 0; $i < sizeof($array); $i++)
    {
        if ($i != $index) $out[] = $array[$i];
    }
    return $out;
}

function get_total_basket_price($basket) {
    $total = 0;
    for ($i = 0; $i < sizeof($basket); $i++)
    {
        $total += $basket[$i]["price"];
    }
    return $total;
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
                $articles[] = $row;
            }
        }
    }

    return $articles;
}

function find_record($id, $array)
{
    for ($i = 0; $i < sizeof($array); $i++)
    {
        if ($id == $array[$i]["id"])
        {
            return $i;
        }
    }

    return -1;
}
<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 30/12/2017
 * Time: 12:18
 */

include_once 'dbconn.php';


if (isset($_POST["action"])) {

    if ($_POST["action"] == "remove")
    {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $record_id = find_record($id, $_SESSION["basket_articles"]);
        echo json_encode($id);

        if ($record_id != -1)
        {
            unset($_SESSION["basket_articles"][$record_id]);
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
            echo json_encode($_SESSION["basket_articles"]);
        }
    }
} else {
    render($conn);
}


function render($conn)
{
    echo json_encode($_SESSION["basket_articles"]);
    if (isset($_SESSION["basket_articles"]))
    {
        echo json_encode($_SESSION["basket_articles"]);
        $basket = get_basket_content($conn, $_SESSION["basket_articles"]);
        $total = get_total_basket_price($basket);

        echo '</thead>
                        <tbody>';

        for ($i = 0; $i < sizeof($basket); $i++)
        {
            $article = $basket[$i];
            echo '<tr>
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div>
                        <div class="col-sm-10">
                            <h4 class="nomargin">'. $article["name"] .'</h4>
                            <p>'. $article["description"] .'</p>
                        </div>
                    </div>
                </td>
                <td data-th="Price">'. $article["price"] .'€</td>
                <td data-th="Quantity">
                    <input type="number" class="form-control text-center" value="'. $article["quantity"] .'">
                </td>
                <td data-th="Subtotal" class="text-center">'. $article["price"] * $article["quantity"] .'€</td>
                <td class="actions" data-th="">
                    <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
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
                            <td class="hidden-xs text-center"><strong>Skupaj '. $total .'€</strong></td>
                            <td><a href="#" class="btn btn-success btn-block">Naprej <i class="fa fa-angle-right"></i></a></td>
                        </tr>
                    </tfoot>';
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
            $query = "SELECT * FROM article WHERE id='. $id .'";
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
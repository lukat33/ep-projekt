<?php
/**
 * Created by PhpStorm.
 * User: andraz
 * Date: 12/01/2018
 * Time: 10:02
 */

if (isset($_GET["view"])) {
    if ($_GET["view"] == "received") {
        echo "
            <a href='../client/index.php?view=received' class=\"btn btn-default active\">Prejeta</a>
            <a href='../client/index.php?view=confirmed' class=\"btn btn-default\">Potrjena</a>
            <a href='../client/index.php?view=canceled' class=\"btn btn-default\">Preklicana</a>
        ";
    } elseif ($_GET["view"] == "confirmed") {
        echo "
            <a href='../client/index.php?view=received' class=\"btn btn-default\">Prejeta</a>
            <a href='../client/index.php?view=confirmed' class=\"btn btn-default active\">Potrjena</a>
            <a href='../client/index.php?view=canceled' class=\"btn btn-default\">Preklicana</a>
        ";
    } elseif ($_GET["view"] == "canceled") {
        echo "
            <a href='../client/index.php?view=received' class=\"btn btn-default\">Prejeta</a>
            <a href='../client/index.php?view=confirmed' class=\"btn btn-default\">Potrjena</a>
            <a href='../client/index.php?view=canceled' class=\"btn btn-default active\">Preklicana</a>
        ";
    }
} else {
    echo "
            <a href='../client/index.php?view=received' class=\"btn btn-default active\">Prejeta</a>
            <a href='../client/index.php?view=confirmed' class=\"btn btn-default\">Potrjena</a>
            <a href='../client/index.php?view=canceled' class=\"btn btn-default\">Preklicana</a>
        ";
}
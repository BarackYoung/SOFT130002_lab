<?php

    function outputOrderRow($file, $title, $quantity, $price) {

        echo "<tr>";
        //TODO
        echo "<td><img src='images/books/tinysquare/{$file}' alt=''></td>";
        echo "<td class='mdl-data-table__cell--non-numeric'>{$title}</td>";
        echo "<td>{$quantity}</td>";
        echo "<td>\${$price}.00</td>";
        $amount = $quantity*$price;
        number_format($amount,2);
        echo "<td>\${$amount}.00</td>";
        echo "</tr>";
    }
?>
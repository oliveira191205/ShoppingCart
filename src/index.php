<?php
require_once "shoppingCart.php";

$cart = new shoppingCart();

echo $cart->createCart(1, 2, 7000.00) . "<br>";
echo $cart->listCartProducts(1) . "<br>";
echo $cart->addProduct(1, 2, 1, 1000.00) . "<br>";
echo $cart->removeProduct(1, 1) . "<br>";
echo "Total: R$ " . $cart->calculateTotal(1) . "<br>";
echo "Total com desconto: R$ " . $cart->addDiscount(1) . "<br>";

?>
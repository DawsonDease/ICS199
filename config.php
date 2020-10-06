<?php
require_once('vendor/autoload.php');

$stripe = [
  "secret_key"      => "sk_test_35r7gD7yEN6nQgZCigWCj4kg00FufqRySV",
  "publishable_key" => "pk_test_IB0iwD3zotJwTmM3Eu1XOHTQ00uXrAXzzj",
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>
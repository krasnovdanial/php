<?php

$fromCurrency = $_POST['from_currency'];
$toCurrency = $_POST['to_currency'];
$amount = $_POST['amount'];

// Retrieve the latest currency rates from the database
$query = "SELECT rate FROM currency_rates WHERE currency_code = :code";
$stmt = $db->prepare($query);

$stmt->bindValue(':code', $fromCurrency);
$stmt->execute();
$fromRate = $stmt->fetch(PDO::FETCH_COLUMN);

$stmt->bindValue(':code', $toCurrency);
$stmt->execute();
$toRate = $stmt->fetch(PDO::FETCH_COLUMN);

$convertedAmount = ($amount / $fromRate) * $toRate;

echo "Converted Amount: $convertedAmount $toCurrency";
?>


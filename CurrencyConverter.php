<?php
class CurrencyConverter {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function parseCurrencyData() {
        $url = "https://www.cbr-xml-daily.ru/daily_json.js";
        $currencyData = file_get_contents($url);

        $parsedData = json_decode($currencyData, true);

        $currencyRates = $parsedData['Valute'];
        foreach ($currencyRates as $code => $rate) {
            $query = "INSERT INTO currency_rates (currency_code, rate, timestamp) VALUES (:code, :rate, :timestamp)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':code', $code);
            $stmt->bindValue(':rate', $rate['Value']);
            $stmt->bindValue(':timestamp', $parsedData['Timestamp']);
            $stmt->execute();
        }
    }
}


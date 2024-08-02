<?php 
function getProducts(PDO $pdo)
{
    try {
        $stmt = $pdo->prepare("SELECT * FROM product");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    } catch (PDOException $e) {
        return $e;
    }
}
 ?>
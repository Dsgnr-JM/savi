<?php 
function getClients(PDO $pdo)
{
    try {
        $stmt = $pdo->prepare("SELECT c.*, ce.enterprise_name FROM client c LEFT JOIN client_enterprise ce ON c.dni = ce.dni;");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    } catch (PDOException $e) {
        return $e;
    }
}
 ?>
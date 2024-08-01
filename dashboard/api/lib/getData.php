<?php 
function getUser(PDO $pdo, string $ci)
{
    try {
        $stmt = $pdo->prepare("SELECT * FROM tb_users WHERE ci = :ci");
        $stmt->bindParam(":ci", $ci);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    } catch (PDOException $e) {
        return $e;
    }
}
 ?>
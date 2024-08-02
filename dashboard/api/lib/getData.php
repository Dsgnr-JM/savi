<?php 
function getUser(PDO $pdo, string $ci)
{
    try {
        $stmt = $pdo->prepare("SELECT us.*, rl.* FROM tb_users us LEFT JOIN role rl ON us.role = rl.role WHERE us.ci = :ci");
        $stmt->bindParam(":ci", $ci);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    } catch (PDOException $e) {
        return $e;
    }
}
 ?>
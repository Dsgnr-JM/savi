<?php
function updateName(PDO $pdo, array $data, array $message)
{
    try {
        $stmt = $pdo->prepare("UPDATE tb_users SET name = :name, surname = :surname WHERE ci = :ci");
        $stmt->bindParam(":ci", $data["ci"]);
        $stmt->bindParam(":name", $data["name"]);
        $stmt->bindParam(":surname", $data["surname"]);

        $stmt->execute();

        $message["result"] = true;
        $message["description"] = "Successfully updated data";
    } catch (PDOException $e) {
        $message["description"] = $e;
        return json_encode($message);
    }
    return json_encode($message);
}
?>
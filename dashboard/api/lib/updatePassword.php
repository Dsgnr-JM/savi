<?php
function updatePassword(PDO $pdo, array $data, array $message)
{
    try {
        $stmt = $pdo->prepare("UPDATE tb_users SET password = :password WHERE ci = :ci");
        $stmt->bindParam(":ci", $data["ci"]);
        $stmt->bindParam(":password", $data["password"]);

        $stmt->execute();

        $message["result"] = true;
        $message["description"] = "Successfully updated password";
    } catch (PDOException $e) {
        $message["description"] = $e;
        return json_encode($message);
    }
    return json_encode($message);
}
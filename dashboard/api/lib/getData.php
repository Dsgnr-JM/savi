<?php

function getData(PDO $pdo, string $operation, array $param=NULL){
    require_once "helpers/getOperationsSQL.php";
    try {
        $sql = $operationsSQL["list"][$operation];
        $registForPage = 10;
        $page = $_GET["page"] ?? 1;
        $start = ($page - 1) * $registForPage;

        if(isset($operationsSQL["count"][$operation])){
            $sql = $sql . " LIMIT $start, $registForPage;";
        }
        // if(isset($param["like"])){
        //     $sql = $sql . " LIKE "
        // }

        
        $stmt = $pdo->prepare($sql);

        if(isset($param["search"])){
            if($operation == "user"){
                $stmt->bindParam(":ci", $param["search"]);
            }
            if($operation == "model"){
                $stmt->bindParam(":mode_id", $param["search"]);
            }
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(isset($operationsSQL["count"][$operation])){
            $sql = $operationsSQL["count"][$operation];
            $countStmt = $pdo->prepare($sql);
            $countStmt->execute();
            $countResult = $countStmt->fetch(PDO::FETCH_ASSOC)["total"];
            $result = array(
                "data" => $result,
                "length" => ceil($countResult / $registForPage)
            );
        }

        return json_encode($result, JSON_UNESCAPED_UNICODE);
    } catch (PDOException $e) {
        return $e;
    }
}

?>
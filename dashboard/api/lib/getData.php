<?php

function getData(PDO $pdo, string $operation, array $param=NULL){
    require_once "helpers/getOperationsSQL.php";
    try {
        $sql = $operationsSQL["list"][$operation];
        $outerParam = "";
        if(isset($param["like"])) {
            $outerParam = " ".$operationsSQL["like"][$operation];
        };
        if(isset($param["filter"])){
            $outerParam = $outerParam." ".$operationsSQL["filter"][$operation];
        }
        $sql = $sql.$outerParam;
        $registForPage = 10;
        $page = $_GET["page"] ?? 1;
        $start = ($page - 1) * $registForPage;

        if(isset($operationsSQL["count"][$operation]) && !isset($_GET["all"])){
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
            if($operation == "product"){
                $stmt->bindParam(":search", $param["search"]);
            }
            if($operation == "sale"){
                $stmt->bindParam(":search", $param["search"]);
            }
            if($operation == "client"){
                $stmt->bindParam(":search", $param["search"]);
            }
            if($operation == "sale_product"){
                $stmt->bindParam(":search", $param["search"]);
            }
            if($operation == "log"){
                $stmt->bindParam(":user", $param["search"]);
            }
        }
        if(isset($param["like"])){
            $like = '%'.$param["like"].'%';
            $stmt->bindParam(":like", $like);
        }
        if(isset($param["filter"])){
            $stmt->bindParam(":filter",$param["filter"]);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(isset($operationsSQL["count"][$operation]) && !isset($_GET["all"])){
            $sql = $operationsSQL["count"][$operation].$outerParam;
            $countStmt = $pdo->prepare($sql);
            if(isset($param["like"])){
                $like = '%'.$param["like"].'%';
                $countStmt->bindParam(":like", $like);
            }
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
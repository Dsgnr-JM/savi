<?php

function getData(PDO $pdo, string $operation, array $param = NULL)
{
    $theyCanBeRemoved = ["products","suppliers","clients","sales"];
    $theyCanBeRemoved = is_numeric(array_search($operation,$theyCanBeRemoved));
    require_once "helpers/getOperationsSQL.php";
    try {
        $sql = $operationsSQL["list"][$operation];
        $outerParam = "";
        $whereOperation = isset($param["like"]) ? $operationsSQL["like"]
        [$operation] : "";
        if ($theyCanBeRemoved) {
            $letter = $operation[0];
            $isRemoved = isset($_GET["isRemoved"]) ? 1 : 0;
            $and = isset($param["like"]) ? "AND" : "";
            $whereOperation .= empty($whereOperation) ? " WHERE $letter.isRemoved = $isRemoved" : " $and $letter.isRemoved = $isRemoved";
        }
        $sql = str_replace("{{where}}", $whereOperation, $sql);
        if (isset($param["filter"])) {
            $outerParam = $outerParam . " " . $operationsSQL["filter"][$operation];
        }
        $sql = $sql . $outerParam;
        $registForPage = 10;
        $page = isset($_GET["page"]) && $_GET["page"] != 0 ? $_GET["page"] : 1;
        $start = ($page - 1) * $registForPage;

        if (isset($operationsSQL["count"][$operation]) && !isset($_GET["all"])) {
            $sql = $sql . " LIMIT $start, $registForPage;";
        }
        // if(isset($param["like"])){
        //     $sql = $sql . " LIKE "
        // }


        $stmt = $pdo->prepare($sql);

        if (isset($param["search"])) {
            $stmt->bindParam(":search", $param["search"]);
        }
        if (isset($param["like"])) {
            $like = '%' . $param["like"] . '%';
            $stmt->bindParam(":like", $like);
        }
        if (isset($param["filter"])) {
            $stmt->bindParam(":filter", $param["filter"]);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (isset($operationsSQL["count"][$operation]) && !isset($_GET["all"])) {
            $sql = $operationsSQL["count"][$operation];
            $sql = str_replace("{{where}}", $whereOperation, $sql);
            $countStmt = $pdo->prepare($sql);
            if (isset($param["like"])) {
                $like = '%' . $param["like"] . '%';
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

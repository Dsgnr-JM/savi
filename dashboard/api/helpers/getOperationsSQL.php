<?php
$operationsSQL = array(
    "list" => array(
        "users" => "SELECT us.*, rl.* FROM tb_users us LEFT JOIN role rl ON us.role = rl.role",
        "user" => "SELECT us.*, rl.* FROM tb_users us LEFT JOIN role rl ON us.role = rl.role WHERE us.ci = :ci",
        "products" => "SELECT * FROM product",
        "models" => "SELECT * FROM models",
        "model" => "SELECT * FROM models WHERE model_id = :model_id",

        "categorys" => "SELECT * FROM category",
        "category" => "SELECT * FROM category WHERE category_id = :category_id",
        "brands" => "SELECT * FROM brad",
        "brand" => "SELECT * FROM brad WHERE id_brand = :id_brand",
        "suppliers" => "SELECT * FROM supliers",
        "supplier" => "SELECT * FROM supliers WHERE supplier_rif = :supplier_rif",
        "clients" => "SELECT c.*, ce.enterprise_name FROM client c LEFT JOIN client_enterprise ce ON c.dni = ce.dni",
    ),
    "count" => array(
        "users" => "SELECT COUNT(*) as total FROM tb_users",
        "products" => "SELECT COUNT(*) as total FROM product",
        "suppliers" => "SELECT COUNT(*) as total FROM supliers",
        "clients" => "SELECT COUNT(*) as total FROM client",
    )
);
?>
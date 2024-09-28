<?php
$operationsSQL = array(
    "list" => array(
        "users" => "SELECT us.*, rl.* FROM tb_users us LEFT JOIN role rl ON us.role = rl.role",
        "user" => "SELECT us.*, rl.* FROM tb_users us LEFT JOIN role rl ON us.role = rl.role WHERE us.ci = :ci",
        "products" => "SELECT p.code,p.name,p.photo,p.purchase_price,p.selling_price,p.stock,p.stock_max,p.stock_min,p.supplier,c.category_name as category, b.brad_name as brand FROM product p JOIN category c ON p.category = c.category_id JOIN brad b ON b.id_brand = p.brand",
        "sale_product" => "SELECT p.*, sp.nro_factura,sp.amount FROM sale_product sp JOIN product p ON sp.product = p.code WHERE nro_factura = :search",
        "product" => "SELECT * FROM product WHERE name = :search OR code = :search",
        "sale" => "SELECT * FROM sale WHERE nro_factura = :search",
        "client" => "SELECT * FROM client WHERE dni = :search",
        "configs" => "SELECT * FROM config",
        "roles" => "SELECT * FROM role",
        "models" => "SELECT * FROM models",
        "logs" => "SELECT * FROM logs ORDER BY id DESC",
        "model" => "SELECT * FROM models WHERE model_id = :model_id",
        "categorys" => "SELECT c.category_id as id,c.category_name as name, COUNT(p.code) AS num_products FROM category c LEFT JOIN product p ON c.category_id = p.category GROUP BY c.category_id, c.category_name;",
        "category" => "SELECT * FROM category WHERE category_id = :category_id",
        "brands" => "SELECT * FROM brad",
        "brand" => "SELECT * FROM brad WHERE id_brand = :id_brand",
        "suppliers" => "SELECT * FROM supliers",
        "supplier" => "SELECT * FROM supliers WHERE supplier_rif = :supplier_rif",
        "clients" => "select c.*,ce.enterprise_name, CASE when exists(SELECT 1 FROM sale s where s.status = 'pending' AND s.client = c.dni) THEN 'pending' else 'complete' end as status from client c left join sale v ON c.dni = v.client left join client_enterprise ce ON ce.dni = c.dni group by c.dni,c.name",
        "logs" => "select l.message,l.date,l.user from logs l",
        "log" => "select l.message,l.date,l.user from logs l where user = :user"
    ),
    "count" => array(
        "users" => "SELECT COUNT(*) as total FROM tb_users",
        "products" => "SELECT COUNT(*) as total FROM product",
        "logs" => "SELECT COUNT(*) as total FROM logs",
        "suppliers" => "SELECT COUNT(*) as total FROM supliers",
        "clients" => "SELECT COUNT(*) as total FROM client",
    ),
    "like" => array(
        "products" => "WHERE (code LIKE :like OR name LIKE :like OR c.category_name LIKE :like OR selling_price LIKE :like)",
        "logs" => "WHERE user LIKE :like"
    ),
    "filter" => array(
        "products" => "AND category = :filter",
    )
);
?>
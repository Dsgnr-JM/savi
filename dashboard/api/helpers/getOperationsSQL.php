<?php
$operationsSQL = array(
    "list" => array(
        "users" => "SELECT us.*, rl.* FROM tb_users us LEFT JOIN role rl ON us.role = rl.role",
        "client_count" => "SELECT COUNT(*) as total from client",
        "sale_total" => "select round(sum(case when month(date) = month(curdate()) then payment else 0 end),2) as total_sale_month,round(sum(case when month(date) = month(curdate())-1 then payment else 0 end),2) as total_sale_old_month from sale where (month(date) = month(curdate()) or month(date)= month(curdate())-1) and year(date) = year(curdate())",
        "sale_count" => "select count(case when month(date) = month(curdate()) then 1 end) as sale_month,count(case when month(date) = month(curdate()) - 1 then 1 end) as sale_old_month from sale where (month(date) = month(curdate()) or month(date)= month(curdate()) - 1) and year(date) = year(curdate());",
        "user" => "SELECT us.*, rl.* FROM tb_users us LEFT JOIN role rl ON us.role = rl.role WHERE us.ci = :search",
        "products" => "SELECT p.code,p.name,p.photo,p.purchase_price,p.selling_price,p.stock,p.stock_max,p.stock_min,p.supplier,c.category_name as category FROM product p JOIN category c ON p.category = c.category_id {{where}}",
        "sale_product" => "SELECT p.*, sp.nro_factura,sp.amount FROM sale_product sp JOIN product p ON sp.product = p.code WHERE nro_factura = :search",
        "purchase_product" => "SELECT p.*, pcp.nro_factura,pcp.amount FROM purchase_product pcp JOIN product p ON pcp.product = p.code WHERE nro_factura = :search",
        "sales" => "SELECT s.nro_factura,s.client, s.status,s.payment,s.date, CASE WHEN s.status = 'complete' THEN s.payment ELSE SUM(p.selling_price * sp.amount) * 1.16 END AS total, s.isRemoved as isRemoved FROM sale s JOIN sale_product sp ON s.nro_factura = sp.nro_factura JOIN product p ON sp.product = p.code {{where}} GROUP BY s.client, s.status,s.nro_factura,s.payment",
        "product" => "SELECT p.code,p.name,p.photo,p.purchase_price,p.category,p.supplier,p.selling_price,p.stock,p.stock_max,p.stock_min,c.category_name,s.location as supplier_location,s.rif as supplier, s.name as supplier_name, COALESCE(SUM(sp.amount),0) as total_sales  FROM product p JOIN supliers s ON p.supplier = s.rif JOIN category c ON p.category = c.category_id LEFT JOIN sale_product sp ON p.code = sp.product WHERE p.name = :search OR p.code = :search GROUP BY p.code ",
        "sale" => "SELECT s.nro_factura,s.client, s.status,s.payment,s.date, CASE WHEN s.status = 'complete' THEN s.payment ELSE SUM(p.selling_price * sp.amount) * 1.16 END AS total FROM sale s JOIN sale_product sp ON s.nro_factura = sp.nro_factura JOIN product p ON sp.product = p.code WHERE s.nro_factura = :search OR s.client = :search GROUP BY s.client, s.status,s.nro_factura,s.payment",
        "purchase" => "SELECT * FROM purchase WHERE nro_factura = :search",
        "client" => "select c.*,ce.enterprise_name, CASE when exists(SELECT 1 FROM sale s where s.status = 'pending' AND s.client = c.dni) THEN 'pending' else 'complete' end as status from client c left join sale v ON c.dni = v.client left join client_enterprise ce ON ce.dni = c.dni where c.dni = :search group by c.dni,c.name",
        "configs" => "SELECT * FROM config",
        "roles" => "SELECT * FROM role",
        "models" => "SELECT * FROM models",
        "logs" => "SELECT * FROM logs {{where}} ORDER BY id DESC",
        "role" => "SELECT * FROM role WHERE role = :search",
        "categorys" => "SELECT c.category_id as id,c.category_name as name, count(case when p.isRemoved = 0 then 1 end) AS num_products FROM category c LEFT JOIN product p ON c.category_id = p.category GROUP BY c.category_id, c.category_name;",
        "category" => "SELECT * FROM category WHERE category_id = :search",
        "suppliers" => "SELECT * FROM supliers s {{where}}",
        "supplier" => "SELECT * FROM supliers WHERE rif = :search",
        "clients" => "select c.*,ce.enterprise_name, CASE when exists(SELECT 1 FROM sale s where s.status = 'pending' AND s.client = c.dni) THEN 'pending' else 'complete' end as status from client c left join sale v ON c.dni = v.client left join client_enterprise ce ON ce.dni = c.dni {{where}} group by c.dni,c.name",
        "logs" => "select l.message,l.date,l.user from logs l ORDER BY id DESC",
        "log" => "select l.message,l.date,l.user from logs l where user = :search ORDER BY id DESC",
        "product_count" => "SELECT COUNT(*) as total FROM product",
        "client_count" => "SELECT COUNT(*) as total FROM client",
        "stadistics_sale" => "select count(case when month(date) = month(curdate()) then 1 end) as current_month,count(case when month(date) = month(curdate())-1 then 1 end) as last_month,count(case when month(date) = month(curdate())-2 then 1 end) as ancestor_month from sale where (month(date) = month(curdate()) or month(date)= month(curdate())-1 or month(date)= month(curdate())-2) and year(date) = year(curdate())"
    ),
    "count" => array(
        "users" => "SELECT COUNT(*) as total FROM tb_users",
        "products" => "SELECT COUNT(*) as total FROM product p JOIN category c ON p.category = c.category_id {{where}}",
        "logs" => "SELECT COUNT(*) as total FROM logs l {{where}}",
        "suppliers" => "SELECT COUNT(*) as total FROM supliers s {{where}}",
        "clients" => "SELECT COUNT(*) as total FROM client c {{where}}",
        "sales" => "SELECT COUNT(*) as total FROM sale s {{where}}",
        "purchase" => "SELECT COUNT(*) as total FROM purchase s {{where}}"
    ),
    "like" => array(
        "products" => "WHERE (code LIKE :like OR name LIKE :like OR c.category_name LIKE :like OR selling_price LIKE :like OR supplier LIKE :like)",
        "logs" => "WHERE user LIKE :like",
        "sales" => "WHERE (s.nro_factura LIKE :like OR s.client LIKE :like OR s.status LIKE :like)",
        "purchase" => "WHERE s.nro_factura LIKE :like OR s.date LIKE :like",
        "clients" => "WHERE c.name LIKE :like OR c.surname LIKE :like OR c.dni LIKE :like OR c.phone LIKE :like OR c.location LIKE :like"
    ),
    "filter" => array(
        "products" => "AND category = :filter",
    )
);
?>
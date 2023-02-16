JOINS

Inner join

    SELECT p.title as product_title, c.title as category_title  FROM `products` p INNER JOIN `categories` c ON c.id = p.category_id;

    SELECT p.title as product_title, c.title as category_title  FROM `products` p INNER JOIN `categories` c WHERE c.id = p.category_id;


OUTER JOIN

    LEFT OUTER 
    SELECT p.title as product_title, c.title as category_title  FROM `products` p LEFT JOIN `categories` c ON c.id = p.category_id;

    RIGHT OUTER
    SELECT p.title as product_title, c.title as category_title  FROM `products` p LEFT JOIN `categories` c ON c.id = p.category_id;


FULL JOIN

    SELECT p.title as product_title, c.title as category_title  FROM `products` p LEFT JOIN `categories` c ON c.id = p.category_id
    UNION
    SELECT p.title as product_title, c.title as category_title  FROM `products` p RIGHT JOIN `categories` c ON c.id = p.category_id;

SELF JOIN

    SELECT c.title as parent, cc.title as child from categories c  INNER JOIN categories cc WHERE c.id = cc.parent_id;

    ssh -o PubKeyAuthentication=no -p 65002 u682479975@153.92.7.160
    cd public_html/ecom
    git pull
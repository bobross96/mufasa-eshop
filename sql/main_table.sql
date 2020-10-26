use f37ee;

create table products (
    id int unsigned not null auto_increment primary key,
    product_name varchar(255) not null,
    price float(9,2),
    category varchar(255),
    description text(1000)
);

create table mufasa_orders (
    id int unsigned not null auto_increment primary key,
    user_id int unsigned not null references users(id),
    order_date DATETIME,
    total_amount float(9,2)
);

create table product_orders(
    id int unsigned not null auto_increment primary key,
    order_id int unsigned not null references mufasa_orders(id),
    product_id int unsigned not null references products(id),
    quantity int unsigned not null 

);

create table cart_product(
    id int unsigned not null auto_increment primary key,
    quantity int unsigned not null,
    product_id int unsigned not null references products(id),
    user_id int unsigned not null references users(id)
);



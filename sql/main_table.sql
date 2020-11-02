use f37ee;

create table products (
    id int unsigned not null auto_increment primary key,
    product_name varchar(255) not null,
    price float(9,2),
    category varchar(255),
    brand varchar(255),
    description text(1000),
    stock int not null 
);

create table mufasa_orders (
    id int unsigned not null auto_increment primary key,
    user_id int unsigned not null references users(id),
    order_date DATETIME,
    total_amount float(9,2),
    order_status varchar(255),
    delivery_date DATETIME
);

create table product_orders(
    id int unsigned not null auto_increment primary key,
    order_id int unsigned not null references mufasa_orders(id),
    product_id int unsigned not null references products(id),
    quantity int unsigned not null,
    current_price float(9,2)

);


create table reviews(
    id int unsigned not null auto_increment primary key,
    user_id int unsigned not null references users(id),
    product_id int unsigned not null references products(id)
    
);
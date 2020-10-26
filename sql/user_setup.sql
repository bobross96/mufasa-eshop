use f37ee;

create table users (
    id int unsigned not null auto_increment primary key,
    username varchar(255) not null,
    password varchar(255) not null,
    name varchar(255) not null,
    email varchar(255) not null,
    address varchar(255)
);


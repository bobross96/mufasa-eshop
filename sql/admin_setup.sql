use f37ee;

create table admin_users (
    id int unsigned not null auto_increment primary key,
    username varchar(255) not null,
    email varchar(255) not null,
    password varchar(255) not null

);


INSERT INTO admin_users VALUES 
    (NULL,'adminBob','bob@gmail.com','c4024ad87186422f38a3a3b97bbbb236');
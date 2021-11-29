create table users
(
    id    int(10) unsigned not null auto_increment,
    email varchar(255)     not null,
    primary key (id),
    unique key email (email)
);

insert into users (id, email)
VALUES (1, 'test@gmail.com'),
       (2, 'test2@test.com'),
       (3, 'test3@test.com'),
       (4, 'test4@test.com'),
       (5, 'test5@test.com'),
       (6, 'test6@test.com'),
       (7, 'test7@test.com'),
       (8, 'test8@test.com'),
       (9, 'test9@test.com'),
       (10, 'test10@test.com'),
       (11, 'test11@test.com'),
       (12, 'test12@test.com'),
       (13, 'test13@test.com'),
       (14, 'test14@test.com'),
       (15, 'test15@test.com'),
       (16, 'test16@test.com'),
       (17, 'test17@test.com'),
       (18, 'test18@test.com'),
       (19, 'test19@test.com'),
       (20, 'test20@test.com'),
       (21, 'test21@test.com');

create table posts
(
    id         int(10) unsigned not null auto_increment,
    user_id    int(10) unsigned not null,
    post       text             not null,
    created_at timestamp        not null default current_timestamp,
    primary key (id)
);

insert into posts (id, user_id, post, created_at)
VALUES (1, 1, 'post 1', '2021-10-20 12:00:00'),
       (2, 1, 'post 2', '2021-11-02 12:00:00'),
       (3, 1, 'post 3', '2021-11-10 12:00:00'),
       (4, 1, 'post 4', '2021-11-21 12:00:00'),
       (5, 2, 'post 5', '2021-11-02 12:00:00'),
       (6, 2, 'post 6', '2021-11-07 12:00:00'),
       (7, 3, 'post 7', '2021-11-12 12:00:00'),
       (8, 4, 'post 8', '2021-11-19 12:00:00'),
       (9, 5, 'post 9', '2021-11-05 12:00:00'),
       (10, 5, 'post 10', '2021-11-06 12:00:00'),
       (11, 6, 'post 11', '2021-11-07 12:00:00'),
       (12, 7, 'post 12', '2021-11-10 12:00:00'),
       (13, 7, 'post 13', '2021-11-21 12:00:00'),
       (14, 7, 'post 14', '2021-11-09 12:00:00'),
       (15, 9, 'post 15', '2021-11-01 12:00:00'),
       (16, 12, 'post 16', '2021-10-12 12:00:00'),
       (17, 18, 'post 17', '2021-11-01 12:00:00'),
       (18, 18, 'post 18', '2021-10-02 12:00:00'),
       (19, 20, 'post 19', '2021-11-03 12:00:00'),
       (20, 20, 'post 20', '2021-11-06 12:00:00'),
       (21, 20, 'post 21', '2021-11-09 12:00:00'),
       (22, 21, 'post 22', '2021-11-12 12:00:00'),
       (23, 21, 'post 23', '2021-10-22 12:00:00'),
       (24, 21, 'post 24', '2021-11-01 12:00:00'),
       (25, 21, 'post 25', '2021-11-02 12:00:00'),
       (26, 21, 'post 26', '2021-11-03 12:00:00'),
       (27, 21, 'post 27', '2021-11-04 12:00:00'),
       (28, 21, 'post 28', '2021-09-22 12:00:00'),
       (29, 21, 'post 29', '2021-11-07 12:00:00');

# to increase search speed. Result 29 rows of cost to 4
create index idx_posts_user_id on posts(user_id);
show index from posts;

# main query
select
    users.email,
    COUNT(1) as total_posts
from posts
join users on posts.user_id = users.id
where users.email = 'test@gmail.com'
and posts.created_at BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE();

# to watch query performance
explain select
    users.email,
    COUNT(1) as total_posts
from posts
join users on posts.user_id = users.id
where users.email = 'test@gmail.com'
and posts.created_at BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()


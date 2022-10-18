CREATE DATABASE elearing_bkkbn;

USE elearing_bkkbn;

CREATE TABLE admin
(
    id         varchar(32)  not null primary key,
    name       varchar(300) not null,
    email      varchar(100) not null unique,
    username   varchar(200) not null unique,
    password   varchar(200) not null,
    photo      varchar(100)          default 'avatar.png',
    status     tinyint(1)            default 0,
    created_at timestamp    not null default current_timestamp(),
    updated_at timestamp    null     default null on update current_timestamp()
);

CREATE TABLE user
(
    id             varchar(32)  not null primary key,
    name           varchar(300) not null,
    username       varchar(200) not null unique,
    email          varchar(100) not null unique,
    password       varchar(200) not null,
    status         tinyint(1)            default 0,
    remember_token varchar(100)          default null,
    is_reset       tinyint(1)            default 0,
    is_verified    tinyint(1)            default 0,
    verified_at    timestamp    null,
    created_at     timestamp    not null default current_timestamp(),
    updated_at     timestamp    null     default null on update current_timestamp()
);

CREATE TABLE user_details
(
    user_id       varchar(32) not null primary key,
    categories    enum ('PNS', 'PPPK', 'PLKB/PKB', 'Non PNS') default null,
    nip           varchar(20)                                 default null,
    gender        varchar(15)                                 default null,
    birth_of_date date                                        default null,
    handphone     varchar(15)                                 default null,
    address       text                                        default null,
    city          varchar(100),
    photo         varchar(100)                                default 'avatar.png',
    updated_at    timestamp   null                            default null on update current_timestamp(),
    foreign key (user_id) references user (id) on update cascade on delete cascade
);


CREATE TABLE menu
(
    id     int(11)      not null auto_increment primary key,
    name   varchar(100) not null,
    slug   varchar(100) default null,
    icon   varchar(50)  default null,
    status tinyint(1)   default 0
);

CREATE TABLE categories
(
    id     int(11)      not null auto_increment primary key,
    name   varchar(100) not null unique,
    slug   varchar(100) not null unique,
    status tinyint(1) default 0
);

CREATE TABLE articles
(
    id          varchar(32) not null primary key,
    category_id int(11)              default null,
    title       text        not null unique,
    slug        text        not null unique,
    content     longtext             default null,
    status      tinyint(1)           default 0,
    thumbnail   varchar(100)         default null,
    created_by  varchar(32)          default null,
    updated_by  varchar(32)          default null,
    created_at  timestamp   not null default current_timestamp(),
    updated_at  timestamp   null     default null on update current_timestamp(),

    foreign key (category_id) references categories (id) on update cascade on delete set null
);

alter table articles
    add foreign key (created_by) references admin (id) on update cascade on delete set null;
alter table articles
    add foreign key (updated_by) references admin (id) on update cascade on delete set null;


CREATE TABLE announcements
(
    id         varchar(32) not null primary key,
    title      text        not null unique,
    slug       text        not null unique,
    content    longtext             default null,
    status     tinyint(1)           default 0,
    created_by varchar(32)          default null,
    updated_by varchar(32)          default null,
    created_at timestamp   not null default current_timestamp(),
    updated_at timestamp   null     default null on update current_timestamp()
);

alter table announcements
    add column photo varchar(100) default null AFTER content;

alter table announcements
    add foreign key (created_by) references admin (id) on update cascade on delete set null;
alter table announcements
    add foreign key (updated_by) references admin (id) on update cascade on delete set null;

CREATE TABLE banner
(
    id         varchar(32)  not null primary key,
    title      text         not null unique,
    photo      varchar(100) not null,
    link       longtext              default null,
    status     tinyint(1)            default 0,
    created_at timestamp    not null default current_timestamp(),
    updated_at timestamp    null     default null on update current_timestamp()
);

CREATE TABLE website_info
(
    id           int(11)   not null auto_increment primary key,
    name         text      not null,
    description  longtext           default null,
    phone        varchar(30)        default null,
    email        varchar(200)       default null,
    address      text               default null,
    facebook     varchar(200)       default null,
    instagram    varchar(200)       default null,
    twitter      varchar(200)       default null,
    youtube      varchar(200)       default null,
    tiktok       varchar(200)       default null,
    logo         varchar(200)       default 'logo.png',
    favicon      varchar(200)       default 'favicon.png',
    user_display tinyint(1)         default 1,
    status       tinyint(1)         default 1,
    created_at   timestamp not null default current_timestamp(),
    updated_at   timestamp null     default null on update current_timestamp()
);

drop table website_info;

CREATE TABLE courses
(
    id               varchar(32)  not null primary key,
    title            varchar(100) not null unique,
    thumbnail        varchar(100)          default null,
    limited_register int(4)                default null,
    status           tinyint(1)            default 0,
    description      text                  default null,
    created_at       timestamp    not null default current_timestamp(),
    updated_at       timestamp    null     default null on update current_timestamp()
);

CREATE TABLE course_sections
(
    id          varchar(32)  not null primary key,
    course_id   varchar(32)  not null,
    title       varchar(100) not null,
    type        enum ('subject', 'video', 'exam', 'online-meet', 'link') default null,
    status      tinyint(1)                                               default 1,
    description text                                                     default null,
    created_at  timestamp    not null                                    default current_timestamp(),
    updated_at  timestamp    null                                        default null on update current_timestamp(),
    foreign key (course_id) references courses (id) on update cascade on delete cascade
);

CREATE TABLE course_section_subject
(
    id                varchar(32) not null primary key,
    course_section_id varchar(32) not null,
    type              enum ('subject', 'video', 'online-meet', 'link') default null,
    subject           varchar(100)                                     default null,
    link              varchar(100)                                     default null,
    description       text                                             default null,
    created_at        timestamp   not null                             default current_timestamp(),
    updated_at        timestamp   null                                 default null on update current_timestamp(),
    foreign key (course_section_id) references course_sections (id) on update cascade on delete cascade
);

CREATE TABLE course_section_exam
(
    id                varchar(32) not null primary key,
    course_section_id varchar(32) not null,
    title             varchar(100)         default null,
    duration          int(5)               default null,
    start_time        datetime             default null,
    end_time          datetime             default null,
    total_question    int(3)               default null,
    status            tinyint(1)           default 0,
    created_by        varchar(32)          default null,
    created_at        timestamp   not null default current_timestamp(),
    updated_at        timestamp   null     default null on update current_timestamp(),
    foreign key (course_section_id) references course_sections (id) on update cascade on delete cascade
);

CREATE TABLE course_section_exam_questions
(
    id              varchar(32) not null primary key,
    exam_id         varchar(32) not null,
    question_number int(3)               default null,
    title           text                 default null,
    answer_option   varchar(100)         default null,
    status          tinyint(1)           default 0,
    created_at      timestamp   not null default current_timestamp(),
    updated_at      timestamp   null     default null on update current_timestamp(),
    foreign key (exam_id) references course_section_exam (id) on update cascade on delete cascade
);

CREATE TABLE course_section_exam_question_options
(
    id            int(11)     not null auto_increment primary key,
    question_id   varchar(32) not null,
    option_number int(2) default null,
    option_title  text   default null,
    foreign key (question_id) references course_section_exam_questions (id) on update cascade on delete cascade
);

CREATE TABLE user_exam_question_answer
(
    id                 varchar(32) not null primary key,
    user_id            varchar(32) not null,
    exam_id            varchar(32) not null,
    question_id        varchar(32) not null,
    user_answer_option varchar(100) default null,
    marks              varchar(30)  default null,
    foreign key (user_id) references user (id) on update cascade on delete cascade,
    foreign key (exam_id) references course_section_exam (id) on update cascade on delete cascade,
    foreign key (question_id) references course_section_exam_questions (id) on update cascade on delete cascade
);

CREATE TABLE user_exam_enroll
(
    id            varchar(32) not null primary key,
    user_id       varchar(32) not null,
    exam_id       varchar(32) not null,
    status        enum ('completed', 'not completed') default null,
    result_status enum ('pass', 'not pass')           default null,
    result        double(3, 2)                        default null,
    foreign key (user_id) references user (id) on update cascade on delete cascade,
    foreign key (exam_id) references course_section_exam (id) on update cascade on delete cascade
);

insert into menu
values (null, ' Home', 'home', 'fa-home', 1),
       (null, ' Categories', 'categories', 'fa-layer-group', 1),
       (null, ' Articles', 'articles', 'fa-file', 1);

insert into menu
values (null, ' Admin', 'admin', 'fa-user-tie', 1);
insert into menu
values (null, ' Users', 'users', 'fa-users', 1);
insert into menu
values (null, ' Banner', 'banner', 'fa-paper-plane', 1);
insert into menu
values (null, ' Announcements', 'announcements', 'fa-info-circle', 1);

INSERT INTO `admin` (`id`, `name`, `email`, `username`, `password`, `photo`, `status`, `created_at`, `updated_at`)
VALUES ('ffdd05cc-88c1-4f39-9eac-7c49d772', 'Administrator', 'admin@admin.com', 'admin',
        '$2y$10$v1EkK5gjURoJ6wrHZuw.neZqHvHqbMI1AmAyB9IPA4YwuUb3YiMai', 'administrator-1663201189.png', 1,
        '2022-09-14 13:58:29', '2022-09-15 00:49:47');

create table contact
(
    id         varchar(32) primary key not null,
    name       varchar(200)            not null,
    email      varchar(200)            not null,
    subject    text                    not null,
    message    text                    not null,
    reply      text,
    reply_by   varchar(200),
    status     varchar(100),
    created_at timestamp               not null default current_timestamp(),
    updated_at timestamp               null     default null on update current_timestamp()
);

drop database elearing_bkkbn;
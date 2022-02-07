create sequence users_id_seq
    as integer;

create sequence recipes_id_seq
    as integer;

create sequence users_details_id_seq
    as integer;

create table users
(
    id_user  integer default nextval('users_id_seq'::regclass) not null
        constraint users_pk
            primary key,
    email    varchar(255)                                      not null,
    password varchar(255)                                      not null
);

alter sequence users_id_seq owned by users.id_user;

create unique index users_id_uindex
    on users (id_user);

create table recipes
(
    id_recipe      integer default nextval('recipes_id_seq'::regclass) not null
        constraint recipes_pk
            primary key,
    title          varchar(100)                                        not null,
    description    text,
    "like"         integer default 0,
    dislike        integer default 0,
    created_at     date,
    id_assigned_by integer                                             not null
        constraint recipes_users_id_fk
            references users
            on update cascade on delete cascade,
    image          varchar(255)
);

alter sequence recipes_id_seq owned by recipes.id_recipe;

create unique index recipes_id_uindex
    on recipes (id_recipe);

create table users_recipes
(
    id_user   integer not null
        constraint user_users_recipes___fk
            references users
            on update cascade on delete cascade,
    id_recipe integer not null
        constraint recipe_users_recipes___fk
            references recipes
            on update cascade on delete cascade
);

create table users_details
(
    id_detail integer default nextval('users_details_id_seq'::regclass) not null
        constraint users_details_pk
            primary key,
    name      varchar(100)                                              not null,
    surname   varchar(100)                                              not null,
    id_user   integer                                                   not null
        constraint users_details_users_id_user_fk
            references users
            on update cascade on delete cascade
);

alter sequence users_details_id_seq owned by users_details.id_detail;

create unique index users_details_id_uindex
    on users_details (id_detail);

create unique index users_details_id_users_uindex
    on users_details (id_user);

create table users_roles
(
    id_user serial
        constraint users_roles_pk
            primary key,
    id_role serial
);

create unique index users_roles_id_role_uindex
    on users_roles (id_role);

create unique index users_roles_id_user_uindex
    on users_roles (id_user);

create table role
(
    id_role   serial
        constraint role_pk
            primary key,
    role_name varchar(100) not null
);

create unique index role_id_role_uindex
    on role (id_role);

create table logs
(
    id_logs  serial
        constraint logs_pk
            primary key,
    name     varchar(100) not null,
    surname  varchar(100) not null,
    browser  varchar(100) not null,
    datetime date         not null,
    host     varchar(100) not null,
    device   varchar(100) not null
);

create unique index logs_id_logs_uindex
    on logs (id_logs);

create table session
(
    id_session  uuid      default gen_random_uuid()              not null
        constraint session_pk
            primary key,
    data_expire timestamp default (now() + '01:00:00'::interval) not null,
    id_user     integer                                          not null
        constraint session_users_id_user_fk
            references users
            on update cascade on delete cascade
);

create unique index session_id_session_uindex
    on session (id_session);

create unique index session_id_user_uindex
    on session (id_user);

create procedure adduser(aemail character varying, apassword character varying, aname character varying,
                         asurname character varying)
    language plpgsql
as
$$
DECLARE
    userID int;
begin
    INSERT INTO users ("email", "password")
    VALUES (aemail, apassword);
    SELECT id_user INTO userID FROM users WHERE users.email = aemail;
    INSERT INTO users_details("name", "surname", "id_user")
    VALUES (aname, asurname, userID);
end;
$$;

create function session_start(aemail character varying) returns uuid
    language plpgsql
as
$$
DECLARE
    idUser         int;
    DECLARE result uuid;
begin
    select id_user into idUser from users where email = aemail;
    delete from session where id_user = idUser;
    insert into session (id_user) values (idUser);
    select id_session into result from session where id_user = idUser;
    return result;
end;
$$;

create function getidbyemail(aemail character varying) returns integer
    language plpgsql
as
$$
begin
    RETURN (SELECT id_user FROM users WHERE aemail = users.email);
end;
$$;



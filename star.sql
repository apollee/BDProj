drop table if exists d_utilizador;
drop table if exists d_tempo;
drop table if exists d_local;
drop table if exists d_lingua;

create table d_utilizador(
    id_utilizador serial not null,
    email varchar(150) not null,
    tipo varchar(150) not null,
    primary key (id_utilizador)
);

create table d_tempo(
    id_tempo serial not null,
    dia integer not null,
    dia_da_semana integer not null,
    semana integer not null,
    mes integer not null,
    trimestre integer not null,
    ano integer not null,
    primary key (id_tempo) 
);

create table d_local(
    id_local serial not null,
    latitude float not null,
    longitude float not null,
    nome varchar(150) not null,
    primary key (id_local)
)

create table d_lingua(
    id_lingua serial not null,
    lingua varchar(100) not null,
    primary key (id_lingua)
)

create table fact_table(
    id_utilizador integer not null,
    id_tempo integer not null,
    id_local integer not null,
    id_lingua integer not null,
    tipo_nomalia varchar(150) not null,
    com_proposta boolean not null,
    primary key(id_utilizador, id_tempo, id_local, id_lingua),
    foreign key(id_utilizador) references d_utilizador(id_utilizador) ON DELETE CASCADE,
    foreign key(id_tempo) references d_tempo(id_tempo) ON DELETE CASCADE,
    foreign key(id_local) references d_local(id_local) ON DELETE CASCADE,
    foreign key(id_lingua) references d_lingua(id_lingua) ON DELETE CASCADE
);



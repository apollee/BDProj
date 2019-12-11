DROP TABLE IF EXISTS duplicado;
DROP TABLE IF EXISTS correcao;

DROP TABLE IF EXISTS proposta_de_correcao;

DROP TABLE IF EXISTS incidencia;

DROP TABLE IF EXISTS utilizador_qualificado;
DROP TABLE IF EXISTS utilizador_regular;
DROP TABLE IF EXISTS utilizador;


DROP TABLE IF EXISTS anomalia_traducao;
DROP TABLE IF EXISTS anomalia;
DROP TABLE IF EXISTS item;
DROP TABLE IF EXISTS local_publico;


create table local_publico (
	latitude float not null,
	longitude float not null,
	nome varchar(100) not null,
	primary key (latitude, longitude),
	check(-90 <= latitude and latitude <= 90),
	check(-180 <= longitude and longitude <= 180)
);

create table item (
	id SERIAL,
    descricao varchar(1024) not null,
	localizacao varchar(31) not null,
    latitude float not null,
	longitude float not null,
	primary key (id),
	foreign key (latitude, longitude)
		references local_publico(latitude, longitude) ON DELETE CASCADE,
	check(-90 <= latitude and latitude <= 90),
	check(-180 <= longitude and longitude <= 180)
);

create table anomalia (
	id SERIAL,
	zona box not null,
	imagem bytea not null,
	ts timestamp not null,
	lingua varchar(40) not null,
	descricao varchar(1024) not null,
	tem_anomalia_redacao boolean not null,
	primary key (id)
);

create table anomalia_traducao (
	id integer not null,
	zona2 box not null,
	lingua2 varchar(40) not null,
	primary key (id),
	foreign key (id)
		references anomalia ON DELETE CASCADE
);

create table duplicado (
	item1 integer not null,
	item2 integer not null,
	primary key(item1, item2),
	foreign key (item1)
		references item ON DELETE CASCADE,
	foreign key (item2)
		references item ON DELETE CASCADE,
	check(item1 < item2)
);

create table utilizador (
	email varchar(50) not null,
	password varchar(30) not null,
	primary key (email)
);

create table utilizador_qualificado (
	email varchar(50) not null,
	primary key (email),
	foreign key (email)
		references utilizador ON DELETE CASCADE
);

create table utilizador_regular(
	email varchar(50) not null,
	primary key (email),
	foreign key (email)
		references utilizador ON DELETE CASCADE
);

create table incidencia (
	anomalia_id integer not null,
	item_id integer not null,
	email varchar(50) not null,
	primary key (anomalia_id),
	foreign key (anomalia_id)
		references anomalia ON DELETE CASCADE,
	foreign key (item_id)
		references item ON DELETE CASCADE,
	foreign key (email)
		references utilizador ON DELETE CASCADE
);

create table proposta_de_correcao(
	email varchar(50) not null,
	nro integer not null,
	data_hora timestamp not null,
	texto varchar(1024) not null,
	primary key (email, nro),
	foreign key (email)
		references utilizador_qualificado ON DELETE CASCADE
);

create table correcao (
	email varchar(50) not null,
	nro integer not null,
	anomalia_id integer not null,
	primary key (email, nro, anomalia_id),
	foreign key (email, nro)
		references proposta_de_correcao(email, nro)
		ON DELETE CASCADE,
	foreign key (anomalia_id)
		references incidencia ON DELETE CASCADE
);


create or replace function zone_trigger_proc() returns trigger
as $$
declare 
	aux_zona box;
begin 
	select zona into aux_zona from anomalia as anom where anom.id = new.id; 
	if new.zona2 && aux_zona then
		raise exception 'As zonas estao sobrepostas.';
	end if;
	return new;
end;
$$ language plpgsql;

create trigger zone_trigger after insert on anomalia_traducao
	for each row execute procedure zone_trigger_proc();

create or replace function user_qualify_proc() returns trigger
as $$
begin 
	if exists(
		select email from utilizador_regular as ut_r where ut_r.email = new.email)
	then
		raise exception 'O utilizador já é regular';
	end if;
	return new;
end;
$$ language plpgsql;

create trigger user_qualify before insert on utilizador_qualificado
	for each row execute procedure user_qualify_proc();

create or replace function user_regular_proc() returns trigger
as $$
begin
	if exists(
		select email from utilizador_qualificado as ut_q where ut_q.email = new.email)
	then
		raise exception 'O utilizador já é qualificado';
	end if;
	return new;
end;
$$ language plpgsql;

create trigger user_regular before insert on utilizador_regular
	for each row execute procedure user_regular_proc();

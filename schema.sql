create table local_publico (
	latitude integer,
	longitude integer,
	nome char(30),
	primary key (latitude, longitude)
)

create table item (
	id integer,
	descricao char(45),	
	localizacao char(30),
	latitude integer,
	longitude integer,
	primary key (id),
	foreign key (latitude)
		references local_publico),
	foreign key (longitude)
		references local_publico)
)

create table anomalia (
	id integer,
	zona box,	
	imagem box,
	lingua char(20),
	descricao char(45),
	tem_anomalia_redacao boolean,
	primary key (id)	
)

create table anomalia_traducao (
	id integer,
	zona2 box,
	lingua2 char(20),
	primary key(id)
)

create table duplicado (
	item1 integer,
	item2 integer,
	primary key(item1, item2),
	foreign key (item1)
		references item,
	foreign key (item2)
		references item
)

create table utilizador (
	email char(30),
	password char(20),
	primary key (email)
)

create table utilizador_qualificado (
	email char(30),
	primary key (email),
	foreign key (email)
		references utilizador
)

create table utilizador_regular(
	email char(30),
	primary key (email),
	foreign key (email)
		references utilizador
)

create table incidencia (
	anomalia_id integer,
	item_id integer,
	email char(30),
	primary key (anomalia_id),
	foreign key (anomalia_id)
		references anomalia,
	foreign key (item_id)
		references item,
	foreign key (email)
		references utilizador
)

create table proposta_de_correcao(
	email char(30),
	nro integer,
	data_hora integer,
	texto char(45),
	primary key (email, nro),
	foreign key (email)
		references utilizador_qualificado
)

create table correcao (
	email char(30),
	nro integer,
	anomalia_id integer,
	primary key (email, nro, anomalia_id),
	foreign key (email, nro)
		references proposta_de_correcao,
	foreign key (anomalia_id)
		references anomalia
)
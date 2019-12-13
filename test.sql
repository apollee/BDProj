drop table if exists d_utilizador;
drop table if exists d_tempo;
drop table if exists d_local;
drop table if exists d_lingua;
drop table if exists f_anomalia;

CREATE TABLE d_utilizador
AS
select distinct email,
		'regular' as tipo
from utilizador_regular

UNION

select email, 'qualificado' as tipo
from utilizador_qualificado;

alter table d_utilizador
ADD COLUMN id_utilizador serial not null;

CREATE TABLE d_local
AS
select distinct latitude,
		longitude,
		nome
from local_publico;

alter table d_local
ADD COLUMN id_local serial not null;

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

insert into d_tempo(dia, dia_da_semana, semana, mes, trimestre, ano)
    select extract(day from data_hora) as dia,
    extract(dow from data_hora) as dia_da_semana,
    extract(week from data_hora) as semana,
    extract(month from data_hora) as mes,
    extract(quarter from data_hora) as trimestre,
    extract(year from data_hora) as ano
    from proposta_de_correcao;


CREATE TABLE d_lingua
AS
select distinct lingua
from anomalia;

ALTER TABLE d_lingua
ADD COLUMN id_lingua serial not null;


CREATE TABLE f_anomalia AS
select ut.id_utilizador, temp.id_tempo, loc.id_local, ling.id_lingua, anom.tem_anomalia_redacao,
CASE WHEN anom.id = corre.anomalia_id THEN TRUE ELSE FALSE END as com_proposta
from d_utilizador as ut,
	d_tempo as temp,
	d_lingua as ling,
	d_local as loc,
	anomalia as anom,
	correcao as corre;


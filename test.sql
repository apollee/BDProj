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
    select distinct extract(day from ts) as dia,
    extract(dow from ts) as dia_da_semana,
    extract(week from ts) as semana,
    extract(month from ts) as mes,
    extract(quarter from ts) as trimestre,
    extract(year from ts) as ano
    from anomalia;

CREATE TABLE d_lingua
AS
select distinct lingua
from anomalia;

ALTER TABLE d_lingua
ADD COLUMN id_lingua serial not null; 

CREATE TABLE f_anomalia AS
select id_lingua, id_local, id_tempo, id_utilizador, tem_anomalia_redacao,
case exists(select * from incidencia natural join correcao natural join proposta_de_correcao)
    when True then True 
    else False 
end as com_proposta
    from incidencia, anomalia, item, d_utilizador, d_tempo, d_local, d_lingua
    where 
        extract(year from anomalia.ts) = d_tempo.ano and extract(month from anomalia.ts) = d_tempo.mes
        and extract(day from anomalia.ts) = d_tempo.dia 
        and d_lingua.lingua = anomalia.lingua 
        and incidencia.anomalia_id = anomalia.id and incidencia.item_id = item.id 
        and d_local.latitude = item.latitude and d_local.longitude = item.longitude
        and d_utilizador.email = incidencia.email;


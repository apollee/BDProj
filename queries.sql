/*query 1*/
with count_places as(
    select localp.nome, count(localp.nome)
    from local_publico as localp natural join item as it(item_id, descricao, localizacao, latitude, longitude) natural join incidencia as inc
    group by localp.nome),
max_count as(
    select MAX(count)
    from count_places)
select count_p.nome 
from count_places as count_p, max_count as max_c
where max_c.max = count_p.count;

/* query 2*/
with count_users as(
    select  ureg.email, count(ureg.email)
    from utilizador_regular as ureg natural join incidencia as inc natural join anomalia_traducao as anomtrad natural join anomalia as anom
    where anom.ts between '2019-01-01 00:00:00' AND '2019-6-30 23:59:59'
    group by ureg.email),
max_count as (
    select MAX(count)
    from count_users)
select count_u.email 
from count_users as count_u, max_count as max_c
where max_c.max = count_u.count;


/*query 3*/
with Rio_Maior as (
    select nome, latitude, longitude
    from local_publico where nome = 'Rio Maior'),
Anomalia_years as(
    select id, extract(year from anomalia.ts) as years
    from anomalia)
select distinct u.email, u.password
    from utilizador as u natural join incidencia as inc natural join item as it(item_id, descricao, localizacao, latitude, longitude), Anomalia_years as ay, Rio_Maior
    where ay.years = '2019' and inc.anomalia_id = ay.id and it.latitude > Rio_Maior.latitude;


/*query 4*/
with Rio_Maior as (
    select latitude, longitude
    from local_publico where nome = 'Rio Maior'),
join_corr_procorr as (
    select * from proposta_de_correcao natural join correcao natural join incidencia),
join_inc_user as (
    select utq.email, anomalia_id, item_id from incidencia as inc natural join utilizador_qualificado as utq),
except_f as (
    (select email,anomalia_id, item_id from join_inc_user) except (select email, anomalia_id, item_id from join_corr_procorr))
select distinct ex.email from item as it, except_f as ex, Rio_Maior as rm where it.id = ex.item_id and it.latitude < rm.latitude;

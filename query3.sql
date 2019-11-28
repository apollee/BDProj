with Rio_Maior as (select nome, latitude, longitude FROM local_publico WHERE nome = 'Rio Maior'),
Anomalia_years as (select id, extract(year from anomalia.ts) as years FROM anomalia)
select distinct u.email, u.password
FROM utilizador as u, incidencia as inc, item as it, local_publico as lp, Anomalia_years as ay, Rio_Maior
WHERE u.email = inc.email AND it.id = inc.item_id AND ay.years = '2019' AND inc.anomalia_id = ay.id AND it.latitude > Rio_Maior.latitude;

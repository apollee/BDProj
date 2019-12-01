with Rio_Maior as (
    select nome, latitude, longitude
    FROM local_publico WHERE nome = 'Rio Maior'),
Anomalia_years as(
    select id, extract(year from anomalia.ts) as years
    FROM anomalia
)
select distinct u.email, u.password
    FROM utilizador as u natural join incidencia as inc natural join item as it(item_id, descricao, localizacao, latitude, longitude), Anomalia_years as ay, Rio_Maior
    WHERE ay.years = '2019' AND inc.anomalia_id = ay.id AND it.latitude > Rio_Maior.latitude;

    
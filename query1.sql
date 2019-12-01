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
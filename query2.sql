/*Qual o utilizador regular que registou mais anomalias de traducao no 1 semestre de 2019?*/

with count_users as(
    select ureg.email, count(ureg.email)
    from utilizador_regular as ureg, incidencia as inc, anomalia_traducao as anomtrad, anomalia as anom
    where ureg.email = inc.email
    and inc.anomalia_id = anomtrad.id
    and anom.id = anomtrad.id
    group by ureg.email),
max_count as (
    select MAX(count)
    from count_users
)
select count_u.email 
from count_users as count_u, max_count as max_c
where max_c.max = count_u.count;
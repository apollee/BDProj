with count_users as(
    select  ureg.email, count(ureg.email)
    from utilizador_regular as ureg natural join incidencia as inc natural join anomalia_traducao as anomtrad natural join anomalia as anom
    where anom.ts between '2019-01-01 00:00:00' AND '2019-6-30 23:59:59'
    group by ureg.email),
max_count as (
    select MAX(count)
    from count_users
)
select count_u.email 
from count_users as count_u, max_count as max_c
where max_c.max = count_u.count;
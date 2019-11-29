with Rio_Maior as (
    select latitude, longitude
    from local_publico where nome = 'Rio Maior'
),
join_corr_procorr as (
    select * from proposta_de_correcao natural join correcao natural join incidencia
),
join_inc_user as (
    select utq.email, anomalia_id, item_id from incidencia as inc natural join utilizador_qualificado as utq
),
except_f as (
    (select email,anomalia_id, item_id from join_inc_user) except (select email, anomalia_id, item_id from join_corr_procorr)
)
select distinct ex.email from item as it, except_f as ex, Rio_Maior as rm where it.id = ex.item_id and it.latitude < rm.latitude;








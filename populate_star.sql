insert into d_utilizador(id_utilizador, email, tipo)
    select email, 'regular' from utilizador_regular;

insert into d_utilizador(id_utilizador, email, tipo)
    select email, 'qualificado' from utilizador_qualificado; 

insert into d_local(id_local, latitude, longitude, nome)
    select latitude, longitude, nome from local_publico;

insert into d_lingua(id_lingua, lingua)
    select lingua from anomalia;

insert into d_tempo(id_tempo, dia, dia_da_semana, semana, mes, trimestre, ano)
    select extract(day from data_hora) as dia,
    extract(dow from data_hora) as dia_da_semana,
    extract(week from data_hora) as semana,
    extract(month from data_hora) as mes,
    extract(quarter from data_hora) as trimestre,
    extract(year from data_hora) as ano

insert into fact_table(id_utilizador, id_tempo, id_local, id_lingua, tipo_nomalia, com_proposta)
    select id_utilizador, id_tempo, id_local, id_lingua
    from d_utilizador


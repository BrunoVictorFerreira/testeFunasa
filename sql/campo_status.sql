USE funasa;
-- Add a new column 'stausDemandas' to table 'demandas'
ALTER TABLE demandas
    ADD statusDemandas boolean default 0;
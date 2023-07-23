DROP TABLE IF EXISTS Counties;
DROP TABLE IF EXISTS States;
CREATE TABLE States (
    state_id serial PRIMARY KEY,
    name VARCHAR (100) NOT NULL,
    abbreviation VARCHAR (10) NOT NULL
);

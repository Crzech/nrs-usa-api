CREATE TABLE Counties (
    county_id serial PRIMARY KEY,
    name VARCHAR ( 100 ) NOT NULL,
    state_id INTEGER REFERENCES States (state_id) ON DELETE CASCADE,
    population BIGINT NOT NULL
);

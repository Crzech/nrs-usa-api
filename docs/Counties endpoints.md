# Counties

## pSQL Create statement:
```psql
CREATE TABLE Counties (
    county_id serial PRIMARY KEY,
    name VARCHAR ( 100 ) NOT NULL,
    state_id INTEGER REFERENCES States (state_id) ON DELETE CASCADE,
    population BIGINT NOT NULL
);
```

## Endpoints curls
Replace `<JWT_TOKEN>` with token provided by `/authenticate` endpoint

### Get county by id (`GET /counties/{county_id}`)
```
curl --location 'localhost:8080/counties/8' \
--header 'Authorization: Bearer <JWT_TOKEN>'
```
### Create County (`POST /counties`)
```
curl --location 'localhost:8080/counties' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer <JWT_TOKEN>' \
--data '{
    "name": "TEST COunty",
    "state_id": 3,
    "population": 65000
}'
```

### Update County population (`PUT /counties/{county_id}`)
```
curl --location --request PUT 'localhost:8080/counties/8' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer <JWT_TOKEN>' \
--data '{
    "population": 300
}'
```

### Delete County (`DELETE /counties/{county_id}`)
```
curl --location --request DELETE 'localhost:8080/counties/3155' \
--header 'Authorization: Bearer <JWT_TOKEN>' \
```


# States

## pSQL Create statement:
```psql
CREATE TABLE States (
    state_id serial PRIMARY KEY,
    name VARCHAR (100) NOT NULL,
    abbreviation VARCHAR (10) NOT NULL
);
```

## Endpoints curls
Replace `<JWT_TOKEN>` with token provided by `/authenticate` endpoint

### Get all states (`GET /states`)
```
curl --location 'localhost:8080/states' \
--header 'Authorization: Bearer <JWT_TOKEN>'
```

### Get counties by state (`GET /states/{state_id}/counties`)
```
curl --location 'localhost:8080/states/3/counties' \
--header 'Authorization: Bearer <JWT_TOKEN>'

```


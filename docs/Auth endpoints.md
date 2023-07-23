# Auth

## pSQL Create statement:
```psql
CREATE TABLE Users (
    id serial PRIMARY KEY,
	username VARCHAR ( 50 ) UNIQUE NOT NULL,
	password VARCHAR ( 150 ) NOT NULL,
	email VARCHAR ( 255 ) UNIQUE NOT NULL,
	created_on TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
```

## Endpoints curls

### Create user (`POST /user`)
```
curl --location 'localhost:8080/user' \
--header 'Content-Type: application/json' \
--data-raw '{
    "username": "cmontufar",
    "password": "123456",
    "email": "cpernillo11@gmail.com"
}'
```

### Authenticate user (`POST /user/authentication`)
```
curl --location 'localhost:8080/authentication' \
--header 'Content-Type: application/json' \
--data '{
    "username": "cmontufar",
    "password": "123456"
}'
```


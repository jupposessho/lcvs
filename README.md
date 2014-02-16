Low cost video store - REST API
========

Installation

 - Run queries from sql/schema.sql
 - Run queries from sql/data.sql
 - Run queries from sql/with_history/schema.sql
 - Run queries from sql/with_history/data.sql

Authentication:
----
Basic HTTP authentication

Admin user:

id: 4
username: aa@aa.aa
password: 123
Header for admin: "Authorization: Basic YWFAYWEuYWE6MTIz"

password for all user: 123

Examples:
----

Search movies by title includes "the":

```sh
curl -i -H "Authorization: Basic YWFAYWEuYWE6MTIz" -H "Accept: application/json" -X
GET "http://192.168.33.101/movie?title=the"
```

List hired movies:

```sh
curl -i -H "Authorization: Basic YWFAYWEuYWE6MTIz" -H "Accept: application/json" -X
GET "http://192.168.33.101/hire"
```

Delete user:

```sh
curl -i -H "Authorization: Basic YWFAYWEuYWE6MTIz" -H "Accept: application/json" -X
DELETE "http://192.168.33.101/user/213"
```

Create movie:

```sh
curl -i -H "Accept: application/json" -X POST -H "Authorization: Basic YWFAYWEuYWE6MTIz" -d
"category_id=1&amount=1&price=1&title=Terminator" "http://192.168.33.101/movie/"
```

Update user:

```sh
curl -i -H "Authorization: Basic YWFAYWEuYWE6MTIz" -H "Accept: application/json" -X
PUT -d "nick_name=newNick" "http://192.168.33.101/user/1"
```

Create user:

```sh
curl -i -H "Authorization: Basic YWFAYWEuYWE6MTIz" -H "Accept: application/json" -X
POST -d "email=aa@aa.ab&password=123" "http://192.168.33.101/user/"
```

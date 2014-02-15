lcvs
====

Low cost video store - REST API

Installation

SQL schema and data:

The common schema and data file are in the 'sql' directory.
There are two different solutions for the schema and statistics.

1. files are in the sql/no_history directory
This solution is the most simple approach for this problem, it stores the hire records and uses references
for movie_id and user_id to connect tables. This is a good solution until a movie or user is not deleted or a price of
a movie is not modified. In that cases the statistics would be inaccurate. The deletion problem could be solved with
a new status field for each table and the delete method would be an update for this column. But it would not resolve
the price update problem.

/I kept this solution only because the statistics queries are more complex then in the other solution./

2. files are in the sql/with_history directory
In this solution all relevant data is stored in the hire_history table and no foreign keys are used, so no
modification in the user or movie table take any affect to the statistics.

Routes:

create user/movie
POST /user HTTP/1.1
"category_id=1&title=Terminator&price=1.99&amount=3"

update user
PUT /user/1 HTTP/1.1
"price=0.99&amount=9"

delete user
DELETE /user/1 HTTP/1.1

search movies
GET /movie?title=the&category=action HTTP/1.1

list hires
GET /hire HTTP/1.1
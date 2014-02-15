-- queries without hire_history table

-- video store income for the given day/week/month
-- day: '2014-01-01'
SELECT COALESCE(sum(m.price), 0)
FROM hire h
INNER JOIN movie m ON m.id = h.movie_id
WHERE LEFT(take, 10) = '2014-01-01';

-- week: 0
SELECT COALESCE(sum(m.price), 0)
FROM hire h
INNER JOIN movie m ON m.id = h.movie_id
WHERE WEEK(take) = 0;

-- month: 2014-01
SELECT COALESCE(sum(m.price), 0)
FROM hire h
INNER JOIN movie m ON m.id = h.movie_id
WHERE LEFT(take, 7) = '2014-01';

--  list of top 50 movies’ titles by users’ spent credit
SELECT m.title AS movieTitle
FROM hire h
INNER JOIN movie m ON m.id = h.movie_id
GROUP BY m.id
ORDER BY sum(m.price) DESC
LIMIT 50;

--  list of top 10 users’ names by spent credit
SELECT u.nick_name
FROM hire h
INNER JOIN movie m ON m.id = h.movie_id
INNER JOIN user u ON u.id = h.user_id
GROUP BY u.id
ORDER BY sum(m.price) DESC
LIMIT 10;

--  list of top 3 categories by hire count
SELECT c.title AS categoryTitle
FROM hire h
INNER JOIN movie m ON m.id = h.movie_id
INNER JOIN category c ON c.id = m.category_id
GROUP BY c.id
ORDER BY count(c.id) DESC
LIMIT 3;

-- list of movies that hired more than 10 times
SELECT m.title AS movieTitle
FROM hire h
INNER JOIN movie m ON m.id = h.movie_id
GROUP BY h.movie_id
HAVING count(h.movie_id) > 10;

-- hired movies’ titles - currently hired = has not returned yet
SELECT DISTINCT m.title AS movieTitle
FROM hire h
INNER JOIN movie m ON m.id = h.movie_id
WHERE h.return IS NULL;
-- if we don't want to exclude deleted movies we should use LEFT JOIN
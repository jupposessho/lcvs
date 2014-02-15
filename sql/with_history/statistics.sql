--  queries WITH hire_history table

-- video store income for the given day/week/month
-- day: '2014-01-01'
SELECT COALESCE(sum(price), 0)
FROM hire_history
WHERE LEFT(take, 10) = '2014-01-01';

-- week: 0
SELECT COALESCE(sum(price), 0)
FROM hire_history
WHERE WEEK(take) = 0;


-- month: 2014-01
SELECT COALESCE(sum(price), 0)
FROM hire_history
WHERE LEFT(take, 7) = '2014-01';


--  list of top 50 movies’ titles by users’ spent credit
SELECT movie_title
FROM hire_history
GROUP BY movie_id
ORDER BY sum(price) DESC
LIMIT 50;


--  list of top 10 users’ names by spent credit
SELECT nick_name
FROM hire_history
GROUP BY user_id
ORDER BY sum(price) DESC
LIMIT 10;

--  list of top 3 categories by hire count
SELECT category_title
FROM hire_history
GROUP BY category_id
ORDER BY count(category_id) DESC
LIMIT 3;

-- list of movies that hired more than 10 times
SELECT movie_title
FROM hire_history
GROUP BY movie_id
HAVING count(movie_id) > 10;

-- hired movies’ titles - currently hired = has not returned yet
SELECT DISTINCT movie_title
FROM hire_history
WHERE `return` IS NULL;


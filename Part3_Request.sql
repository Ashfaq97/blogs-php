/*check value for tables*/

SELECT * FROM blogs;
SELECT * FROM blogstags;
SELECT * FROM comments;
SELECT * FROM follows;
SELECT * FROM hobbies;
SELECT * FROM users;


/*To complete the request*/
/*Request 1 user X's blogs which all comments are positive*/
/*only scooby and batman have valid results*/
SELECT blogid
FROM blogs
WHERE (created_by IN ('scooby')) 
AND blogid IN (SELECT blogid FROM comments WHERE sentiment IN ('Positive'))
AND blogid NOT IN (SELECT blogid FROM comments WHERE sentiment IN ('Negative'));



/*Request 2 list users posted most blogs on 10/10/2021, list all ties*/
/*2021-10-10 no blogs. insert values on 2020-04-12*/
INSERT INTO `blogs` VALUES (11,'New value Test1','New value This need to be counted','2020-04-12','jdoe'), (12,'New value test2','New value this should not be counted.','2020-04-12','batman'),(13,'New value test3','New value this should be counted.','2020-04-12','catlover'),(14,'New value test4','New value this should be counted.','2020-04-12','catlover');
 
SELECT created_by
FROM blogs 
WHERE pdate='2020-04-12'
GROUP BY created_by
HAVING COUNT(*)=(
	SELECT MAX(counts)
    FROM (SELECT created_by, COUNT(*) AS counts 
		FROM blogs 
		WHERE pdate='2020-04-12'
		GROUP BY created_by) AS a
        );
        


/*Request 3 list users followed by both X and Y*/
/*batman is followed by catlover and pacman*/
SELECT DISTINCT leadername
FROM follows
WHERE leadername IN (SELECT DISTINCT leadername FROM follows WHERE followername in ('catlover'))
AND leadername IN (SELECT DISTINCT leadername FROM follows WHERE followername in ('pacman'));

SELECT X.leadername
FROM (SELECT DISTINCT leadername FROM follows WHERE followername in ('catlover')) as X, 
(SELECT DISTINCT leadername FROM follows WHERE followername in ('pacman')) as Y
WHERE X.leadername=Y.leadername;

/*Request 4 display all users nver posted a blog*/
SELECT DISTINCT username
FROM users
WHERE username NOT IN (SELECT created_by FROM blogs);

/*Request 5 display all users posted only negative comments*/
SELECT DISTINCT posted_by
FROM comments
WHERE posted_by IN (SELECT posted_by FROM comments WHERE sentiment IN ('Negative'))
AND posted_by NOT IN (SELECT posted_by FROM comments WHERE sentiment IN ('Positive'));

/*Request 6 display users all the blogs posted never received negative comments*/
SELECT DISTINCT created_by
FROM blogs
WHERE blogs.created_by IN (SELECT created_by FROM blogs WHERE blogid NOT IN (SELECT blogid FROM comments WHERE sentiment IN ('Negative')))
AND blogs.created_by NOT IN (SELECT created_by FROM blogs WHERE blogid IN (SELECT blogid FROM comments WHERE sentiment IN ('Negative')));














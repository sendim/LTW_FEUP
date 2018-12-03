.mode columns
.headers on
.nullvalue NULL 

PRAGMA foreign_keys = ON;

-- drop triggers if existent
DROP TRIGGER IF EXISTS propagateStoryLike;
DROP TRIGGER IF EXISTS propagateStoryDislike;
DROP TRIGGER IF EXISTS propagateCommentLike;
DROP TRIGGER IF EXISTS propagateCommentDislike;

-- story voting triggers
CREATE TRIGGER propagateStoryLike
AFTER UPDATE OF likes ON story
FOR EACH ROW
BEGIN
    INSERT INTO votesStory VALUES(Old.username,Old.id,1);
END;

CREATE TRIGGER propagateStoryDislike
AFTER UPDATE OF dislikes ON story
FOR EACH ROW
BEGIN
    INSERT INTO votesStory VALUES(Old.username,Old.id,-1);
END;

-- comment voting triggers
CREATE TRIGGER propagateCommentLike
AFTER UPDATE OF likes ON comment
FOR EACH ROW
BEGIN
    INSERT INTO votesComment VALUES(Old.username,Old.id,1);
END;

CREATE TRIGGER propagateCommentDislike
AFTER UPDATE OF dislikes ON comment
FOR EACH ROW
BEGIN
    INSERT INTO votesComment VALUES(Old.username,Old.id,-1);
END;
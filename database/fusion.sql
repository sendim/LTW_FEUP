PRAGMA FOREIGN_KEYS = ON;

-- drop tables if they exist
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS story;
DROP TABLE IF EXISTS comment;
DROP TABLE IF EXISTS channel;
DROP TABLE IF EXISTS subscribed;
DROP TABLE IF EXISTS votesStory;
DROP TABLE IF EXISTS votesComment;
DROP TABLE IF EXISTS images;

CREATE TABLE user (
  userId INTEGER PRIMARY KEY,
  username VARCHAR NOT NULL UNIQUE,
  password VARCHAR, 
  name VARCHAR,
  description VARCHAR,
  points INTEGER
);

CREATE TABLE story (
  storyId INTEGER PRIMARY KEY,
  title VARCHAR,
  published INTEGER, -- date when the article was published in epoch format
  userId INTEGER REFERENCES user NOT NULL, -- who wrote the article
  text VARCHAR,
  likes INTEGER,
  dislikes INTEGER,
  channel INTEGER REFERENCES channel
);

CREATE TABLE comment (
  commentId INTEGER PRIMARY KEY,
  storyId INTEGER REFERENCES story NOT NULL,
  userId INTEGER REFERENCES user NOT NULL,
  published INTEGER, -- date when news item was published in epoch format
  text VARCHAR,
  likes INTEGER,
  dislikes INTEGER,
  referencedComment INTEGER REFERENCES comment
);

CREATE TABLE channel (
  channelId INTEGER PRIMARY KEY,
  title VARCHAR UNIQUE
);

CREATE TABLE subscribed (
  userId INTEGER REFERENCES user NOT NULL,
  channel INTEGER REFERENCES channel NOT NULL,
  PRIMARY KEY(userId, channel)
);

CREATE TABLE votesStory (
  userId INTEGER REFERENCES user NOT NULL,
  storyId INTEGER REFERENCES story NOT NULL,
  vote INTEGER NOT NULL,
  PRIMARY KEY(userId, storyId)
);

CREATE TABLE votesComment (
  userId INTEGER REFERENCES user NOT NULL,
  commentId INTEGER REFERENCES comment NOT NULL,
  vote INTEGER NOT NULL,
  PRIMARY KEY(userId, commentId)
);

CREATE TABLE images (
  imageId INTEGER PRIMARY KEY,
  userId INTEGER REFERENCES user,
  title VARCHAR NOT NULL
);
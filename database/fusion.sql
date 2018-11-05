PRAGMA FOREIGN_KEYS = ON;

-- drop tables if they exist
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS story;
DROP TABLE IF EXISTS comment;
DROP TABLE IF EXISTS channel;
DROP TABLE IF EXISTS subscribed;
DROP TABLE IF EXISTS likesStory;
DROP TABLE IF EXISTS likesComment;

CREATE TABLE user (
  username VARCHAR PRIMARY KEY,
  password VARCHAR,
  name VARCHAR,
  description VARCHAR,
  points INTEGER
);

CREATE TABLE story (
  id INTEGER PRIMARY KEY,
  title VARCHAR,
  published INTEGER, -- date when the article was published in epoch format
  username VARCHAR REFERENCES user NOT NULL, -- who wrote the article
  text VARCHAR,
  likes INTEGER,
  channel INTEGER REFERENCES channel
);

CREATE TABLE comment (
  id INTEGER PRIMARY KEY,
  storyId INTEGER REFERENCES story NOT NULL,
  username VARCHAR REFERENCES user NOT NULL,
  published INTEGER, -- date when news item was published in epoch format
  text VARCHAR,
  likes INTEGER,
  referencedComment INTEGER REFERENCES comment
);

CREATE TABLE channel (
  id INTEGER PRIMARY KEY,
  title VARCHAR
);

CREATE TABLE subscribed (
  user VARCHAR REFERENCES user NOT NULL,
  channel INTEGER REFERENCES channel NOT NULL,
  PRIMARY KEY(user, channel)
);

CREATE TABLE likesStory (
  user VARCHAR REFERENCES user NOT NULL,
  story INTEGER REFERENCES story NOT NULL,
  PRIMARY KEY(user, story)
);

CREATE TABLE likesComment (
  user VARCHAR REFERENCES user NOT NULL,
  comment INTEGER REFERENCES comment NOT NULL,
  PRIMARY KEY(user, comment)
);

CREATE TABLE users (
  username VARCHAR PRIMARY KEY,
  password VARCHAR,
  name VARCHAR,
  description  VARCHAR,
  points VARCHAR
);

CREATE TABLE story (
  id INTEGER PRIMARY KEY,
  title VARCHAR,
  published INTEGER, -- date when the article was published in epoch format
  username VARCHAR REFERENCES users, -- who wrote the article
  fulltext VARCHAR,
  gostos INTEGER,
  channel VARCHAR REFERENCES channel
);

CREATE TABLE channel (
  id INTEGER PRIMARY KEY,
  title VARCHAR
);

CREATE TABLE comments (
  id INTEGER PRIMARY KEY,
  news_id INTEGER REFERENCES news,
  username VARCHAR REFERENCES users,
  published INTEGER, -- date when news item was published in epoch format
  text VARCHAR,
  gostos INTEGER
);



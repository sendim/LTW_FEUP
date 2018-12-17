/*- Pass#1 is greatestathlete Pass#2 is musiclover 
  Pass#3 is gaminglife Pass#4 is funnymom
  Pass#5 is titanic Pass#6 is genericperson

 */
INSERT INTO user VALUES (NULL,"dominic", "$2y$12$Hr2EH5k5GR078YDujrT2J.tDchycw/gpQKbFej1sdwZgj7ETpGcZC", "Dominic Woods","The greatest athlete of all time",0);
INSERT INTO user VALUES (NULL,"zachary", "$2y$12$14mghIMzMD9d5pEhJqn.SOV7NjaWWMB7Vx3CNFsHB3Hhql8DXvN8W", "Zachary Young","Music enthusiast.",0);
INSERT INTO user VALUES (NULL,"alicia", "$2y$12$41aVymXNqdT0NuNb/PCdN.Z/uH0MqJ/kn808onX3GIg/OLoy5Vp86", "Alicia Hamilton","Gaming is what I love.",0);
INSERT INTO user VALUES (NULL,"abril", "$2y$12$jzetwAegB0v384jEA.lAxeeavt6Rqe.47W6SueCqT2lvOjCF.ol5G", "Abril Cooley","Love my son.",0);
INSERT INTO user VALUES (NULL,"tiarna", "$2y$12$6JyDMxX5FpXg2/wVHPJfTuLf7nU87FWjucRDgxjlqzB.ldqka7V6i", "Tiarna Barrera","The best 195 minutes from my life was watching the Titanic for the first time",0);
INSERT INTO user VALUES (NULL,"ali", "$2y$12$BFBfG7PqBiWicH3POhbbbuk4emqcWW5sdVDgx6zlryRVN9ypCJXEq", "Ali Alvarado","Just living my life",0);

INSERT INTO channel VALUES (NULL,4,'work');
INSERT INTO channel VALUES (NULL,3,'gaming');
INSERT INTO channel VALUES (NULL,5,'food');
INSERT INTO channel VALUES (NULL,1,'sport');
INSERT INTO channel VALUES (NULL,2,'music');

INSERT INTO story VALUES (NULL,
  'Joke of the day',
  1544456652,
  4,
  'Claustrophobic people are more productive thinking outside the box.',
	0,
	1
);

INSERT INTO story VALUES (NULL,
  'Just too good',
  1544620101,
  4,
  'What do you call a cow that can play a musical instrument? A moo-sician.',
	0,
	5
);

INSERT INTO story VALUES (NULL,
  'I love my work!',
  1507901651,
  4,
  'I started my new job a week ago writing jokes for the newspaper and I got to say I have never been happier!!',
	0,
	1
);

INSERT INTO story VALUES (NULL,
  'Just played Red Dead Redemption 2!!',
  1544889601,
  3,
  'Best game ever!! It just feels so vast and free, i will probably play all day.',
	0,
	2
);

INSERT INTO story VALUES (NULL,
  'So frustrating',
  1543697115,
  3,
  'Been playing "Cuphead" for 3 hours and i am still at the first level someone help me.',
	0,
	2
);

INSERT INTO story VALUES (NULL,
  'Do you know "MF DOOM"?',
  1544993115,
  2,
  'Amazing artist I just discovered, I have no words, just listen to any of his songs.',
	0,
	5
);

INSERT INTO story VALUES (NULL,
  'Oh my god the new album of Abstract Orchestra!!!!',
  1542299535,
  2,
  'Its so jazzy but at the same time so hip hoppy, just so complex and catchy havent heard an album like this in a long time i give it a 5/5.',
	0,
	5
);

INSERT INTO story VALUES (NULL,
  'Thai Tanic',
  1544797215,
  5,
  'Today I ate at the new restaurant called "Thai Tanic", I had to go because im like the biggest Titanic fan there is, I mean did you know that there was an actress that was actually on Titanic called Gloria Stuart, how crazy is that, if it was me I would stay away from anything that reminded me of it, but im getting a bit sidetracked, the point I wanted to make was that there was enough space for both Rose and Jack.',
	0,
	3
);

INSERT INTO story VALUES (NULL,
  'Amazing movie soundtrack',
  1544718735,
  5,
  'Did you know that the guy who made the soundtrack for Avatar, James Horner was also the same from the amazing movie Titanic, now I know why Avatar is so well rated.',
	0,
	5
);

INSERT INTO story VALUES (NULL,
  'Goal reached',
  1543602015,
  1,
  'Went to the gym four times this month, new personal record, soon I will be the greatest to ever live, Usain Bolt you better run.',
	0,
	4
);

INSERT INTO story VALUES (NULL,
  'The strongest',
  1543689615,
  1,
  'Managed to carry all the groceries from my car to my house, Brian Shaw you better lift harder.',
	0,
	4
);

INSERT INTO story VALUES (NULL,
  'Best Goal ever?!?!?!?',
  1543776015,
  1,
  'Just playing football with my good friend Ali when I just kicked the ball into the top bin, Cristiano Ronaldo you better kick higher.',
	0,
	4
);

INSERT INTO story VALUES (NULL,
  'Just swam',
  1544035215,
  1,
  'Went to the second time to my swimming lessons, soon i will be able to swim a lot faster than everyone, Michael Phelps you better practice.',
	0,
	4
);

INSERT INTO comment VALUES (NULL,
  12,
  6,
  1543952415,
  'Dude chill, It was a lucky shot.',
	0,
	NULL
);

INSERT INTO comment VALUES (NULL,
  12,
  1,
  1543952475,
  'You are just jealous, dont worry I will share some fame when I reach fame',
	0,
	1
);

INSERT INTO comment VALUES (NULL,
  13,
  6,
  1544039115,
  'I saw you today, you looked really motivated, keep up.',
	0,
	NULL
);

INSERT INTO comment VALUES (NULL,
  13,
  1,
  1544039116,
  'What is that supposed to mean, I am always motivated not just today, I swear some people...',
	0,
	3
);

INSERT INTO comment VALUES (NULL,
  13,
  4,
  1544175916,
  'Real proud of my son, always a great help.',
	0,
	NULL
);

INSERT INTO comment VALUES (NULL,
  13,
  1,
  1544183116,
  'Stop embarassing me mom',
	0,
	5
);

INSERT INTO comment VALUES (NULL,
  8,
  6,
  1544975116,
  'Ok... How was the food?',
	0,
	NULL
);

INSERT INTO comment VALUES (NULL,
  8,
  5,
  1544975716,
  'Well I wasnt there when they shot the movie, but i can assume it was heavenly.',
	0,
	7
);

INSERT INTO comment VALUES (NULL,
  9,
  2,
  1544975716,
  'I know right, James Horner is so good, his music is just divine, rest in piece.',
	0,
	NULL
);

INSERT INTO comment VALUES (NULL,
  9,
  5,
  1544979316,
  'Oh no, I didnt know he passed away, now who is gonna direct the soundtrack of Titanic 2??',
	0,
	9
);


INSERT INTO comment VALUES (NULL,
  1,
  5,
  1544957716,
  'Very funny, here is another one: Want to break the ice with your co-workers? Tell them a Titanic joke.',
	0,
	NULL
);

INSERT INTO comment VALUES (NULL,
  6,
  1,
  1544612116,
  'That is trash dude, you should listen to my mixtape instead, it is fire just search for Dominic Lamar on soundcloud.',
	0,
	NULL
);

INSERT INTO comment VALUES (NULL,
  6,
  1,
  1544612416,
  'Well that was certainly something, I mean just not my style.',
	0,
	12
);

INSERT INTO comment VALUES (NULL,
  1,
  1,
  1544613316,
  'Just you wait this isnt the last time you hear from Dominic West',
	0,
	13
);

INSERT INTO comment VALUES (NULL,
  9,
  1,
  1544991316,
  'Dont worry, I will personally direct the Titanic 2 and its gonna be a deaf film, surely this was never done',
	0,
	10
);

INSERT INTO votesStory VALUES (1,10,1);
INSERT INTO votesStory VALUES (1,11,1);
INSERT INTO votesStory VALUES (1,12,1);
INSERT INTO votesStory VALUES (1,13,1);
INSERT INTO votesStory VALUES (1,5,-1);
INSERT INTO votesStory VALUES (1,6,-1);

INSERT INTO votesStory VALUES (2,1,1);
INSERT INTO votesStory VALUES (2,3,1);
INSERT INTO votesStory VALUES (2,12,1);
INSERT INTO votesStory VALUES (2,13,1);

INSERT INTO votesStory VALUES (3,1,1);
INSERT INTO votesStory VALUES (3,3,1);
INSERT INTO votesStory VALUES (3,5,-1);

INSERT INTO votesStory VALUES (4,1,1);
INSERT INTO votesStory VALUES (4,3,1);
INSERT INTO votesStory VALUES (4,10,1);
INSERT INTO votesStory VALUES (4,11,1);
INSERT INTO votesStory VALUES (4,12,1);
INSERT INTO votesStory VALUES (4,13,1);

INSERT INTO votesStory VALUES (5,1,1);
INSERT INTO votesStory VALUES (5,3,1);

INSERT INTO votesStory VALUES (6,1,1);
INSERT INTO votesStory VALUES (6,3,1);
INSERT INTO votesStory VALUES (6,12,1);
INSERT INTO votesStory VALUES (6,13,1);

INSERT INTO subscribed VALUES (1,4);
INSERT INTO subscribed VALUES (1,2);
INSERT INTO subscribed VALUES (2,5);
INSERT INTO subscribed VALUES (2,3);
INSERT INTO subscribed VALUES (3,2);
INSERT INTO subscribed VALUES (3,1);
INSERT INTO subscribed VALUES (4,1);
INSERT INTO subscribed VALUES (4,4);
INSERT INTO subscribed VALUES (5,3);
INSERT INTO subscribed VALUES (5,5);
INSERT INTO subscribed VALUES (6,1);
INSERT INTO subscribed VALUES (6,2);
INSERT INTO subscribed VALUES (6,3);
INSERT INTO subscribed VALUES (6,4);
INSERT INTO subscribed VALUES (6,5);

INSERT INTO images VALUES (NULL,NULL,NULL,'default');

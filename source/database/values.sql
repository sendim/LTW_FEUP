
-- All passwords are 1234 in SHA-1 format
INSERT INTO users VALUES ("dominic", "7110eda4d09e062aa5e4a390b0a572ac0d2c0220", "Dominic Woods"," ",0);
INSERT INTO users VALUES ("zachary", "7110eda4d09e062aa5e4a390b0a572ac0d2c0220", "Zachary Young"," ",0);
INSERT INTO users VALUES ("alicia", "7110eda4d09e062aa5e4a390b0a572ac0d2c0220", "Alicia Hamilton"," ",0);
INSERT INTO users VALUES ("abril", "7110eda4d09e062aa5e4a390b0a572ac0d2c0220", "Abril Cooley"," ",0);

INSERT INTO channel VALUES (NULL, 
	'theme'
);


INSERT INTO story VALUES (NULL,
  'Lorem ipsum dolor sit amet, consectetur',
  1507901651,
  'abril',
  'Aliquam justo nibh, lacinia suscipit odio nec, condimentum tincidunt urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lacus mi, blandit nec dolor in, ultrices condimentum elit. Quisque interdum, ante non pellentesque viverra, ipsum velit ultrices tortor, id rhoncus orci est at augue. In hac habitasse platea dictumst. Donec dolor nisi.

Suspendisse potenti. Nullam lacinia dictum massa sed sagittis. Sed id ultrices libero. Cras convallis commodo ante, quis sagittis erat vulputate et. Cras nunc lorem, mollis a nibh eget, dignissim auctor lorem. Suspendisse placerat convallis ante vitae dapibus. Donec tellus felis, tincidunt eget iaculis eget, varius non turpis. Curabitur in eros at sapien fringilla venenatis eu a risus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque eu consectetur tellus. Suspendisse vitae urna ex. Cras sit amet enim id turpis gravida lacinia a vitae lacus. Vivamus augue ante, pellentesque sed semper non, rutrum ornare ante. Orci varius.',
	0,
	0
	);

INSERT INTO story VALUES (NULL,
  'Donec placerat tempor ex sit amet',
  1508074451,
  'alicia',
  'Morbi bibendum volutpat pellentesque. In bibendum est et orci semper rhoncus. Sed cursus vel orci sed malesuada. Fusce ac dictum ligula, quis hendrerit ipsum. Proin hendrerit a.',
	0,
	0
);

INSERT INTO story VALUES (NULL,
  'Vivamus fermentum dui nisi, at posuere',
  1508160851,
  'zachary',
  'Nullam et arcu non tellus congue ultrices id id enim. Donec malesuada, neque ut euismod ullamcorper, massa dui congue ante, quis scelerisque enim arcu vel turpis. Praesent ornare elementum finibus. Integer aliquam risus ac lorem mollis, sit amet dignissim dolor faucibus. Praesent non eros ut ligula rhoncus egestas. Duis ex nibh, maximus eget vulputate nec, sagittis in ex. Suspendisse potenti.

Praesent pellentesque, nisi ut ultrices sagittis, mauris urna tincidunt nibh, eu faucibus ante nisi eu nisl. Quisque commodo est non sapien rhoncus, a fringilla tellus ultricies. Curabitur eget massa mauris. Sed semper ultrices ante, in cursus enim vehicula at. Praesent.',
	0,
	0
);

INSERT INTO story VALUES (NULL,
  'Quisque a dapibus magna, non scelerisque',
  1508247278,
  'dominic',
  'Duis condimentum metus et ex tincidunt, faucibus aliquet ligula porttitor. In vitae posuere massa. Donec fermentum magna sit amet suscipit pulvinar. Cras in elit sapien. Vivamus nunc sem, finibus ac suscipit ullamcorper, hendrerit vitae urna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque eget tincidunt orci. Mauris congue ipsum non purus tristique, at venenatis elit pellentesque. Etiam congue euismod molestie. Mauris ex orci, lobortis a faucibus sed, sagittis eget neque.',
	0,
	0	
);

INSERT INTO comments VALUES (NULL,
  4,
  'dominic',
  1508247532,
  'Aliquam maximus commodo dui, ut viverra urna vulputate et. Donec posuere vitae sem sed vehicula. Sed in erat eu diam fringilla sodales. Aenean lacinia vulputate nisl, dignissim dignissim nisl. Nam at nibh mollis, facilisis nibh sit amet, mattis urna. Maecenas.',
	0
  );

INSERT INTO comments VALUES (NULL,
  4,
  'abril',
  1508247632,
  'Duis scelerisque purus fermentum turpis euismod congue. Phasellus sit amet sem mollis, imperdiet quam porta, volutpat purus. In et sodales urna, sed cursus lectus. Vivamus a massa vitae nisl lobortis laoreet nec tristique magna. Mauris egestas ipsum eu sem lacinia.',
	0
);

INSERT INTO comments VALUES (NULL,
  3,
  'alicia',
  1508247132,
  'Phasellus at neque nec nunc scelerisque eleifend eu eu risus. Praesent in nibh viverra, posuere ligula condimentum, accumsan tellus. Vivamus varius sem a mauris finibus, ac iaculis risus scelerisque. Nullam fermentum leo dui, at fermentum tellus consequat id. Pellentesque eleifend.',
	0
 );

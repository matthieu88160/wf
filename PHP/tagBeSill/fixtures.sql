INSERT INTO Category(label, description) VALUES
	('Management', 'Lorem ipsum dolor sit amet'),
	('ERP', 'Lorem ipsum dolor sit amet'),
	('DMZ', 'Lorem ipsum dolor sit amet');

INSERT INTO Status(label, description) VALUES
	('Analysis', 'Lorem ipsum'),
	('In progress', 'Lorem ipsum'),
	('Blocked', 'Lorem ipsum'),
	('Out of budget', 'Lorem ipsum');

INSERT INTO Project(title, description, image, publishingDate, statusId) VALUES
	('wf3pm', 'Lorem Ipsum sit amet', 'img/myPicture1.png', NOW(), 1),
	('forgeNet', 'Lorem Ipsum sit amet', 'img/myPicture2.png', NOW(), 3),
	('WF CI', 'Lorem Ipsum sit amet', 'img/myPicture2.png', NOW(), 1),
	('Facebook', 'Lorem Ipsum sit amet', 'img/myPicture2.png', NOW(), 4);

INSERT INTO Project(title, description, image, publishingDate, statusId) VALUES
	('Apolearn', 'Lorem Ipsum sit amet', 'img/myPicture1.png', NOW(), 1);
    
INSERT INTO ProjectCategory VALUES
	(1, 1),
	(2, 2),
	(2, 3);

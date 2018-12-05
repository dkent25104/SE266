CREATE TABLE IF NOT EXISTS DisneyCharacters (
	DisneyCharacterID INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
	DisneyCharacterName VARCHAR(150) DEFAULT NULL,
	DisneyCharacterImage VARCHAR(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS DisneyVotes (
	DisneyVoteID INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    DisneyCharacterID INT UNSIGNED,
	VoterIP VARCHAR(150) DEFAULT NULL,
	VoterDateTime DATETIME DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

INSERT INTO DisneyCharacters SET DisneyCharacterName = 'Donald Duck', DisneyCharacterImage='donald.png';
INSERT INTO DisneyCharacters SET DisneyCharacterName = 'Mickey Mouse', DisneyCharacterImage='mickey.png';
INSERT INTO DisneyCharacters SET DisneyCharacterName = 'Goofy', DisneyCharacterImage='goofy.png';


SELECT * FROM DisneyCharacters;

SELECT * FROM DisneyVotes;

SELECT DisneyCharacterName, COUNT(*) AS VoteCount
FROM DisneyCharacters c LEFT OUTER JOIN DisneyVotes v ON c.DisneyCharacterID=v.DisneyCharacterID
GROUP BY DisneyCharacterName
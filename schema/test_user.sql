-- User 1
INSERT isatonic.Users(id, regDate, birth, gender, firstName, lastName, email, flag)
    VALUES ('Uh5c80fae06d3b33-96938238',
            '2019-03-07 20:05:04',
            '1990-01-01',
            'm',
            '中川',
            '勲俊',
            'test@isatonic.com',
            'active')
;

INSERT isatonic.UserDetails(id, userName)
    VALUES ('Uh5c80fae06d3b33-96938238',
            'ISATONIC')
;

INSERT isatonic.Password(id, pass)
    VALUES ('Uh5c80fae06d3b33-96938238',
            '$2y$10$PEv14N4YUFo4Ofctjce4HuNty6Tz742eOihUp5nIlV0etU03p/zBS')
;

INSERT isatonic.Grade(user, gpoint)
    VALUES ('Uh5c80fae06d3b33-96938238',
            0)
;

INSERT isatonic.Wallet(user, point)
    VALUES ('Uh5c80fae06d3b33-96938238',
            0)
;

-- User 2
INSERT isatonic.Users(id, regDate, birth, gender, firstName, lastName, email, flag)
    VALUES ('Uu5c84d7c4bc3de0-98005632',
            '2019-03-07 20:05:04',
            '1990-01-01',
            'm',
            '佐藤',
            '太郎',
            'test2@isatonic.com',
            'active')
;

INSERT isatonic.UserDetails(id, userName)
    VALUES ('Uu5c84d7c4bc3de0-98005632',
            'ISATONIC')
;

INSERT isatonic.Password(id, pass)
    VALUES ('Uu5c84d7c4bc3de0-98005632',
            '$2y$10$PEv14N4YUFo4Ofctjce4HuNty6Tz742eOihUp5nIlV0etU03p/zBS')
;

INSERT isatonic.Grade(user, gpoint)
    VALUES ('Uu5c84d7c4bc3de0-98005632',
            0)
;

INSERT isatonic.Wallet(user, point)
    VALUES ('Uu5c84d7c4bc3de0-98005632',
            10000)
;

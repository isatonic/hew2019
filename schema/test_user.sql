-- User 1
INSERT isatonic.Users(id, regDate, birth, gender, firstName, lastName, email, flag)
    VALUES ('Ut5c852486450b96-91598333',
            '2019-03-07 20:05:04',
            '1990-01-01',
            'm',
            '勲俊',
            '中川',
            'test@isatonic.com',
            'active')
;

INSERT isatonic.UserDetails(id, userName)
    VALUES ('Ut5c852486450b96-91598333',
            'ISATONIC')
;

INSERT isatonic.Password(id, pass)
    VALUES ('Ut5c852486450b96-91598333',
            '$2y$10$PEv14N4YUFo4Ofctjce4HuNty6Tz742eOihUp5nIlV0etU03p/zBS')
;

INSERT isatonic.Grade(user, gpoint)
    VALUES ('Ut5c852486450b96-91598333',
            0)
;

INSERT isatonic.Wallet(user, point)
    VALUES ('Ut5c852486450b96-91598333',
            0)
;

-- User 2
INSERT isatonic.Users(id, regDate, birth, gender, firstName, lastName, email, flag)
    VALUES ('Ut5c8524e55c8085-18973584',
            '2019-03-07 20:05:04',
            '1990-01-01',
            'm',
            '太郎',
            '佐藤',
            'test2@isatonic.com',
            'active')
;

INSERT isatonic.UserDetails(id, userName)
    VALUES ('Ut5c8524e55c8085-18973584',
            'testUser')
;

INSERT isatonic.Password(id, pass)
    VALUES ('Ut5c8524e55c8085-18973584',
            '$2y$10$PEv14N4YUFo4Ofctjce4HuNty6Tz742eOihUp5nIlV0etU03p/zBS')
;

INSERT isatonic.Grade(user, gpoint)
    VALUES ('Ut5c8524e55c8085-18973584',
            0)
;

INSERT isatonic.Wallet(user, point)
    VALUES ('Ut5c8524e55c8085-18973584',
            10000)
;

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
            'password')
;

INSERT isatonic.Grade(user, gpoint)
    VALUES ('Uh5c80fae06d3b33-96938238',
            0)
;

INSERT isatonic.Wallet(user, point)
    VALUES ('Uh5c80fae06d3b33-96938238',
            0)
;

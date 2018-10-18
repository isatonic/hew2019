START TRANSACTION;
DROP DATABASE IF EXISTS isatonic;
CREATE DATABASE isatonic CHARACTER SET UTF8;

use isatonic;
SET sql_mode='strict_all_tables';

CREATE TABLE M_Users(
        email           varchar(255)    PRIMARY KEY,
        id              varchar(255),
        userName        varchar(32)     NOT NULL,
        firstName       varchar(32)     NOT NULL,
        lastName        varchar(32)     NOT NULL,
        birth           date            NOT NULL,
        icon            varchar(255),
        regDate         datetime        DEFAULT CURRENT_TIMESTAMP,
        flag            enum('verifying', 'active', 'unsubscribe', 'paused', 'banned')  NOT NULL
) ENGINE=InnoDB;

CREATE TABLE M_Products(
        id              varchar(255)    PRIMARY KEY,
        fileName        varchar(255)    NOT NULL,
        title           varchar(64)     NOT NULL,
        author          varchar(255),
        postDate        datetime        DEFAULT CURRENT_TIMESTAMP,
        price           int             NOT NULL,
        authorComment   varchar(255),
        FOREIGN KEY (author) REFERENCES M_Users(email) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE M_Tags(
        id              varchar(32)     PRIMARY KEY,
        name            varchar(64)     NOT NULL,
) ENGINE=InnoDB;

CREATE TABLE M_Limits(
        id              varchar(32)     PRIMARY KEY,
        title           varchar(255)    NOT NULL,
        duration        int             NOT NULL
) ENGINE=InnoDB;

CREATE TABLE M_ContactTags(
        id              varchar(32)     PRIMARY KEY,
        name            varchar(64)     NOT NULL
) ENGINE=InnoDB;

CREATE TABLE T_Tag(
        product         varchar(255),
        tagID           varchar(32),
        PRIMARY KEY (product, tagID),
        FOREIGN KEY (product) REFERENCES M_Products(id) ON UPDATE CASCADE ON DELETE CASCADE,
        FOREIGN KEY (tagID) REFERENCES M_Tags(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE T_Cart(
        product         varchar(255),
        user            varchar(255),
        PRIMARY KEY (product, user),
        FOREIGN KEY (product) REFERENCES M_Products(id) ON UPDATE CASCADE ON DELETE CASCADE,
        FOREIGN KEY (user) REFERENCES M_Users(email) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE T_Purchase(
        product                 varchar(255),
        buyer                   varchar(255),
        purchaseDate            datetime       DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (product, buyer),
        FOREIGN KEY (product) REFERENCES M_Products(id) ON UPDATE CASCADE ON DELETE CASCADE,
        FOREIGN KEY (buyer) REFERENCES M_Users(email) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE T_ProductReport(
        reporter                varchar(255),
        product                 varchar(255)                                            NOT NULL,
        reportDate              datetime                                                DEFAULT CURRENT_TIMESTAMP,
        flag                    enum('unconfirm', 'progress', 'complete', 'hold')       NOT NULL,
        reason                  varchar(255),
        FOREIGN KEY (reporter) REFERENCES M_Users(email) ON UPDATE CASCADE ON DELETE SET NULL,
        FOREIGN KEY (product) REFERENCES M_Products(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE T_Contact(
        id              int                                             PRIMARY KEY AUTO_INCREMENT,
        contactDate     datetime                                        DEFAULT CURRENT_TIMESTAMP,
        flag            enum('unconfirm', 'progress', 'complete')       NOT NULL,
        name            varchar(32)                                     NOT NULL,
        email           varchar(255)                                    NOT NULL,
        title           varchar(255)                                    NOT NULL,
        tag             varchar(32),
        detail          varchar(2000)                                   NOT NULL,
        FOREIGN KEY (tag) REFERENCES M_ContactTags(id) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE T_Password(
        user    varchar(255)    PRIMARY KEY,
        pass    varchar(128)    NOT NULL,
        FOREIGN KEY (user) REFERENCES M_Users(email) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE T_PassReset(
        user            varchar(255)    NOT NULL,
        newpass         varchar(128)    NOT NULL,
        code            char(4)         NOT NULL,
        resetLimit      datetime        NOT NULL,
        FOREIGN KEY (user) REFERENCES M_Users(email) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE T_MessageReport(
        reporter                varchar(255),
        accused                 varchar(255)                                            NOT NULL,
        reportDate              datetime                                                DEFAULT CURRENT_TIMESTAMP,
        flag                    enum('unconfirm', 'progress', 'complete', 'hold')       NOT NULL,
        reason                  varchar(2000)                                           NOT NULL,
        FOREIGN KEY (reporter) REFERENCES M_Users(email) ON UPDATE CASCADE ON DELETE SET NULL,
        FOREIGN KEY (accused) REFERENCES M_Users(email) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE T_Message(
        sender          varchar(255)    NOT NULL,
        destination     varchar(255),
        message         varchar(255)    NOT NULL,
        sendDate        datetime       DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (sender) REFERENCES M_Users(email) ON UPDATE CASCADE ON DELETE CASCADE,
        FOREIGN KEY (destination) REFERENCES M_Users(email) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE T_PointCharge(
        user            varchar(255),
        point           int             NOT NULL,
        datetime       datetime       DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user) REFERENCES M_Users(email) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE T_Wallet(
        user    varchar(255)    PRIMARY KEY,
        point   int             DEFAULT 0,
        FOREIGN KEY (user) REFERENCES M_Users(email) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE T_MailVerify(
        email           varchar(255),
        verifycode      char(4),
        verifyLimit     datetime
) ENGINE=InnoDB;

CREATE TABLE T_Grade(
        user    varchar(255)    PRIMARY KEY,
        gpoint  int             DEFAULT 0,
        FOREIGN KEY (user) REFERENCES M_Users(email) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE T_UserLimit(
        user            varchar(255),
        limitType       varchar(32),
        limitStart      datetime       DEFAULT CURRENT_TIMESTAMP,
        limitEnd        datetime,
        reason          varchar(2000)   NOT NULL,
        FOREIGN KEY (user) REFERENCES M_Users(email) ON UPDATE CASCADE ON DELETE CASCADE,
        FOREIGN KEY (limitType) REFERENCES M_Limits(id) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

COMMIT;

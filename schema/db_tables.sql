START TRANSACTION
;

DROP DATABASE IF EXISTS isatonic
;

CREATE DATABASE isatonic
    CHARACTER SET utf8
    COLLATE utf8_general_ci
;

USE isatonic
;

SET sql_mode = 'strict_all_tables'
;

CREATE TABLE Users (
    id        char(25) PRIMARY KEY,
    regDate   datetime DEFAULT CURRENT_TIMESTAMP,
    birth     date                                                            NOT NULL,
    gender    enum ('m', 'f')                                                 NOT NULL,
    firstName varchar(32)                                                     NOT NULL,
    lastName  varchar(32)                                                     NOT NULL,
    email     varchar(255) UNIQUE,
    flag      enum ('verifying', 'active', 'unsubscribe', 'paused', 'banned') NOT NULL
)
    ENGINE = InnoDB
;

CREATE TABLE UserDetails (
    id       char(25) PRIMARY KEY,
    userName varchar(32) NOT NULL,
    FOREIGN KEY (id) REFERENCES Users (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
)
    ENGINE = InnoDB
;

CREATE TABLE Products (
    id            char(50) PRIMARY KEY,
    author        char(25),
    postDate      datetime DEFAULT CURRENT_TIMESTAMP,
    price         int          NOT NULL,
    type          enum ('photo', 'paint') NOT NULL,
    title         varchar(64)  NOT NULL,
    fileName      varchar(255) NOT NULL,
    jenre         enum ('ビジネス', 'スポーツ', 'イベント', '動物', '魚', '植物', '虫', 'SF', '料理', '野菜', '楽器', 'ファッション', '風景', '雑貨', '文房具', '乗り物', '家具', '宇宙', '空', '建物', '人'),
    authorComment varchar(255),
    FOREIGN KEY (author) REFERENCES Users (id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
)
    ENGINE = InnoDB
;

CREATE TABLE Tags (
    id   char(6) PRIMARY KEY,
    name varchar(64) NOT NULL
)
    ENGINE = InnoDB
;

CREATE TABLE Limits (
    id       char(4) PRIMARY KEY,
    duration int          NOT NULL,
    title    varchar(255) NOT NULL
)
    ENGINE = InnoDB
;

CREATE TABLE ContactTags (
    id   char(5) PRIMARY KEY,
    name varchar(64) NOT NULL
)
    ENGINE = InnoDB
;

CREATE TABLE Tag (
    product char(50),
    tagID   char(6),
    PRIMARY KEY (product, tagID),
    FOREIGN KEY (product) REFERENCES Products (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (tagID) REFERENCES Tags (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
)
    ENGINE = InnoDB
;

CREATE TABLE Cart (
    product char(50),
    user    char(25),
    PRIMARY KEY (product, user),
    FOREIGN KEY (product) REFERENCES Products (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (user) REFERENCES Users (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
)
    ENGINE = InnoDB
;

CREATE TABLE Purchase (
    product      char(50),
    buyer        char(25),
    purchaseDate datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (product, buyer),
    FOREIGN KEY (product) REFERENCES Products (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (buyer) REFERENCES Users (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
)
    ENGINE = InnoDB
;

CREATE TABLE ProductReport (
    reporter   char(25),
    product    char(50),
    reportDate datetime DEFAULT CURRENT_TIMESTAMP,
    flag       enum ('unconfirm', 'progress', 'complete', 'hold') NOT NULL,
    reason     varchar(255),
    FOREIGN KEY (reporter) REFERENCES Users (id)
        ON UPDATE CASCADE
        ON DELETE SET NULL,
    FOREIGN KEY (product) REFERENCES Products (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
)
    ENGINE = InnoDB
;

CREATE TABLE Contact (
    id          int PRIMARY KEY AUTO_INCREMENT,
    tag         char(5),
    contactDate datetime        DEFAULT CURRENT_TIMESTAMP,
    flag        enum ('unconfirm', 'progress', 'complete') NOT NULL,
    name        varchar(32)                                NOT NULL,
    email       varchar(255)                               NOT NULL,
    title       varchar(255)                               NOT NULL,
    detail      varchar(2000)                              NOT NULL,
    FOREIGN KEY (tag) REFERENCES ContactTags (id)
        ON UPDATE CASCADE
        ON DELETE SET NULL
)
    ENGINE = InnoDB
;

CREATE TABLE ContactReply (
    id       int PRIMARY KEY AUTO_INCREMENT,
    source   int,
    operator char(25),
    date     datetime        DEFAULT CURRENT_TIMESTAMP,
    detail   varchar(2000) NOT NULL,
    FOREIGN KEY (source) REFERENCES Contact (id)
        ON UPDATE CASCADE
        ON DELETE SET NULL,
    FOREIGN KEY (operator) REFERENCES Users (id)
        ON UPDATE CASCADE
        ON DELETE SET NULL
)
    ENGINE = InnoDB
;

CREATE TABLE Password (
    id   char(25) PRIMARY KEY,
    pass varchar(255) NOT NULL,
    FOREIGN KEY (id) REFERENCES Users (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
)
    ENGINE = InnoDB
;

CREATE TABLE PassReset (
    code       char(4)      NOT NULL,
    resetLimit datetime     NOT NULL,
    email      varchar(255) NOT NULL,
    newpass    varchar(255) NOT NULL,
    FOREIGN KEY (email) REFERENCES Users (email)
        ON UPDATE CASCADE
        ON DELETE CASCADE
)
    ENGINE = InnoDB
;

CREATE TABLE MessageReport (
    reporter   char(25),
    accused    char(25)                                           NOT NULL,
    reportDate datetime DEFAULT CURRENT_TIMESTAMP,
    flag       enum ('unconfirm', 'progress', 'complete', 'hold') NOT NULL,
    reason     varchar(2000)                                      NOT NULL,
    FOREIGN KEY (reporter) REFERENCES Users (id)
        ON UPDATE CASCADE
        ON DELETE SET NULL,
    FOREIGN KEY (accused) REFERENCES Users (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
)
    ENGINE = InnoDB
;

CREATE TABLE Message (
    sender      char(25)     NOT NULL,
    destination char(25),
    message     varchar(255) NOT NULL,
    sendDate    datetime DEFAULT CURRENT_TIMESTAMP,
    INDEX (sender, destination),
    FOREIGN KEY (sender) REFERENCES Users (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (destination) REFERENCES Users (id)
        ON UPDATE CASCADE
        ON DELETE SET NULL
)
    ENGINE = InnoDB
;

CREATE TABLE MessageCheck (
    user      char(25) NOT NULL,
    target char(25),
    lastCheck   timestamp DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (user, target),
    FOREIGN KEY (user, target) REFERENCES Message (sender, destination)
        ON UPDATE CASCADE
        ON DELETE CASCADE
)
    ENGINE = InnoDB
;

CREATE TABLE PointCharge (
    user     char(25),
    point    int NOT NULL,
    datetime datetime DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user) REFERENCES Users (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
)
    ENGINE = InnoDB
;

CREATE TABLE Wallet (
    user  char(25) PRIMARY KEY,
    point int DEFAULT 0,
    FOREIGN KEY (user) REFERENCES Users (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
)
    ENGINE = InnoDB
;

CREATE TABLE MailVerify (
    verifycode  char(4),
    verifyLimit datetime,
    email       varchar(255),
    FOREIGN KEY (email) REFERENCES Users (email)
        ON UPDATE CASCADE
        ON DELETE CASCADE
)
    ENGINE = InnoDB
;

CREATE TABLE Grade (
    user   char(25) PRIMARY KEY,
    gpoint int DEFAULT 0,
    FOREIGN KEY (user) REFERENCES Users (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
)
    ENGINE = InnoDB
;

CREATE TABLE UserLimit (
    user       char(25),
    limitType  char(4),
    limitStart datetime DEFAULT CURRENT_TIMESTAMP,
    limitEnd   datetime,
    reason     varchar(2000) NOT NULL,
    FOREIGN KEY (user) REFERENCES Users (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (limitType) REFERENCES Limits (id)
        ON UPDATE CASCADE
        ON DELETE SET NULL
)
    ENGINE = InnoDB
;

CREATE TABLE Friends (
    user   char(25),
    friend char(25),
    flag   enum ('wait', 'active', 'block'),
    PRIMARY KEY (user, friend),
    FOREIGN KEY (user) REFERENCES Users (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (friend) REFERENCES Users (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
)
    ENGINE = InnoDB
;

CREATE VIEW Auth AS
    SELECT U.id AS id, U.email as email, P.pass AS pass, U.flag AS flag
        FROM Users U,
             Password P
        WHERE U.id = P.id
;

COMMIT
;

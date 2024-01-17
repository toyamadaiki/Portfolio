CREATE TABLE CONTACT (
ID INT PRIMARY KEY AUTO_INCREMENT,
QUESTION VARCHAR(400) NOT NULL,
ANSWER VARCHAR(400) NOT NULL DEFAULT '未回答',
NAME VARCHAR(100)
);

insert into contact (NAME, QUESTION, ANSWER)
            values('紀伊国屋天神イムズ店','本は今何冊？','100000冊');
insert into contact (NAME, QUESTION, ANSWER)
            values('ジュンク堂書店福岡店','県に集荷場はいくつある？','県に１つあります');
insert into contact (NAME, QUESTION, ANSWER)
            values('福岡金文堂本店','ブックサンタはボランティア活動？','はい、その通りです');
insert into contact (NAME, QUESTION)
            values('ジュンク堂書店福岡店','ブックサンタはどんな活動？');
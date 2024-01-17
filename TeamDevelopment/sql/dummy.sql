insert into bookdata (ISBN,STORAGE,TITLE,WRITER,PUBLISHER,KEYWORD,GENERATION,CATEGORY,GENRE,COUNT) 
                values('9784295013396','福岡県','スッキリわかるSQL入門','中山清喬/飯田理恵子','インプレス','SQL入門書プログラミング','高校生','不明','ほにゃらら','3');
insert into bookdata (ISBN,STORAGE,TITLE,WRITER,PUBLISHER,KEYWORD,GENERATION,CATEGORY,GENRE,COUNT) 
                values('9784295013396','長崎県','スッキリわかるSQL入門','中山清喬/飯田理恵子','インプレス','SQL入門書プログラミング','高校生','不明','ほにゃらら','1');
insert into bookdata (ISBN,STORAGE,TITLE,WRITER,PUBLISHER,KEYWORD,GENERATION,CATEGORY,GENRE,COUNT) 
                values('9784295013396','大阪府','スッキリわかるSQL入門','中山清喬/飯田理恵子','インプレス','SQL入門書プログラミング','高校生','不明','ほにゃらら','2');
insert into bookdata (ISBN,STORAGE,TITLE,WRITER,PUBLISHER,KEYWORD,GENERATION,CATEGORY,GENRE,COUNT) 
                values('9784295005940','福岡県','スッキリわかるサーブレット&JSP入門','国本大悟','インプレス','JavaサーブレットJSP入門書プログラミング','高校生','不明','ほにゃらら','2');
insert into bookdata (ISBN,STORAGE,TITLE,WRITER,PUBLISHER,KEYWORD,GENERATION,CATEGORY,GENRE,COUNT) 
                values('9784295005940','大阪府','スッキリわかるサーブレット&JSP入門','国本大悟','インプレス','JavaサーブレットJSP入門書プログラミング','高校生','不明','ほにゃらら','4');
insert into bookdata (ISBN,STORAGE,TITLE,WRITER,PUBLISHER,KEYWORD,GENERATION,CATEGORY,GENRE,COUNT) 
                values('9784295007807','長崎県','スッキリJava入門','中山清喬/国本大悟','インプレス','Java入門書プログラミング','高校生','不明','ほにゃらら','1');
insert into bookdata (ISBN,STORAGE,TITLE,WRITER,PUBLISHER,KEYWORD,GENERATION,CATEGORY,GENRE,COUNT) 
                values('9784295007807','大阪府','スッキリJava入門','中山清喬/国本大悟','インプレス','Java入門書プログラミング','高校生','不明','ほにゃらら','3');

insert into address (NAME,PREF,TYPE,PASS)
            values('紀伊国屋天神イムズ店','福岡県','店舗','1234');
insert into address (NAME,PREF,TYPE,PASS)
            values('ジュンク堂書店福岡店','福岡県','店舗','2345');
insert into address (NAME,PREF,TYPE,PASS)
            values('福岡金文堂本店','福岡県','店舗','3456');
insert into address (NAME,PREF,TYPE,PASS)
            values('ブックサンタ運営本部','東京都','本部','1234');
insert into address (NAME,PREF,ADDR,TYPE,PASS)
            values('福岡集荷場','福岡県','福岡市西区今宿青木10-10-10','集荷場','3456');
insert into address (NAME,PREF,ADDR,TYPE,PASS)
            values('大阪集荷場','大阪府','大阪府大阪市大正区鶴町4-5-6','集荷場','0000');
insert into address (NAME,PREF,ADDR,TYPE,PASS)
            values('長崎集荷場','長崎県','長崎県佐世保市立神町1-1-1','集荷場','3333');

insert into ordr(TITLE,STORAGE,NEARESTSTRG,DESTINATION)
            values('スッキリわかるSQL入門','福岡県','福岡県','福岡県福岡市南区XX 3-3-4');
insert into ordr(TITLE,STORAGE,NEARESTSTRG,DESTINATION)
            values('スッキリJava入門','長崎県','福岡県','福岡県福岡市南区XX 3-3-4');
insert into ordr(TITLE,STORAGE,NEARESTSTRG,DESTINATION)
            values('スッキリわかるサーブレット&JSP入門','福岡県','大阪府','福岡県福岡市南区XX 3-3-4');
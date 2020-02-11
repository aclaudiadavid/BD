insert into LocalPublico values (39.336775, -8.936379, 'Rio Maior');
insert into LocalPublico values (44.983273, 2.439238, 'Gare');
insert into LocalPublico values (20.230432, -2.231435, 'Place');
insert into LocalPublico values (-23.432492, 40.123532, 'South');
insert into LocalPublico values (-60.147329, -16.241824, 'Far');
insert into LocalPublico values (2.324932, 16.323523, 'Swim');
insert into LocalPublico values (-6.325434, -23.249485, 'Train Station');
insert into LocalPublico values (4.324654, 7.346894, 'Sunny Beach');

insert into Item values (1, 44.983273, 2.439238, 'Na porta de entrada' , 'Restaurante Frio');
insert into Item values (2, -6.325434, -23.249485, 'Casa de banho masculina' , 'WC');
insert into Item values (3, 44.983273, 2.439238, 'Na porta de entrada' , 'Restaurante Frio');
insert into Item values (4, 44.983273, 2.439238, 'Ao balcao', 'Restaurante Frio');
insert into Item values (5, -23.432492, 40.123532, 'Table number 3', 'Pink Bank');
insert into Item values (6, 4.324654,  7.346894, 'By the bar', 'Coconut Bar');

insert into Anomalia values (1, '(6,9),(3,4)', 'foto.jpeg', 'pt', '2019-01-02 22:36:49', 'faltam palavras', B'0');
insert into Anomalia values (2, '(23,45),(12,22)', 'wc.jpeg', 'fr', '2019-11-23 16:34:11', 'mal orthographié', B'1');
insert into Anomalia values (3, '(12,10),(3,4)', 'foto222.jpeg', 'ger', '2019-09-10 12:11:29', 'Das ist nicht gut', B'1');
insert into Anomalia values (4, '(19,9),(5,6)', '201922.jpeg', 'pt', '2019-02-02 11:12:11', 'ortografia', B'0');
insert into Anomalia values (5, '(63,55),(46,32)', 'IMG220190323.jpeg', 'en', '2019-03-23 08:54:11', 'misspelled', B'1');
insert into Anomalia values (6, '(11,22),(10,9)', 'jdsabf.jpeg', 'en', '2019-04-30 09:11:43', 'switched letters', B'0');

insert into AnomaliaTraducao values (1, '(2,10),(1,2)','en');
insert into AnomaliaTraducao values (4, '(33,36),(23,26)','ger');
insert into AnomaliaTraducao values (6, '(10,12),(9,7)','pt');

insert into Duplicado values (1, 3);

insert into Utilizador values ('aaaaa@gmail.com', 'soufixe');
insert into Utilizador values ('123123@yahoooo.br', 'password');
insert into Utilizador values ('ola123@hotmail.com', 'JF2Hesd#$');
insert into Utilizador values ('ursinhocorderosa@gmail.com', 'skadoa');
insert into Utilizador values ('adiokwaio@gmail.com', 'Lp0#ir');
insert into Utilizador values ('pendent99@outlook.com', 'hello123');

insert into UtilizadorQualificado values ('123123@yahoooo.br');
insert into UtilizadorQualificado values ('aaaaa@gmail.com');
insert into UtilizadorQualificado values ('pendent99@outlook.com');

insert into UtilizadorRegular values ('ola123@hotmail.com');
insert into UtilizadorRegular values ('ursinhocorderosa@gmail.com');
insert into UtilizadorRegular values ('adiokwaio@gmail.com');

insert into Incidencia values (1, 1, '123123@yahoooo.br');
insert into Incidencia values (2, 2, 'adiokwaio@gmail.com');
insert into Incidencia values (3, 3, 'aaaaa@gmail.com');
insert into Incidencia values (4, 4, '123123@yahoooo.br');
insert into Incidencia values (5, 5, 'pendent99@outlook.com');
insert into Incidencia values (6, 6, 'ola123@hotmail.com');

insert into PropostaCorrecao values ('123123@yahoooo.br', 1, '2019-01-24 12:26:55', 'Devia dizer open em vez de abierto.');
insert into PropostaCorrecao values ('aaaaa@gmail.com', 1, '2019-11-25 11:14:21', 'Devrait dire aller, ne pas allir.');
insert into PropostaCorrecao values ('pendent99@outlook.com', 1, '2019-05-11 10:12:54', 'The R should be at the end of the word');
insert into PropostaCorrecao values ('123123@yahoooo.br', 2, '2019-03-05', 'Devia ser gut');

insert into Correcao values ('123123@yahoooo.br', 1, 1);
insert into Correcao values ('aaaaa@gmail.com', 1, 2);
insert into Correcao values ('pendent99@outlook.com', 1, 6);
insert into Correcao values ('123123@yahoooo.br', 2, 4);


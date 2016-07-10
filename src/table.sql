drop table member;
drop table jobs;
drop table tag;
drop table apply;
drop table tagged;
drop table history;

drop table member;
drop table jobs;
drop table tag;
drop table apply;
drop table tagged;
drop table history;

create table member (
	id	serial,
	login_name	varchar UNIQUE,
	pwd	varchar NOT NULL,
	first_name	varchar,
	second_name	varchar,
	sex	char(1),
	birth_year	char(4),
	birth_month	char(2),
	birth_day	char(2),
	tell	varchar,
	postal_code1	varchar,
	postal_code2	varchar,
	mail	varchar,
	address_p	varchar,
	address_c	varchar,
	address_l	varchar,
	primary key(id)
);

create table jobs (
	id	serial,
	jobs_name	varchar,
	payment	int,
	address_p	varchar,
	address_c	varchar,
	sign_year	char(4),
	sign_month	char(2),
	sign_day	char(2),
	limit_old_up	int,
	limit_old_down	int,
	company	varchar,
	limit_year	char(4),
	limit_month	char(2),
	limit_day	char(2),
	category	varchar,
	primary key(id)
);

create table tag (
	id	serial,
	tag_name	varchar,
	primary key(id)
);

create table tagged (
	id	serial,
	j_id	int,
	t_id	int,
	foreign key(j_id) references jobs(id),
	foreign key(t_id) references tag(id),
	primary key(id)
);

create table apply (
	id serial,
	j_id	int,
	m_id	int,
	foreign key(j_id) references jobs(id),
	foreign key(m_id) references member(id),
	primary key(id)
);

create table history (
	id serial,
	j_id	int,
	m_id	int,
	foreign key(j_id) references jobs(id),
	foreign key(m_id) references member(id),
	primary key(id)
);

insert into member(login_name, pwd, first_name, second_name, sex, birth_year, birth_month, birth_day, tell, mail) values('hayate', 'h', '早川', 'ゆうと', 'm', 1994, 11, 11, '09051516363', 'hyh@dada');

insert into jobs(jobs_name, payment, sign_year, sign_month, sign_day, address_p, address_c, limit_old_up, limit_old_down, company, limit_year, limit_month, limit_day, category)
	values('塾講師', 1000, '2014', '11', '15', '東京都', '豊島区', 18, 32, 'A会社', '2015', '01', '10', '教育');
insert into jobs(jobs_name, payment, sign_year, sign_month, sign_day, address_p, address_c, limit_old_up, limit_old_down, company, limit_year, limit_month, limit_day, category)
	values('進学塾講師', 1100, '2014', '11', '16', '東京都', '豊島区', 18, 28, 'A会社', '2015', '02', '20', '教育');
insert into jobs(jobs_name, payment, sign_year, sign_month, sign_day, address_p, address_c, limit_old_up, limit_old_down, company, limit_year, limit_month, limit_day, category)
	values('プログラマー', 1000, '2014', '11', '17', '東京都', '千代田区', 18, 28, 'B会社', '2015', '02', '04', 'エンジニア');
insert into jobs(jobs_name, payment, sign_year, sign_month, sign_day, address_p, address_c, limit_old_up, limit_old_down, company, limit_year, limit_month, limit_day, category)
	values('底辺プログラマー', 1200, '2014', '11', '15', '埼玉県', '熊谷市', 18, 29, 'A会社', '2014', '11', '20', 'エンジニア');
insert into jobs(jobs_name, payment, sign_year, sign_month, sign_day, address_p, address_c, limit_old_up, limit_old_down, company, limit_year, limit_month, limit_day, category)
	values('庭掃除', 1900, '2014', '12', '15', '東京都', '江東区', 21, 41, 'C会社', '2015', '01', '02', '清掃・警備');
insert into jobs(jobs_name, payment, sign_year, sign_month, sign_day, address_p, address_c, limit_old_up, limit_old_down, company, limit_year, limit_month, limit_day, category)
	values('殺し屋', 1000, '2015', '01', '03', '東京都', '台東区', 18, 60, 'D会社', '2015', '02', '01', '飲食');
insert into jobs(jobs_name, payment, sign_year, sign_month, sign_day, address_p, address_c, limit_old_up, limit_old_down, company, limit_year, limit_month, limit_day, category)
	values('志村英樹', 1000, '2014', '11', '30', '東京都', '豊島区', 18, 26, 'A会社', '2015', '02', '02', '販売・接客');
insert into jobs(jobs_name, payment, sign_year, sign_month, sign_day, address_p, address_c, limit_old_up, limit_old_down, company, limit_year, limit_month, limit_day, category)
	values('遊戯王', 1000, '2014', '11', '15', '東京都', '港区', 18, 25, 'A会社', '2015', '02', '02', '医療・介護');
insert into jobs(jobs_name, payment, sign_year, sign_month, sign_day, address_p, address_c, limit_old_up, limit_old_down, company, limit_year, limit_month, limit_day, category)
	values('CCサクラ', 1000, '2014', '12', '24', '東京都', '台東区', 18, 20, 'C会社', '2015', '01', '30', '配送・ドライバー');

insert into tag(tag_name) values ('大量募集中');	
insert into tag(tag_name) values ('短期OK');	
insert into tag(tag_name) values ('長期OK');	
insert into tag(tag_name) values ('服装自由');	
insert into tag(tag_name) values ('まかないあり');	
insert into tag(tag_name) values ('髪型自由');	
insert into tag(tag_name) values ('高校生歓迎');	
insert into tag(tag_name) values ('大学生歓迎');	
insert into tag(tag_name) values ('学歴不問');	
insert into tag(tag_name) values ('履歴書不要');	
insert into tag(tag_name) values ('交通費支給');	
insert into tag(tag_name) values ('研修制度あり');	
insert into tag(tag_name) values ('シフト自己申告');	
insert into tag(tag_name) values ('土日祝休み');	

 drop database beautysaloon; 
create database beautysaloon;
use beautysaloon; 

create table Service( /* Услуги */
	id_service            int primary key auto_increment,
    name_service          varchar(55),
    price                 int,
    description_service   text,
    category              varchar(55),
    duration_service      time
    );
    
insert into Service values
	(1, "Аппаратный маникюр", "33", "Аппаратный маникюр – это вид необрезного (европейского) маникюра, при котором кутикула освобождается от омертвевших клеток, оставляя саму кутикулу неповрежденной. Маникюр выполняется при помощи аппарата со сменными шлифовальными насадками, которые быстро вращаются на конце аппарата. Внешне и по издаваемому звуку он очень сильно напоминает бормашинку.", "Маникюр", '03:00:00'),
    (2, "Обрезной маникюр",  "30", "Классический, или обрезной маникюр - это самый популярный вид маникюра в Беларуси, стоит отметить. что во многих странах он запрещен из-за своей небезопасности. При его проведении можно травмировать кутикулу и занести инфекции, и к тому же при не очень умелой манере мастера маникюра после процедуры возможно появление заусенцев.", "Маникюр", '04:00:00'),
    (3, "Европейский маникюр (необрезной)", "30", "Основное достоинство и отличительная черта европейского маникюра- это то, что кожа вокруг ногтя не обрезается, а отодвигается, однако остальные операции проводятся в том же объеме, что и при классическом маникюре. Кутикула размягчается специальными эмульсиями и маслами, а ногтевая пластина шлифуется и полируется. Этот способ абсолютно безопасен и очень подходит обладателям тонкой кожи и близко расположенных кровеносных сосудов.", "Маникюр", '00:30:00'),
    (4, "Французский маникюр", "41", "Самый известный и наиболее элегантный вид маникюра- это &quot;французский&quot; маникюр. Он был создан французскими модельерами из фирмы ORLY , как универсальный маникюр, подходящий к любой одежде и любому случаю. Особенность французского маникюра - это акцент на кончике ногтя. На профессиональном языке этот вид маникюра называют «френч».","Маникюр", '01:00:00'),
    (5, "Мини маникюр", "35", "Мини маникюр - это маникюр, на который вы потратите минимум усилий и времени - самый простой и самый распространенный вид маникюра.", "Маникюр", '00:30:00'),
    (6, "Базисный маникюр", "44", "Базисный маникюр - это основа, без который нельзя обойтись. Это те процедуры, которые обязательно должны присутствовать при любом виде маникюра. Грубо говоря - это мини маникюр плюс уход за кожей и кистями рук, состоящий из пилинга и массажа.", "Маникюр", '04:00:00'),

    (7, "Классический педикюр", "48", "Его также называют мокрым или обрезным. Процедура классического педикюра проходит так: кожа ступни распаривается в ванночке с применением эфирных масел и растительных экстрактов. Этот этап также придает свежести и снимает усталость. Затем проводится дезинфицирующая ванночка. Для дезинфекции обычно применяют соляной раствор. После этого удаляются натоптыши, мозоли и ороговелость. Затем мастер формирует ногти, обрезает околоногтевое пространство, если нужно, исправляет вросшие ногти. За следующий этап этот вид педикюра и получил свое название обрезной. В классическом педикюре кутикула полностью вырезается. В конце процедуры наносится крем или лосьон, делается легкий массаж.", "Педикюр", '01:00:00'),
    (8, "Европейский педикюр", "58", "Он же необрезной. В сущности то же, что и классический. Выполняются те же этапы в такой же последовательности. Разница заключается в том, что при европейском педикюре кутикула не срезается, а отодвигается к основанию ногтя апельсиновой палочкой. Эта процедура считается более гигиеничной и особенно хороша летом, когда из-за открытой обуви ноги сильнее подвержены инфекции. Европейский педикюр также подходит тем, кто посещает подобные процедуры регулярно, у кого ступни не слишком запущены. В целом, разница этих двух видов несущественна, и среди клиентов оба популярны.", "Педикюр", '01:00:00'),
    (9, "Аппаратный педикюр", "20", "Его также называют сухим. Это самый быстрый вид педикюра, который идеально подходит для постоянного ухода за ногами. Процедура действительно проводится насухо. Для размягчения кожи применяют специальный крем или жидкость, которые обладают еще дезинфицирующими и дезодорирующими свойствами. В аппаратном педикюре применяют машинку, напоминающую бор. Все этапы проводятся с помощью насадок и шлифовальных пилок, которые выполняют функции от удаления мозолей до шлифовки ногтей. Регулярный аппаратный педикюр особенно рекомендуется тем, кто постоянно ходит на каблуке.", "Педикюр", '01:00:00');
    
    /*(10,"Коррекция длины", "25", "", "Педикюр", '01:30:00'),
    (11,"Стрижка челки", "10", "", "Педикюр", '01:30:00'),
    (12,"Стрижка одним срезом (без мытья)", "25", "", "Педикюр", '00:30:00');*/
 
create table Employee( /* Сотрудник */
	id_employee         int primary key auto_increment,
    full_name           varchar(255),
    address             varchar(255),
	phone_number        varchar(55),
    length_of_work      int,
    rank_of_master      int,                    /* Разряд-Мастера */
    date_of_employment  date,
    bonus_percentage    int default 0
    );


create table Customer( /* Клиент */
	id_customer     int primary key auto_increment,
    email           varchar(55),
    phone_number    varchar(55),
    first_and_last_name     varchar(255),
    pass            varchar(255),
    customer_discount int default 0
    ); 

/* Заполнил в конце после тригеров записи для таблиц Клиенты*/
    
create table Visit(    /* Посещения */
	id_visit        int primary key auto_increment,
    id_customer     int,    /* Клиент */
    id_service      int,    /* Услуга */
    id_employee     int,    /* Сотрдуник */
    date_of_visit   date,
    time_of_visit   time,
    service_provided bool default false,
    foreign key (id_customer) references Customer(id_customer) on delete cascade on update cascade,
    foreign key (id_service)  references Service(id_service)   on delete cascade on update cascade,
    foreign key (id_employee) references Employee(id_employee) on delete cascade on update cascade
    );

/* Заполнил в конце для таблиц Посещения */
    
create table Material( /* Материал */
	id_material     int primary key auto_increment,
    name_material   varchar(255),
    unit            varchar(55), 				/* Единцы измерения */
    quantity        int, 					/* Количество       */
    manufacturer    varchar(255) 		/* Производитель    */
    );

insert into Material values
    (1, "Перчатки", "шт.", 130, "Schwarzkopf"),
    (2, "Шампунь", "мл.", 50, "Schauma"),
    (3, "Щипцы", "шт.", 34, "Dewal"),
    (4, "Бигуди Липучка", "шт.", 210, "Dewal"),
    (5, "Воротничок для парикмахера бумажный", "рул.", 40, "Estel");
    
create table ConsumptionMaterial( /* Расход материала */
	id_consumption          int primary key auto_increment, /* Счётчик */
    id_material         int,
    date_consumption datetime,
    consumed_quantity   int,
    foreign key (id_material) references Material(id_material) on delete cascade on update cascade
	);

insert into ConsumptionMaterial values
	(1, 2, '2012.12.12',2),
    (2, 1, '2012.12.12',2),
    (3, 3, '2012.12.12',1);

    
create table Administrator(
	id_admin            int primary key auto_increment,
    login               varchar(60),
    pass                varchar(255),
    email               varchar(100),
    admin_registered    datetime
    );

create table FreeOrders(
    id_free_order   int primary key auto_increment,
    id_customer     int,
    id_service      int,
    date_of_visit   date,
    time_of_visit   time,
    foreign key (id_customer) references Customer(id_customer) on delete cascade on update cascade,
    foreign key (id_service)  references Service(id_service)   on delete cascade on update cascade
    );
    

CREATE TRIGGER employee_bonus_percentage
	BEFORE INSERT ON Employee
FOR EACH ROW
SET NEW.bonus_percentage = NEW.length_of_work / NEW.rank_of_master + 1;

    
/* Тригер который добавляет клиенту посетивщему салон больше 5 раз скидку в размере равным пяти */
delimiter //
CREATE TRIGGER customer_discount_insert AFTER INSERT ON Visit
FOR EACH ROW
	BEGIN
    declare new_customer int;
    declare quantity_visit_customer int;
    
    set new_customer = NEW.id_customer;
	set quantity_visit_customer = (select count(id_visit) from Visit where id_customer = new_customer);
    
    if(quantity_visit_customer > 5) then 
        UPDATE Customer SET customer_discount = 5 WHERE id_customer = new_customer; 
	END IF;	
END; //
delimiter ;

delimiter //
CREATE TRIGGER customer_discount_update AFTER UPDATE ON Visit
FOR EACH ROW
	BEGIN
    declare new_customer int;
    declare quantity_visit_customer int;
    
    set new_customer = NEW.id_customer;
	set quantity_visit_customer = (select count(id_visit) from Visit where id_customer = new_customer and service_provided = true);
    
    if(quantity_visit_customer > 5) then 
        UPDATE Customer SET customer_discount = 5 WHERE id_customer = new_customer; 
	END IF;	
END; //
delimiter ;

delimiter //
CREATE TRIGGER admin_pass_insert BEFORE INSERT ON Administrator
FOR EACH ROW
	BEGIN
		SET NEW.pass = md5(NEW.pass);
	END; // 
delimiter ;

delimiter //
CREATE TRIGGER admin_pass_update BEFORE UPDATE ON Administrator
FOR EACH ROW
	BEGIN
		SET NEW.pass = md5(NEW.pass);
	END; // 
delimiter ;

delimiter //
CREATE TRIGGER customer_pass_insert BEFORE INSERT ON Customer
FOR EACH ROW
	BEGIN
		SET NEW.pass = md5(NEW.pass);
	END; // 
delimiter ;

delimiter //
CREATE TRIGGER customer_pass_update BEFORE UPDATE ON Customer
FOR EACH ROW
	BEGIN
		SET NEW.pass = md5(NEW.pass);
	END; // 
delimiter ;

insert into Employee values
    (1, "Светличный Всеволод Андреевич", "ул. Янки Купалы д.3, кв.3", 293107047, 2, 3, '2019.10.10', default),
    (2, "Драпун Александр Игоревич", "ул. Якуба Коласа д.22, кв.33", 447533262, 1, 4, '2019.10.05', default),
    (3, "Винничук Родион Юрьевич", "ул. Леонида д.123, кв.39", 293068086, 3, 5, '2018.12.02', default),
    (4, "Довальцов Никита Юрьевич", "ул. Уручская д.21в, кв.22", 443012258, 1, 3, '2016.08.15', default),
    (5, "Белозарович Данила Александрович", "ул. Куйбышева д.24, кв.91", 291085592, 2, 1, '2018.02.12', default),
    (6, "Белозарович Atljfdf Александрович", "ул. Куйбышева д.24, кв.91", 291085592, 2, 1, '2018.02.12', default);

insert into Customer values
    (null, "kuzov.pasha@gmail.com", 294571298, "Гузов Павел", "12345678", default),
    (null, "maksim.grinevsk@yandex.by", 449034512, "Гриневский Максим", "grin44", default),
    (null, "nikitaandroid@bk.ru", 337064456, "Бокуть Диана", "androidTima", default),
    (null, "arutuz@gmail.com", 445041275, "Юзефович Артур", "arturnabmw", default),
    (null, "zhenyaorlov@mail.ru", 256731256, "Орлов Евгений", "zhenyamarshrutka123", default),
    (null, "zhenyaorlov@mail.ru", 256731256, "Орлов Женя", "zhenyamarshrutka123", default);

/*  id_visit      int primary key auto_increment, 
    id_customer     int,     Клиент 
    id_service      int,     Услуга 
    id_employee     int,     Сотрдуник 
    date_of_visit   date,
    time_of_visit   time,
    service_provided bool, */

insert into Visit VALUES
    (1, 3, 4, 5, '2019.12.19', '17:30', true),
    (2, 2, 6, 3, '2019.11.10', '12:00', true),
    (3, 1, 3, 1, '2019.12.10', '11:30', true),
    (4, 4, 2, 5, '2019.10.04', '12:00', true),
    (5, 4, 2, 5, '2019.10.04', '12:00', true),
    (6, 4, 2, 5, '2019.10.04', '12:00', true),
    (7, 4, 2, 5, '2019.10.04', '12:00', true),
    (8, 4, 2, 5, '2019.10.04', '12:00', true),
	(9, 4, 2, 5, '2019.10.04', '12:00', true);

insert into Administrator values
	(1, "admin", "admin", "rodion.vinnichuk@mail.ru", '2019-10-18 19:01:12');
    
select * from Administrator;
    

/* На какое время и к какому масетру кто записан сегодня */
/*
select Employee.full_name, Customer.name_customer, Visit.time_of_visit FROM Employee INNER JOIN Customer INNER JOIN Visit 
    ON Employee.id_employee = Visit.id_employee
    AND Customer.id_customer = Visit.id_customer WHERE Visit.date_of_visit = Date(Now());*/

    
select * from Customer;

select * from Visit;

/*
select concat(Customer.surname,' ', Customer.name_customer), Customer.phone_number, Service.name_service, Employee.full_name, Visit.date_of_visit, Visit.time_of_visit, Visit.service_provided, round((100 - Customer.customer_discount) / 100 * Service.price, 2)
	FROM Customer INNER JOIN Service INNER JOIN Employee INNER JOIN Visit ON Customer.id_customer = Visit.id_customer AND Service.id_service = Visit.id_service AND Employee.id_employee = Visit.id_employee;
*/
	
/*
select Material.name_material, Service.name_service, ConsumptionMaterial.consumed_quantity 
		FROM Material INNER JOIN Service INNER JOIN ConsumptionMaterial 
        ON Material.id_material = ConsumptionMaterial.id_consumption AND Service.id_service = ConsumptionMaterial.id_consumption;
*/
	
    /*
SELECT 
                        concat(Customer.surname,' ', Customer.name_customer) as first_last_name, 
                        Customer.phone_number, 
                        Service.name_service, 
                        Employee.full_name, 
                        Visit.date_of_visit, 
                        Visit.time_of_visit, 
                        Visit.service_provided, 
                        round((100 - Customer.customer_discount) / 100 * Service.price, 2) as discount
                FROM Customer INNER JOIN Service INNER JOIN Employee INNER JOIN Visit 
                ON Customer.id_customer = Visit.id_customer AND Service.id_service = Visit.id_service AND Employee.id_employee = Visit.id_employee 
                WHERE 
                Customer.phone_number LIKE '%294571298%';
                */
                
/* Добавление в таблицу посещения */
/*SELECT * FROM Visit INNER JOIN Employee ON Visit.id_employee = Employee.id_employee 
		WHERE Visit.time_of_visit = '' AND Visit.date_of_visit = '' AND Employee.full_name = '';*/
        select * from Employee;
        select * from Visit;
        
         select full_name from Employee inner join Visit 
        on Employee.id_employee = Visit.id_employee
        where  Visit.date_of_visit = '2019.10.04' and Visit.time_of_visit = '12:00'
        group by full_name;
        
        
        
        select full_name 
        from Employee  
		where full_name not in
        ((select full_name from Employee inner join Visit 
        on Employee.id_employee = Visit.id_employee
        where  Visit.date_of_visit = '2019.10.04' and Visit.time_of_visit = '12:00'
        group by full_name))
        group by full_name;
        
	select * from Employee;
    

    
    select Sum(Service.price), Employee.full_name, round(Sum(Service.price) * Employee.bonus_percentage / 100,2) as Allowance FROM Customer INNER JOIN Service INNER JOIN Employee INNER JOIN Visit 
                ON Customer.id_customer = Visit.id_customer AND Service.id_service = Visit.id_service AND Employee.id_employee = Visit.id_employee WHERE  TO_DAYS(NOW()) - TO_DAYS(Visit.date_of_visit) <= 30  group by Employee.full_name;
    

select Material.name_material, sum(Consumptionmaterial.consumed_quantity), Consumptionmaterial.date_consumption
				from material inner join Consumptionmaterial on
                 Consumptionmaterial.id_material = Material.id_material group by Material.name_material;
CREATE TABLE employee(ssn varchar(255) not null, dob date, fn varchar(255),mi char(1),ln varchar(255),PRIMARY KEY(ssn),CONSTRAINT check_ssn check(ssn between 999999999 and 100000000));

create table hour_emp(ssn varchar(255),rate float,PRIMARY KEY(ssn,rate),FOREIGN key(ssn)REFERENCES employee(ssn),check(rate>=7.50));

create table sal_emp(ssn varchar(255),salary float,PRIMARY KEY(ssn,salary),FOREIGN key(ssn)REFERENCES employee(ssn));

CREATE TABLE manager (ssn varchar(255), officeNum varchar(255), startDate date,FOREIGN key(ssn)REFERENCES employee(ssn));

CREATE TABLE dependant(name varchar(255),ssn varchar(255),relationship varchar(255),FOREIGN key(ssn)REFERENCES employee(ssn));

create TABLE department(dept_num int(10), dept_name varchar(255),emp_num int(5),primary key(dept_num));

create table dept_locs(dept_num int(10),locations varchar(255),foreign key(dept_num)REFERENCES department(dept_num));

CREATE TABLE project(proj_name varchar(255),proj_num varchar(255),proj_desc text, PRIMARY KEY(proj_name,proj_num));

create table worksIn(ssn varchar(255), proj_name varchar(255),proj_num varchar(255),dept_name varchar(255),FOREIGN KEY(ssn) REFERENCES employee(ssn),FOREIGN KEY (proj_name) REFERENCES project(proj_name));

CREATE table user(id int not null primary key AUTO_INCREMENT, username varchar(255) NOT NULL UNIQUE, email varchar(255) NOT NULL UNIQUE, fn varchar(255) NOT NULL, ln varchar(255) NOT NULL, password varchar(255) NOT NULL,created_at DATETIME DEFAULT CURRENT_TIMESTAMP);

  LOAD DATA LOCAL INFILE '/var/www/newEmployees' INTO TABLE employee
    FIELDS TERMINATED BY ','
    LINES TERMINATED BY '\n';

  LOAD DATA LOCAL INFILE '/var/www/salEmp' INTO TABLE sal_emp
    FIELDS TERMINATED BY ','
    LINES TERMINATED BY '\n';

  LOAD DATA LOCAL INFILE '/var/www/hourEmp' INTO TABLE hour_emp
    FIELDS TERMINATED BY ','
    LINES TERMINATED BY '\n';

  LOAD DATA LOCAL INFILE '/var/www/managers' INTO TABLE manager
    FIELDS TERMINATED BY ','
    LINES TERMINATED BY '\n';

  LOAD DATA LOCAL INFILE '/var/www/dependants' INTO TABLE dependant
    FIELDS TERMINATED BY ','
    LINES TERMINATED BY '\n';

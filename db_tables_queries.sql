CREATE TABLE Customer (
    custId INTEGER AUTO_INCREMENT NOT NULL,
	custName VARCHAR(200) NOT NULL,
	custNo VARCHAR(15) NOT NULL,
    custpayment VARCHAR(10) NOT NULL,
    custAuto VARCHAR(20) NOT NULL,
    custPrepayment VARCHAR(20) NOT NULL,
    constraint p_cid_pk PRIMARY KEY (custId)
);

CREATE TABLE Employee (
    empId INTEGER AUTO_INCREMENT NOT NULL,
	empName VARCHAR(200) NOT NULL,
	empEmail VARCHAR(30) NOT NULL,
    empPosition VARCHAR(50) NOT NULL,
    empSalary DECIMAL(5,2) NOT NULL DEFAULT "0.00",
    empDep VARCHAR(50) NOT NULL,
    constraint p_eid_pk PRIMARY KEY (empId)
);

CREATE TABLE Booking (
    bId INTEGER AUTO_INCREMENT NOT NULL,
    bNumOfVisitors INTEGER NOT NULL,
    bDate DATE NOT NULL,
    bType VARCHAR(20),
    bNumOfDays INTEGER NOT NULL,
    bMeals VARCHAR(20),
    custId INTEGER,
    empId INTEGER,
    constraint b_bid_pk PRIMARY KEY (bId),
    constraint b_cid_fk FOREIGN KEY (custId) REFERENCES Customer(custId),
    constraint b_eid_fk FOREIGN KEY (empId) REFERENCES Employee(empId)
);

CREATE TABLE Hotel (
    hotelId INTEGER AUTO_INCREMENT NOT NULL,
    hotelRoomNum INTEGER NOT NULL,
    hotelRoomName VARCHAR(30) NOT NULL,
    hotelRoomDesc VARCHAR(300),
    hotelCampus VARCHAR(20) NOT NULL,
    hotelRoomPrice DECIMAL(8,2) NOT NULL DEFAULT "0.00",
    hotelAvailability VARCHAR(20) NOT NULL,
    bId INTEGER DEFAULT NULL,
    constraint h_hid_pk PRIMARY KEY (hotelId),
    constraint h_bid_fk FOREIGN KEY (bId) REFERENCES Booking(bId)
);

CREATE TABLE Services (
    servId INTEGER AUTO_INCREMENT NOT NULL,
    servName VARCHAR(30) NOT NULL,
    servDesc VARCHAR(300),
    servPlace VARCHAR(20) NOT NULL,
    servPrice DECIMAL(8,2) NOT NULL DEFAULT "0.00",
    servDuration VARCHAR(20) NOT NULL,
    servTypeCl VARCHAR(10) NOT NULL,
    constraint s_sid_pk PRIMARY KEY (servId)
);

CREATE TABLE ServCust (
    custId INTEGER,
    servId INTEGER,
    constraint sc_cid_fk FOREIGN KEY (custId) REFERENCES Customer(custId),
    constraint sc_sid_fk FOREIGN KEY (servId) REFERENCES Services(servId)
);

CREATE TABLE Transport (
    trId INTEGER AUTO_INCREMENT NOT NULL,
    trName VARCHAR(30) NOT NULL,
    trDate DATE,
    trPrice DECIMAL(8,2) NOT NULL DEFAULT "0.00",
    trRentDur VARCHAR(10) NOT NULL,
    trType VARCHAR(20) NOT NULL,
    constraint t_tid_pk PRIMARY KEY (trId)
);

CREATE TABLE TransCust (
    custId INTEGER,
    trId INTEGER,
    constraint tc_cid_fk FOREIGN KEY (custId) REFERENCES Customer(custId),
    constraint tc_tid_fk FOREIGN KEY (trId) REFERENCES Transport(trId)
);

CREATE TABLE Equipment (
    equipId INTEGER AUTO_INCREMENT NOT NULL,
    equipName VARCHAR(30) NOT NULL,
    equipType VARCHAR(30) NOT NULL,
    equipDescr VARCHAR(100) NOT NULL,
    equipPrice DECIMAL(8,2) NOT NULL DEFAULT "0.00",
    equipAvailability VARCHAR(10) NOT NULL,
    equipDuration VARCHAR(20) NOT NULL,
    constraint e_eid_pk PRIMARY KEY (equipId)
);

CREATE TABLE EquipCust (
    custId INTEGER,
    equipId INTEGER,
    constraint ec_cid_fk FOREIGN KEY (custId) REFERENCES Customer(custId),
    constraint ec_eid_fk FOREIGN KEY (equipId) REFERENCES Equipment(equipId)
);

CREATE TABLE Program (
    progId INTEGER AUTO_INCREMENT NOT NULL,
    progName VARCHAR(30) NOT NULL,
    progDuration VARCHAR(10) NOT NULL,
    progDescr VARCHAR(100) NOT NULL,
    progPlace VARCHAR(10) NOT NULL,
    progTime VARCHAR(10) NOT NULL,
    constraint p_pid_pk PRIMARY KEY (progId)
);
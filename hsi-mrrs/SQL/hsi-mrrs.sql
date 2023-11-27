CREATE TABLE status (
	status_ID INT NOT NULL AUTO_INCREMENT,
	status_Type VARCHAR (50),
	PRIMARY KEY (status_ID)
);

CREATE TABLE time (
	time_ID INT NOT NULL AUTO_INCREMENT,
	time_Period TIME,
	PRIMARY KEY (time_ID)
);

CREATE TABLE department (
	department_ID INT NOT NULL AUTO_INCREMENT,
	department_Name VARCHAR (100),
	PRIMARY KEY (department_ID)
);

CREATE TABLE room (
	room_ID INT NOT NULL AUTO_INCREMENT,
	room_Name VARCHAR (100),
	room_Location VARCHAR (150),
	status_ID INT,
	PRIMARY KEY (room_ID),
	FOREIGN KEY (status_ID) REFERENCES status (status_ID)
);
 
CREATE TABLE administrator (
	admin_ID VARCHAR(12) NOT NULL,
    admin_Name VARCHAR(100),
    admin_Username VARCHAR(50),
    admin_Password VARCHAR(100),
    admin_Contact VARCHAR(15),
	admin_Ext VARCHAR (5),
    PRIMARY KEY (admin_ID)
);

CREATE TABLE whatsapp (
	whatsapp_ID INT NOT NULL AUTO_INCREMENT,
	admin_ID VARCHAR (12),
	PRIMARY KEY (whatsapp_ID),
	FOREIGN KEY (admin_ID) REFERENCES administrator (admin_ID)
);

CREATE TABLE reservation (
	reserve_ID INT NOT NULL AUTO_INCREMENT,
	admin_ID VARCHAR (12),
	room_ID INT,
	reserve_Title VARCHAR (150),
	reserve_Date DATE,
	time_Start INT,
	time_End INT,
    reserve_PIC VARCHAR (150),
    reserve_Contact VARCHAR (12),
    department_ID INT,
	reserve_Notes VARCHAR (250),
	reserve_Time TIMESTAMP, 
	PRIMARY KEY (reserve_ID),
	FOREIGN KEY (admin_ID) REFERENCES administrator (admin_ID),
    FOREIGN KEY (department_ID) REFERENCES department (department_ID),
	FOREIGN KEY (room_ID) REFERENCES room (room_ID)
);

CREATE TABLE log (
	log_ID INT AUTO_INCREMENT,
	log_Time DATETIME,
	admin_ID VARCHAR (12),
	reserve_ID INT,
	log_Action VARCHAR (255),
	PRIMARY KEY (log_ID),
	FOREIGN KEY (admin_ID) REFERENCES administrator (admin_ID),
	FOREIGN KEY (reserve_ID) REFERENCES reservation (reserve_ID)
);

/

INSERT INTO `status` (`status_ID`, `status_Type`) VALUES
('', 'Available'),
('', 'Unavailable'),
('', 'By Request'),
('', 'Reserved'),
('', 'Yes'),
('', 'No');

INSERT INTO `time` (`time_ID`, `time_Period`) VALUES
('', '08:00:00'),
('', '09:00:00'),
('', '10:00:00'),
('', '11:00:00'),
('', '12:00:00'),
('', '13:00:00'),
('', '14:00:00'),
('', '15:00:00'),
('', '16:00:00'),
('', '17:00:00');

INSERT INTO `department`(`department_ID`, `department_Name`) VALUES 
('', 'EDNT - Emergency & Trauma'),
('', 'ANES - Anaesthesiology'),
('', 'DEOS - Dental & Oral Surgery'),
('', 'DENP - Dental & Oral Surgery (Paediatric)'),
('', 'DERM - Dermatology'),
('', 'IMCD - Internal Medicine'),
('', 'ONGD - Obstetric & Gynecologist'),
('', 'OPTH - Opthalmology'),
('', 'ORTO - Orthopaedic'),
('', 'ENTD - Otorhinolarygology'),
('', 'PAED - Paediatric'),
('', 'PSYD - Psychiatry'),
('', 'ONCO - Radiotherapy & Oncology'),
('', 'SURG - Surgical'),
('', 'XRAY - Diagnostic Imaging'),
('', 'DIET - Dietetic'),
('', 'FSIC - Forensic'),
('', 'ITDS - Information Technology'),
('', 'MEDR - Medical Record'),
('', 'RHAB - Medical Rehabilitation'),
('', 'MSWD - Medical Social Work'),
('', 'NURS - Nursing Unit'),
('', 'MASU - Supervision Unit'),
('', 'PATO - Pathology'),
('', 'PHAR - Pharmacy'),
('', 'TCMD - Traditional & Complementary Medicine'),
('', 'ADMN - Administration'),
('', 'COMM - Corporate Communication Unit'),
('', 'CARD - Cardiothoracic'),
('', 'HEMO - Hemodialiasis'),
('', 'CSSD - CSSD'),
('', 'VDOR - VENDOR'),
('', 'CRCU - CRC UNIT'),
('', '0000 - OTHER');

INSERT INTO `room` (`room_ID`, `room_Name`, `room_Location`, `status_ID`) VALUES
('', 'Training Room 1', 'Level 1, Information Technology Department.', '1'),
('', 'Training Room 2', 'Level 1, Information Technology Department.', '1'),
('', 'Training Room 3', 'Level 1, Information Technology Department.', '1'),
('', 'Meeting Room 1', 'Level 1, Information Technology Department.', '1'),
('', 'Meeting Room 2', 'Level 2', '1'),
('', 'Meeting Room 3', 'Level 3', '1');

INSERT INTO `administrator`(`admin_ID`, `admin_Name`, `admin_Username`, `admin_Password`, `admin_Contact`) VALUES 
('980113016970', 'Nur Huda Insyirah Binti Azman', 'hudai', '980113016970', '60197757814');
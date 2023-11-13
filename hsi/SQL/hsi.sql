CREATE TABLE department (
    dept_ID INT NOT NULL AUTO_INCREMENT,
    dept_Name VARCHAR(150),
    PRIMARY KEY (dept_ID)
);

CREATE TABLE modify (
    mod_ID INT NOT NULL AUTO_INCREMENT,
    mod_Type VARCHAR(150),
    PRIMARY KEY (mod_ID)
);

CREATE TABLE status (
    stat_ID INT NOT NULL AUTO_INCREMENT,
    stat_Type VARCHAR(150),
    PRIMARY KEY (stat_ID)
);

CREATE TABLE administrator (
    admin_ID INT NOT NULL AUTO_INCREMENT,
    admin_Name VARCHAR(100),
    admin_Username VARCHAR(50),
    admin_Password VARCHAR(100),
    admin_Contact VARCHAR(15),
    PRIMARY KEY (admin_ID)
);

CREATE TABLE staff (
    staff_ID VARCHAR(12) NOT NULL,
    staff_Time DATETIME,
    staff_By INT,
    staff_Name VARCHAR(100),
    staff_Username VARCHAR(50),
    staff_Password VARCHAR(100),
    staff_Contact VARCHAR(15),
    staff_Extension VARCHAR(5),
    staff_Position VARCHAR(100),
    staff_Grade VARCHAR(100),
    staff_Department INT,
    staff_WardClinic VARCHAR(100),
    staff_Status INT,
    staff_Details VARCHAR(250),
    staff_Modify INT,
    staff_Start DATE,  
    staff_End DATE,
    PRIMARY KEY (staff_ID),
    FOREIGN KEY (staff_By) REFERENCES administrator (admin_ID),
    FOREIGN KEY (staff_Department) REFERENCES department (dept_ID),
    FOREIGN KEY (staff_Status) REFERENCES status (stat_ID),
    FOREIGN KEY (staff_Modify) REFERENCES modify (mod_ID) 
);

CREATE TABLE encounter (
    enc_ID INT NOT NULL AUTO_INCREMENT,
    enc_Time TIMESTAMP,
    enc_By INT,
    enc_Staff VARCHAR(12),
    enc_Name VARCHAR(100),
    enc_Username VARCHAR(50),
    enc_Password VARCHAR(100),
    enc_Contact VARCHAR(15),
    enc_Extension VARCHAR(5),
    enc_Position VARCHAR(100),
    enc_Grade VARCHAR(100),
    enc_Department INT,
    enc_WardClinic VARCHAR(100),
    enc_Status INT,
    enc_Details VARCHAR(250),
    enc_Modify INT,
    enc_Start DATE,
    enc_End DATE,
    enc_Action VARCHAR(50),
    PRIMARY KEY (enc_ID),
    FOREIGN KEY (enc_By) REFERENCES administrator (admin_ID),
    FOREIGN KEY (enc_Staff) REFERENCES staff (staff_ID),
    FOREIGN KEY (enc_Department) REFERENCES department (dept_ID),
    FOREIGN KEY (enc_Status) REFERENCES status (stat_ID),
    FOREIGN KEY (enc_Modify) REFERENCES modify (mod_ID)
);

INSERT INTO `department` (`dept_ID`,`dept_Name`) VALUES
('', 'C - Accident & Emergency'),
('', 'C - Anaesthesiology'),
('', 'C - Dental & Oral Surgery'),
('', 'C - Dermatology'),
('', 'C - Internal Medicine'),
('', 'C - Obstetric & Gynecologist'),
('', 'C - Opthalmology'),
('', 'C - Orthopaedic'),
('', 'C - Otorhinolarygology'),
('', 'C - Paediatric'),
('', 'C - Psychiatry'),
('', 'C - Radiotherapy & Oncology'),
('', 'C - Surgical'),
('', 'CS - Assistant Medical Officer'),
('', 'CS - Diagnostic Imaging'),
('', 'CS - Diatetic'),
('', 'CS - Forensic'),
('', 'CS - Information Technology'),
('', 'CS - Medical Record'),
('', 'CS - Medical Rehabilitation'),
('', 'CS - Medical Social Work'),
('', 'CS - Nursing Unit'),
('', 'CS - Pathology'),
('', 'CS - Pharmacy'),
('', 'CS - Traditional & Complementary Medicine'),
('', 'NC - Administration'),
('', 'NC - Corporate Communication Unit');

INSERT INTO `modify` (`mod_ID`,`mod_Type`) VALUES
('', 'Transfer'),
('', 'Status'),
('', 'Position'),
('', 'Grade'),
('', 'Other');

INSERT INTO `status` (`stat_ID`,`stat_Type`) VALUES
('', 'Permanent'),
('', 'Visiting'),
('', 'Terminate');

INSERT INTO `administrator` (`admin_ID`,`admin_Name`,`admin_Username`,`admin_Password`,`admin_Contact`) VALUES
('', 'Administrator','1','CD2022#$!k1','60123456789');

INSERT INTO `staff` (`staff_ID`,`staff_Name`,`staff_Username`,`staff_Password`,`staff_Contact`,`staff_Extension`,`staff_Position`,`staff_Grade`,`staff_Department`,`staff_WardClinic`,`staff_Status`,`staff_Details`,`staff_Modify`,`staff_Start`,`staff_End`) VALUES
('700914015610','Zarilah Binti Tohet','zai','700914015610','60197057005','1409','Executive','Ungraded','18','','2','Training','','','','','');
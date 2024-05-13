CREATE TABLE Roles (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255),
    Description VARCHAR(255)
);

CREATE TABLE Members (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(255) NOT NULL,
    LastName VARCHAR(255) NOT NULL,
    DateOfBirth DATE NOT NULL,
    Gender ENUM('male', 'female', 'other') NOT NULL,
    Email VARCHAR(255),
    PhoneNumber VARCHAR(20),
    Address VARCHAR(255),
    EmergencyContact VARCHAR(255),
    EmergencyRelationship VARCHAR(50),
    MedicalHistory TEXT,
    DateJoined DATE NOT NULL DEFAULT (CURRENT_DATE),
    IsStillMember BOOLEAN NOT NULL DEFAULT 1,
    BillingPerYear DECIMAL(10, 2) NOT NULL
);

CREATE TABLE Inventory (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255),
    Purpose VARCHAR(255),
    OwnerDetails VARCHAR(255),
    OwnerType VARCHAR(255),
    Description TEXT,
    Quantity INT,
    ManagedLocationId INT
);

CREATE TABLE Staff (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255),
    PasswordHash VARCHAR(255),
    BirthDate DATETIME,
    Gender VARCHAR(255),
    ImmigrationStatus TEXT,
    Contact VARCHAR(255),
    PhoneNumber VARCHAR(255),
    RoleId INT
);

CREATE TABLE Availabilities (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    StartTime DATETIME,
    EndTime DATETIME,
    StaffId INT
);

CREATE TABLE ManagedLocations (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Personal BOOLEAN DEFAULT 0,
    Name VARCHAR(255),
    Address VARCHAR(255),
    Description TEXT
);

CREATE TABLE Room (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255),
    Description TEXT,
    Availability BOOLEAN,
    BookedFor INT,
    MaintenanceStatus VARCHAR(255),
    ManagedLocationId INT
);

CREATE TABLE Utilities (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255),
    Description TEXT,
    Availability VARCHAR(255),
    BookedFor INT,
    MaintenanceStatus VARCHAR(255),
    ManagedLocationId INT
);

CREATE TABLE ServiceRecords (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    RosterId INT ,
    MemberId INT,
    StaffId INT,
    ServiceType VARCHAR(255),
    StartTime DATETIME,
    EndTime DATETIME,
    ManagedLocationId INT,
    Notes TEXT
);

CREATE TABLE RoomClean (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    RosterId INT,
    RoomId INT,
    StaffId INT,
    ServiceType VARCHAR(255),
    StartTime DATETIME,
    EndTime DATETIME,
    ManagedLocationId INT,
    Notes TEXT
);

CREATE TABLE Rosters (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    StaffId INT,
    ServiceType VARCHAR(255),
    StartTime DATETIME,
    EndTime DATETIME,
    ManagedLocationId INT,
    Notes TEXT
);

CREATE TABLE BillingReports (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    StartTime DATETIME,
    EndTime DATETIME,
    TransactionType VARCHAR(255)
);

CREATE TABLE BillingItem (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    BillingReportId INT,
    MemberId INT,
    Amount DECIMAL(10, 2)
);

ALTER TABLE Staff ADD FOREIGN KEY (RoleId) REFERENCES Roles(Id);

ALTER TABLE Inventory ADD FOREIGN KEY (ManagedLocationId) REFERENCES ManagedLocations(Id);

ALTER TABLE Availabilities ADD FOREIGN KEY (StaffId) REFERENCES Staff(Id);

ALTER TABLE Room ADD FOREIGN KEY (BookedFor) REFERENCES Members(Id);
ALTER TABLE Room ADD FOREIGN KEY (ManagedLocationId) REFERENCES ManagedLocations(Id);

ALTER TABLE Utilities ADD FOREIGN KEY (BookedFor) REFERENCES Members(Id);
ALTER TABLE Utilities ADD FOREIGN KEY (ManagedLocationId) REFERENCES ManagedLocations(Id);

ALTER TABLE ServiceRecords ADD FOREIGN KEY (MemberId) REFERENCES Members(Id);
ALTER TABLE ServiceRecords ADD FOREIGN KEY (StaffId) REFERENCES Staff(Id);
ALTER TABLE ServiceRecords ADD FOREIGN KEY (ManagedLocationId) REFERENCES ManagedLocations(Id);
ALTER TABLE ServiceRecords ADD FOREIGN KEY (RosterId) REFERENCES Rosters(Id);

ALTER TABLE RoomClean ADD FOREIGN KEY (RoomId) REFERENCES Room(Id);
ALTER TABLE RoomClean ADD FOREIGN KEY (StaffId) REFERENCES Staff(Id);
ALTER TABLE RoomClean ADD FOREIGN KEY (ManagedLocationId) REFERENCES ManagedLocations(Id);
ALTER TABLE RoomClean ADD FOREIGN KEY (RosterId) REFERENCES Rosters(Id);


ALTER TABLE BillingItem ADD FOREIGN KEY (BillingReportId) REFERENCES BillingReports(Id);
ALTER TABLE BillingItem ADD FOREIGN KEY (MemberId) REFERENCES Members(Id);
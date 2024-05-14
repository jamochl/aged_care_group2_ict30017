CREATE TABLE Roles (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255),
    Description VARCHAR(255)
);

CREATE TABLE Members (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(255),
    LastName VARCHAR(255),
    DateOfBirth DATETIME,
    Contact VARCHAR(255),
    FamilyContact VARCHAR(255),
    MedicalHistory TEXT,
    BillingPerYear DECIMAL(10, 2)
);

CREATE TABLE Inventory (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255),
    ItemCategory VARCHAR(255),
    Description TEXT,
    Quantity INT,
    storageLocation VARCHAR(255),
    supplier VARCHAR(255),
    supplierNumber BIGINT
);

CREATE TABLE Staff (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255),
    PasswordHash VARCHAR(255),
    Contact VARCHAR(255),
    BirthDate DATETIME,
    Nationality VARCHAR(255),
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
    Name VARCHAR(255),
    Address VARCHAR(255),
    Description TEXT
);

CREATE TABLE Room (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255),
    Description TEXT,
    Availability VARCHAR(255),
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
    TransactionType VARCHAR(255),
    Amount DECIMAL(10, 2)
);

CREATE TABLE BillingItem (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    BillingReportId INT,
    MemberId INT,
    Amount DECIMAL(10, 2)
);

ALTER TABLE Staff ADD FOREIGN KEY (RoleId) REFERENCES Roles(Id);

-- ALTER TABLE Inventory ADD FOREIGN KEY (ManagedLocationId) REFERENCES ManagedLocations(Id);

ALTER TABLE Availabilities ADD FOREIGN KEY (StaffId) REFERENCES Staff(Id);

ALTER TABLE Room ADD FOREIGN KEY (BookedFor) REFERENCES Members(Id);
ALTER TABLE Room ADD FOREIGN KEY (ManagedLocationId) REFERENCES ManagedLocations(Id);

ALTER TABLE Utilities ADD FOREIGN KEY (BookedFor) REFERENCES Members(Id);
ALTER TABLE Utilities ADD FOREIGN KEY (ManagedLocationId) REFERENCES ManagedLocations(Id);

ALTER TABLE ServiceRecords ADD FOREIGN KEY (MemberId) REFERENCES Members(Id);
ALTER TABLE ServiceRecords ADD FOREIGN KEY (StaffId) REFERENCES Staff(Id);
ALTER TABLE ServiceRecords ADD FOREIGN KEY (ManagedLocationId) REFERENCES ManagedLocations(Id);
ALTER TABLE ServiceRecords ADD FOREIGN KEY (RosterId) REFERENCES Rosters(Id);


ALTER TABLE BillingItem ADD FOREIGN KEY (BillingReportId) REFERENCES BillingReports(Id);
ALTER TABLE BillingItem ADD FOREIGN KEY (MemberId) REFERENCES Members(Id);
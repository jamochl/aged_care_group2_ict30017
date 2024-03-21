CREATE TABLE Roles (
    Id INT PRIMARY KEY,
    Name VARCHAR(255),
    Description VARCHAR(255)
);

CREATE TABLE Authentication (
    StaffId INT PRIMARY KEY,
    Username VARCHAR(255),
    PasswordHash VARCHAR(255),
    RoleId INT,
    FOREIGN KEY (RoleId) REFERENCES Roles(Id)
);

CREATE TABLE Members (
    Id INT PRIMARY KEY,
    FirstName VARCHAR(255),
    LastName VARCHAR(255),
    Contact VARCHAR(255),
    FamilyContact VARCHAR(255),
    RoomId INT,
    MedicalHistory TEXT,
    BillingPerYear DECIMAL(10, 2),
    FOREIGN KEY (RoomId) REFERENCES Room(Id)
);

CREATE TABLE Inventory (
    Id INT PRIMARY KEY,
    Name VARCHAR(255),
    Purpose VARCHAR(255),
    OwnerDetails VARCHAR(255),
    OwnerType VARCHAR(255),
    Description TEXT,
    Quantity INT,
    ManagedLocationId INT,
    FOREIGN KEY (ManagedLocationId) REFERENCES ManagedLocations(Id)
);

CREATE TABLE Staff (
    Id INT PRIMARY KEY,
    Name VARCHAR(255),
    Password VARCHAR(255),
    Contact VARCHAR(255)
);

CREATE TABLE Availabilities (
    Id INT PRIMARY KEY,
    StartTime DATETIME,
    EndTime DATETIME,
    StaffId INT,
    FOREIGN KEY (StaffId) REFERENCES Staff(Id)
);

CREATE TABLE ManagedLocations (
    Id INT PRIMARY KEY,
    Name VARCHAR(255),
    Address VARCHAR(255),
    Description TEXT
);

CREATE TABLE Room (
    Id INT PRIMARY KEY,
    Name VARCHAR(255),
    Description TEXT,
    Availability VARCHAR(255),
    BookedFor INT,
    MaintenanceStatus VARCHAR(255),
    ManagedLocationId INT,
    FOREIGN KEY (BookedFor) REFERENCES Members(Id),
    FOREIGN KEY (ManagedLocationId) REFERENCES ManagedLocations(Id)
);

CREATE TABLE Utilities (
    Id INT PRIMARY KEY,
    Name VARCHAR(255),
    Description TEXT,
    Availability VARCHAR(255),
    BookedFor INT,
    MaintenanceStatus VARCHAR(255),
    ManagedLocationId INT,
    FOREIGN KEY (BookedFor) REFERENCES Members(Id),
    FOREIGN KEY (ManagedLocationId) REFERENCES ManagedLocations(Id)
);

CREATE TABLE ServiceRecords (
    Id INT PRIMARY KEY,
    MemberId INT,
    StaffId INT,
    ServiceType VARCHAR(255),
    StartTime DATETIME,
    EndTime DATETIME,
    ManagedLocationId INT,
    Notes TEXT,
    FOREIGN KEY (MemberId) REFERENCES Members(Id),
    FOREIGN KEY (StaffId) REFERENCES Staff(Id),
    FOREIGN KEY (ManagedLocationId) REFERENCES ManagedLocations(Id)
);

CREATE TABLE BillingReports (
    Id INT PRIMARY KEY,
    StartTime DATETIME,
    EndTime DATETIME,
    TransactionType VARCHAR(255),
    Amount DECIMAL(10, 2),
    MemberId INT,
    ServiceId INT,
    FOREIGN KEY (MemberId) REFERENCES Members(Id),
    FOREIGN KEY (ServiceId) REFERENCES ServiceRecords(Id)
);

CREATE TABLE BillingItem (
    Id INT PRIMARY KEY,
    BillingReportId INT,
    MemberId INT,
    Amount DECIMAL(10, 2),
    FOREIGN KEY (BillingReportId) REFERENCES BillingReports(Id),
    FOREIGN KEY (MemberId) REFERENCES Members(Id)
);
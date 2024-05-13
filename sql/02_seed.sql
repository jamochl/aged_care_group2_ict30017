-- Roles
INSERT INTO Roles (Id, Name, Description) VALUES
(1, 'Admin', 'Administrator role with full access'),
(2, 'Carer', 'Standard carer role'),
(3, 'Cleaner', 'Limited access role for guests'),
(4, 'Accountant', 'Limited access role for guests');

-- ManagedLocations
INSERT INTO ManagedLocations (Id, Name, Address, Description) VALUES
(1, 'Aged Care', '123 Main St, City', 'Main building for hosting multiple members'),
(2, 'Brian Durings House', '456 Elm St, Town', 'Aged care in the member Brian home itself');

-- Members
INSERT INTO Members (Id, FirstName, LastName, DateOfBirth, Gender, Email, PhoneNumber, Address, EmergencyContact, EmergencyRelationship, DateJoined, IsStillMember, MedicalHistory, BillingPerYear) VALUES
(1, 'John', 'Doe', '1980-05-15', 'male', 'john@example.com', '123-456-7890', '123 Main St, Cityville', 'Jane Doe', 'Spouse', '2023-05-15', 1, 'No significant medical history', 1000.00),
(2, 'Alice', 'Smith', '1992-09-28', 'female', 'alice@example.com', '987-654-3210', '456 Elm St, Townsville', 'Bob Smith', 'Parent', '2023-05-15', 1, 'Allergic to penicillin', 1200.00),
(3, 'Emma', 'Johnson', '1985-12-10', 'female', 'emma@example.com', '456-789-0123', '789 Oak St, Villageton', 'George Johnson', 'Sibling', '2023-05-15', 1, "None", 800.00),
(4, 'Michael', 'Brown', '1976-08-22', 'male', 'michael@example.com', '789-012-3456', '101 Pine St, Hamletville', 'Sophia Brown', 'Child', '2023-05-15', 1, 'Allergic to shellfish', 1500.00);

-- Inventory
INSERT INTO Inventory (Id, Name, Purpose, Description, Quantity, ManagedLocationId) VALUES
(1, 'Oxygen Tank', 'Respiratory support', 'Portable oxygen tank, 5L capacity', 10, 1),
(2, 'Insulin', 'Diabetes management', 'Humulin R Insulin, 10ml vial', 50, 1),
(3, 'Blood Pressure Monitor', 'Vital sign monitoring', 'Digital blood pressure monitor', 20, 1),
(4, 'Wheelchair', 'Mobility aid', 'Standard manual wheelchair', 15, 1),
(5, 'Panadol', 'Fever management', 'For patient with fevers', 0, 1);

-- Staff
INSERT INTO Staff (Name, PasswordHash, Contact, BirthDate, Nationality, PhoneNumber, RoleId) VALUES
('Admin1', 'admin1', 'admin@example.com', '1995-05-20', 'Brazillian', '0412341234', 1),
('Admin2', 'admin2', 'admin@example.com', '1985-05-20', 'Brazillian', '0458234888', 1),
('carer', 'carer', 'carer@example.com', '1996-06-05', 'Polish', '0444888999',2),
('Cleaner', 'cleaner', 'cleaner@example.com','1994-12-12', 'American', '0455222333', 3),
('Accountant', 'accountant', 'accountant@example.com', '2004-04-07', 'Vietnamese', '0469696969', 4);

-- Availabilities
INSERT INTO Availabilities (Id, StartTime, EndTime, StaffId) VALUES
(1, '2024-03-25 09:00:00', '2024-03-25 17:00:00', 2),
(2, '2024-03-25 08:00:00', '2024-03-25 16:00:00', 2),
(3, '2024-03-26 09:00:00', '2024-03-26 17:00:00', 2),
(4, '2024-03-26 08:00:00', '2024-03-26 16:00:00', 2);

-- Room
INSERT INTO Room (Id, Name, Description, Availability, BookedFor, MaintenanceStatus, ManagedLocationId) VALUES
(1, 'Patient Room 101', 'Single occupancy room with attached bathroom', 1, NULL, 'Functional', 1),
(2, 'Patient Room 102', 'Single occupancy room with shared bathroom', 1, NULL, 'Functional', 1),
(3, 'Patient Room 103', 'Double occupancy room with attached bathroom', 0, 2, 'Functional', 2),
(4, 'Patient Room 104', 'Double occupancy room with shared bathroom', 1, NULL, 'Functional', 2);

-- Utilities
INSERT INTO Utilities (Id, Name, Description, Availability, BookedFor, MaintenanceStatus, ManagedLocationId) VALUES
(1, 'Projector', 'Epson PowerLite 1781W', 'Available', NULL, 'Functional', 1),
(2, 'Laptop', 'Dell XPS 15', 'Available', NULL, 'Functional', 1),
(3, 'Printer', 'HP LaserJet Pro M402n', 'Available', NULL, 'Functional', 2),
(4, 'Scanner', 'Epson WorkForce ES-500W', 'Available', NULL, 'Functional', 2);

INSERT INTO Rosters (Id, StaffId, ServiceType, StartTime, EndTime, ManagedLocationId, Notes) VALUES
(1, 1 , 'Checkup', '2024-03-25 10:00:00', '2024-03-25 11:00:00', 1, 'roster for staff');

-- ServiceRecords
INSERT INTO ServiceRecords (Id, RosterId, MemberId, StaffId, ServiceType, StartTime, EndTime, ManagedLocationId, Notes) VALUES
(1, 1,2 ,1 , 'Checkup', '2024-03-25 10:00:00', '2024-03-25 11:00:00', 1, 'Routine checkup'),
(2,1 ,2 ,2 , 'Consultation', '2024-03-25 14:00:00', '2024-03-25 15:00:00', 1, 'Discussing treatment options'),
(3,1,3 ,2 , 'Checkup', '2024-03-26 10:00:00', '2024-03-26 11:00:00', 2, 'Routine checkup'),
(4,1 , 4, 2, 'Consultation', '2024-03-26 14:00:00', '2024-03-26 15:00:00', 2, 'Discussing treatment options');

-- BillingReports
INSERT INTO BillingReports (Id, StartTime, EndTime, TransactionType) VALUES
(1, '2024-03-01 00:00:00', '2024-03-31 23:59:59', 'Membership Fee'),
(2, '2024-03-25 10:00:00', '2024-03-25 11:00:00', 'Membership Fee'),
(3, '2024-03-25 14:00:00', '2024-03-25 15:00:00', 'Membership Fee'),
(4, '2024-03-01 00:00:00', '2024-03-31 23:59:59', 'Membership Fee'),
(5, '2024-03-26 10:00:00', '2024-03-26 11:00:00', 'Membership Fee'),
(6, '2024-03-26 14:00:00', '2024-03-26 15:00:00', 'Membership Fee');

-- BillingItem
INSERT INTO BillingItem (Id, BillingReportId, MemberId, Amount) VALUES
(1, 1, 1, 100.00),
(2, 2, 1, 50.00),
(3, 3, 2, 75.00),
(4, 4, 3, 80.00),
(5, 5, 3, 40.00),
(6, 6, 4, 60.00);
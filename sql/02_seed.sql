-- Roles
INSERT INTO Roles (Id, Name, Description) VALUES
(1, 'Admin', 'Administrator role with full access'),
(2, 'Carer', 'Standard carer role'),
(3, 'Cleaner', 'Limited access role for guests'),
(4, 'Accountant', 'Limited access role for guests');

-- ManagedLocations
INSERT INTO ManagedLocations (Id, Personal, Name, Address, Description) VALUES
(1, 0, 'Aged Care', '123 Main St, City', 'Main building for hosting multiple members'),
(2, 1, 'Brian Durings House', '456 Elm St, Town', 'Aged care in the member Brian home itself');

-- Members
INSERT INTO Members (Id, FirstName, LastName, DateOfBirth, Gender, Email, PhoneNumber, Address, EmergencyContact, EmergencyRelationship, DateJoined, IsStillMember, MedicalHistory, BillingPerYear) VALUES
(1, 'John', 'Doe', '1980-05-15', 'male', 'john@example.com', '123-456-7890', '123 Main St, Cityville', 'Jane Doe', 'Spouse', '2023-05-15', 1, 'No significant medical history', 1000.00),
(2, 'Alice', 'Smith', '1992-09-28', 'female', 'alice@example.com', '987-654-3210', '456 Elm St, Townsville', 'Bob Smith', 'Parent', '2023-05-15', 1, 'Allergic to penicillin', 1200.00),
(3, 'Emma', 'Johnson', '1985-12-10', 'female', 'emma@example.com', '456-789-0123', '789 Oak St, Villageton', 'George Johnson', 'Sibling', '2023-05-15', 1, "None", 800.00),
(4, 'Michael', 'Brown', '1976-08-22', 'male', 'michael@example.com', '789-012-3456', '101 Pine St, Hamletville', 'Sophia Brown', 'Child', '2023-05-15', 1, 'Allergic to shellfish', 1500.00);

-- Inventory
INSERT INTO Inventory (Name, ItemCategory, Description, Quantity, storageLocation, supplier, supplierNumber) VALUES
('Wheelchair', 'Mobility Equipment', 'Foldable wheelchair for mobility assistance.', 0, 'Storage A', 'Supplier X', 433500022),
('Aspirin', 'Medication', 'Pain reliever and fever reducer.', 100, 'Storage B', 'Supplier Y', 433500001),
('Acetaminophen', 'Medication', 'Pain reliever and fever reducer.', 150, 'Storage C', 'Supplier Z', 433500002),
('Ibuprofen', 'Medication', 'Nonsteroidal anti-inflammatory drug (NSAID).', 120, 'Storage D', 'Supplier X', 433500003),
('Loratadine', 'Medication', 'Antihistamine for allergies.', 0, 'Storage E', 'Supplier Y', 433500004),
('Omeprazole', 'Medication', 'Proton pump inhibitor for heartburn relief.', 90, 'Storage F', 'Supplier Z', 433500005),
('Walking Frames', 'Mobility Equipment', 'Lightweight walking frames for stability support.', 15, 'Storage G', 'Supplier X', 433500006),
('Incontinence Pads', 'Healthcare Supplies', 'Disposable incontinence pads for hygiene care.', 200, 'Storage H', 'Supplier Y', 433500007),
('Bedside Commodes', 'Mobility Equipment', 'Portable commodes for bedside use.', 8, 'Storage I', 'Supplier Z', 433500008),
('Recliner Chairs', 'Furniture', 'Comfortable recliner chairs for relaxation.', 12, 'Storage J', 'Supplier X', 433500009),
('Hearing Aids', 'Medical Devices', 'Digital hearing aids for hearing assistance.', 25, 'Storage K', 'Supplier Y', 0433500010),
('Grab Bars', 'Bathroom Safety', 'Safety grab bars for bathroom assistance.', 20, 'Storage L', 'Supplier Z', 0433500012),
('Raised Toilet Seats', 'Bathroom Safety', 'Toilet seats with raised height for accessibility.', 10, 'Storage M', 'Supplier X', 433500011),
('Pill Organizers', 'Healthcare Supplies', 'Weekly pill organizers for medication management.', 30, 'Storage N', 'Supplier Y', 433500013),
('Electric Hoists', 'Medical Equipment', 'Electric hoists for transferring patients safely.', 5, 'Storage O', 'Supplier Z', 43350000050);





-- Staff
INSERT INTO Staff (Name, PasswordHash, BirthDate, Gender, ImmigrationStatus, Contact, PhoneNumber, RoleId) VALUES
('Admin1', 'admin1', '1985-05-20', 'Male', 'Permanent Work Visa', 'admin@example.com', '0458234888', 1),
('Admin2', 'admin2', '1985-05-20', 'Male', 'Permanent Work Visa', 'admin@example.com', '0458234888', 1),
('carer', 'carer', '1996-06-05', 'Female', 'Student Visa', 'carer@example.com', '0444888999', 2),
('Cleaner', 'cleaner', '1994-12-12', 'Other', 'Permanent Resident', 'cleaner@example.com', '0455222333', 3),
('Accountant', 'accountant', '2004-04-07', 'Male',  'Permanent Resident', 'accountant@example.com', '0469696969', 4);

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

INSERT INTO Rosters (StaffId, ServiceType, StartTime, EndTime, ManagedLocationId, Notes) VALUES
(1 , 'Checkup', '2024-03-25 10:00:00', '2024-03-25 11:00:00', 1, 'roster for staff'),
(3, 'Clean Room', '2024-03-26 13:00:00', '2024-03-26 15:00:00', 1, 'roster for cleaner'),
(3, 'Clean Room', '2024-03-28 13:00:00', '2024-03-28 15:00:00', 1, 'roster for cleaner');

-- ServiceRecords
INSERT INTO ServiceRecords (Id, RosterId, MemberId, StaffId, ServiceType, StartTime, EndTime, ManagedLocationId, Notes, Progress) VALUES
(1, 1,2 ,1 , 'Checkup', '2024-03-25 10:00:00', '2024-03-25 11:00:00', 1, 'Routine checkup', "0"),
(2,1 ,2 ,2 , 'Consultation', '2024-03-25 14:00:00', '2024-03-25 15:00:00', 1, 'Discussing treatment options', "0"),
(3,1,3 ,2 , 'Checkup', '2024-03-26 10:00:00', '2024-03-26 11:00:00', 2, 'Routine checkup', "0"),
(4,1 , 4, 2, 'Consultation', '2024-03-26 14:00:00', '2024-03-26 15:00:00', 2, 'Discussing treatment options', "0");



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
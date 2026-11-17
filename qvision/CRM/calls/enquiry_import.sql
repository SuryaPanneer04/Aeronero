-- ========================================================
-- Bulk Enquiry & Feedback Insert for demobluebase_aeronero
-- Generated on: 2026-10-23 10:52:44
-- ========================================================
START TRANSACTION;


-- Record #1: Karthik Subramanian (Tata Consultancy Services)
INSERT INTO crm_calls 
(cust_type, call_type, client_type, client_org, client_name, role_id, contact, whatsapp, email, alternative_mail, website, address, Product, services, created_by, created_on, status, flag, remarks)
VALUES 
(1, 4, 2, 'Tata Consultancy Services', 'Karthik Subramanian', 'R018', '+91-9876543210', '9876543210', 'karthik.s@tcs.com', 'admin@tcs.com', 'www.tcs.com', '100 Feet Road, Velachery, Chennai 600042', '1', 12, 45, '2026-10-23', 2, 1, 'Requirement for 5 Air-Water generators');

SET @call_id = LAST_INSERT_ID();

INSERT INTO crm_calls_feedback 
(calls_id, feedback, feedback_date, date, created_by, created_on)
VALUES 
(@call_id, 'Enquiry received via call, shared product brochure', '2026-10-23', '2026-10-30', 45, '2026-10-23');


-- Record #2: Priya Raman (Apex Technologies)
INSERT INTO crm_calls 
(cust_type, call_type, client_type, client_org, client_name, role_id, contact, whatsapp, email, alternative_mail, website, address, Product, services, created_by, created_on, status, flag, remarks)
VALUES 
(1, 4, 2, 'Apex Technologies', 'Priya Raman', 'R018', '+91-9840112233', '9840112233', 'priya@apextech.in', '', 'www.apextech.in', '45, OMR IT Highway, Sholinganallur, Chennai', '2', 12, 45, '2026-10-23', 2, 1, 'Annual maintenance enquiry');

SET @call_id = LAST_INSERT_ID();

INSERT INTO crm_calls_feedback 
(calls_id, feedback, feedback_date, date, created_by, created_on)
VALUES 
(@call_id, 'Client asked for commercial proposal and AMC quotes', '2026-10-23', '2026-10-28', 45, '2026-10-23');


-- Record #3: Suresh Kumar (Individual Customer)
INSERT INTO crm_calls 
(cust_type, call_type, client_type, client_org, client_name, role_id, contact, whatsapp, email, alternative_mail, website, address, Product, services, created_by, created_on, status, flag, remarks)
VALUES 
(2, 4, 3, 'Individual Customer', 'Suresh Kumar', 'R018', '+91-9790887766', '9790887766', 'suresh.k@gmail.com', '', '', 'Flat 4B, Emerald Heights, Anna Nagar, Chennai', '1', 12, 45, '2026-10-24', 2, 1, 'Home unit enquiry for drinking water');

SET @call_id = LAST_INSERT_ID();

INSERT INTO crm_calls_feedback 
(calls_id, feedback, feedback_date, date, created_by, created_on)
VALUES 
(@call_id, 'Customer asked demo session at home', '2026-10-24', '2026-10-31', 45, '2026-10-24');


COMMIT;
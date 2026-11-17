"""
Convert Filled Enquiry Excel file into SQL for direct import in phpMyAdmin.
Usage:
    python excel_to_sql.py
    (It reads Enquiry_List_Template.xlsx and outputs enquiry_import.sql)
"""

import openpyxl
import os
import datetime

EXCEL_FILE = "Enquiry_List_Template.xlsx"
OUTPUT_SQL = "enquiry_import.sql"
USER_ID = 45 # Default CRM user ID

if not os.path.exists(EXCEL_FILE):
    print(f"Error: {EXCEL_FILE} not found in current directory.")
    exit(1)

wb = openpyxl.load_workbook(EXCEL_FILE, data_only=True)
ws = wb.active

def escape_sql(val):
    if val is None:
        return ""
    val_str = str(val).strip()
    return val_str.replace("\\", "\\\\").replace("'", "''")

def format_date(val, default_offset_days=0):
    if isinstance(val, (datetime.datetime, datetime.date)):
        return val.strftime("%Y-%m-%d")
    val_str = str(val).strip() if val else ""
    if val_str:
        try:
            d = datetime.datetime.strptime(val_str, "%Y-%m-%d")
            return d.strftime("%Y-%m-%d")
        except:
            pass
    fallback = datetime.date.today() + datetime.timedelta(days=default_offset_days)
    return fallback.strftime("%Y-%m-%d")

sql_statements = []
sql_statements.append("-- ========================================================")
sql_statements.append("-- Bulk Enquiry & Feedback Insert for demobluebase_aeronero")
sql_statements.append("-- Generated on: " + datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S"))
sql_statements.append("-- ========================================================")
sql_statements.append("START TRANSACTION;\n")

row_count = 0
for row_idx, row in enumerate(ws.iter_rows(values_only=True), start=1):
    # Skip Title and Header rows
    if row_idx < 3:
        continue
    
    client_org = escape_sql(row[1])
    client_name = escape_sql(row[2])
    contact = escape_sql(row[4])
    
    # Skip completely empty rows
    if not client_org and not client_name and not contact:
        continue
        
    cust_type_str = str(row[3]).strip().lower() if row[3] else ""
    cust_type = 2 if cust_type_str == "individual" else 1
    client_type = 3 if cust_type == 2 else 2
    
    if contact and not contact.startswith("+"):
        contact = "+91-" + contact.lstrip("0")
        
    whatsapp = escape_sql(row[5]) if row[5] else contact
    email = escape_sql(row[6])
    alt_email = escape_sql(row[7])
    address = escape_sql(row[8])
    website = escape_sql(row[9])
    
    prod_str = str(row[10]).strip().lower() if row[10] else ""
    product = "2" if "service" in prod_str else "1"
    
    remarks = escape_sql(row[11])
    feedback = escape_sql(row[12]) if row[12] else "Initial Enquiry received"
    
    feedback_date = format_date(row[13], 0)
    followup_date = format_date(row[14], 7)
    
    if not client_org:
        client_org = "Individual Customer"
    if not client_name:
        client_name = client_org

    sql = f"""
-- Record #{row_count + 1}: {client_name} ({client_org})
INSERT INTO crm_calls 
(cust_type, call_type, client_type, client_org, client_name, role_id, contact, whatsapp, email, alternative_mail, website, address, Product, services, created_by, created_on, status, flag, remarks)
VALUES 
({cust_type}, 4, {client_type}, '{client_org}', '{client_name}', 'R018', '{contact}', '{whatsapp}', '{email}', '{alt_email}', '{website}', '{address}', '{product}', 12, {USER_ID}, '{feedback_date}', 2, 1, '{remarks}');

SET @call_id = LAST_INSERT_ID();

INSERT INTO crm_calls_feedback 
(calls_id, feedback, feedback_date, date, created_by, created_on)
VALUES 
(@call_id, '{feedback}', '{feedback_date}', '{followup_date}', {USER_ID}, '{feedback_date}');
"""
    sql_statements.append(sql)
    row_count += 1

sql_statements.append("\nCOMMIT;")

with open(OUTPUT_SQL, "w", encoding="utf-8") as f:
    f.write("\n".join(sql_statements))

print(f"Successfully generated {OUTPUT_SQL} with {row_count} records!")

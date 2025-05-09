CREATE DATABASE IF NOT EXISTS business_applications;
USE business_applications;

CREATE TABLE applicant (    
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) ,
    surname VARCHAR(255) , 
    id_number VARCHAR(255) ,
    nationality VARCHAR(255) ,
    race VARCHAR(255) ,
    english_rate VARCHAR(255) ,
    education VARCHAR(255) ,
    disability VARCHAR(255) ,
    disability_desc TEXT ,
    telephone VARCHAR(255) ,
    mobile VARCHAR(255) ,
    whatsapp VARCHAR(255) ,
    email VARCHAR(255) ,
    township VARCHAR(255) ,
    other_township VARCHAR(255),
    devices VARCHAR(255) ,
    internet_access VARCHAR(255) ,
    internet_description TEXT ,
    business_name VARCHAR(255) ,
    registration_number VARCHAR(255) ,
    industry VARCHAR(255) ,
    other_industry VARCHAR(255),
    home_address TEXT ,
    business_address TEXT ,
    tax_compliant VARCHAR(10) ,
    compliance_certification VARCHAR(255),
    years_operation VARCHAR(50) ,
    monthly_revenue VARCHAR(50),
    ecommerce_platfrom VARCHAR(255) ,
    other_ecommerce VARCHAR(255),
    futur_ecommerce VARCHAR(255),
    delivery_platform VARCHAR(255),
    other_delivery VARCHAR(255),
    
    id_doc_url VARCHAR(255),
   

    industry_compliance_url VARCHAR(255),
   

    residence_address_url VARCHAR(255),
    

    tax_clearance_url VARCHAR(255),
 

    registration_doc_url VARCHAR(255),
   

    bbbee_doc_url VARCHAR(255),
   

    bank_statement_url VARCHAR(255),


    company_profile_url VARCHAR(255),
    

   
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);





CREATE DATABASE su20_Application;
USE su20_Application;

CREATE TABLE attendees (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name varchar(255) ,
  id_number varchar(255),
  nationality varchar(255),
  province varchar(255),
  city varchar(255),
  township varchar(255),
  home_address varchar(255),
  race varchar(255),
  gender varchar(255),
  telephone_number varchar(255) ,
  mobile_number varchar(255) ,
  whatsapp_number varchar(255) ,
  email varchar(255) ,
  disability varchar(255) ,
  type_disability varchar(255) ,
  highest_qualification varchar(255),
  qualifications_list_description varchar(255) ,
  english_proficiency varchar(255) ,
  computation_devices varchar(255) ,
  internet_access varchar(255) ,
  internet_description varchar(255) ,


  business_name varchar(255) ,
  business_registration_number varchar(255) ,
  business_industry varchar(255) ,
  business_sector varchar(255),
  business_address varchar(255) ,
  business_growth_stage varchar(255),
  business_industry_compliance varchar(255) ,
  business_compliance_description varchar(255) ,
  business_tax_compliance_status varchar(255) ,
  business_products_services varchar(255) ,
  business_products_services_description varchar(255) ,
  business_operation_years_range varchar(255) ,
  business_annual_revenue varchar(255) ,
  business_monthly_revenue varchar(255) ,
  business_employees_count varchar(255) ,
  business_leadership_structure_description varchar(255) ,
  business_target_market_description varchar(255) ,
  business_target_market_documentation_status varchar(255) ,
  business_competitors_description varchar(255) ,
  business_competitor_analysis_status varchar(255) ,
  business_product_uniqueness_descritpion varchar(255) ,
  business_ecommerce_description varchar(255) ,
  business_future_ecommerce_description varchar(255) ,
  business_delivery_platform_description varchar(255) ,
  business_strengths_description varchar(255) ,
  business_areas_for_improvement_description varchar(255) ,
  business_marketing_strategy_status varchar(255) ,
  business_operation_location_description varchar(255) ,
  business_efficiency_rating varchar(255) ,
  business_sop_status varchar(255) ,
  business_operations_process_description varchar(255) ,
  id_doc_url VARCHAR(255),
  registration_doc_url VARCHAR(255),
  bbbee_doc_url VARCHAR(255),
  tax_clearance_url VARCHAR(255),
  company_profile_url VARCHAR(255),




  
  
  


























































  contactnumber varchar(255) ,

  idnumber varchar(255) ,
  email varchar(255) ,
  gender varchar(255) ,
  race varchar(255) ,
  disability varchar(255) ,
  type_disability varchar(255) ,
  province varchar(255) ,
  city varchar(255) ,
  qualifications_owner varchar(255) ,
  business_name varchar(255) ,
  registration_number varchar(255) ,
  business_address varchar(255) ,
  business_stage varchar(255) ,
  sector varchar(255) ,
  industry varchar(255) ,
  business_compliance varchar(255) ,
  business_offering varchar(255) ,
  business_duration varchar(255) ,
  annual_turnover varchar(255) ,
  monthly_turnover varchar(255) ,
  employees varchar(255) ,
  leadership_structure varchar(255) ,
  tax_compliance varchar(255) ,
  target_market varchar(255) ,
  market_documentation varchar(255) ,
  competitors varchar(255) ,
  competitor_analysis varchar(255) ,
  product_uniqueness varchar(255) ,
  business_strengths varchar(255) ,
  areas_for_improvement varchar(255) ,
  marketing_strategy varchar(255) ,
  operation_location varchar(255) ,
  efficiency_rating varchar(255) ,
  sop varchar(255) ,
  operations_process varchar(255) ,
  registration_doc_url VARCHAR(255),
  id_doc_url VARCHAR(255),
  bbbee_doc_url VARCHAR(255),
  tax_clearance_url VARCHAR(255),
  company_profile_url VARCHAR(255),    
  created_at timestamp  DEFAULT current_timestamp()
)



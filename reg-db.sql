CREATE DATABASE su20_Application;
USE su20_Application;

CREATE TABLE council_applicants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    organization_affiliation VARCHAR(255) NOT NULL,
    designation_role VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    home_country VARCHAR(255) NOT NULL,
    province VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    background TEXT NOT NULL,
    qualification VARCHAR(255) NOT NULL,
    study_field VARCHAR(255) NOT NULL,
    any_other_study_field VARCHAR(255) NOT NULL,
    institution VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL,
    graduation_year VARCHAR(4) NOT NULL,
    councils_experience VARCHAR(255) NOT NULL,
    councils_experience_description TEXT NOT NULL,
    taskforce VARCHAR(255) NOT NULL,
    project_description TEXT NOT NULL,
    meeting_hours VARCHAR(255) NOT NULL,
    overall_comments TEXT NOT NULL,
    file_url1 VARCHAR(255) NOT NULL,
    filename1 VARCHAR(200) NOT NULL,
    filesize1 INT NOT NULL,
    filetype1 VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2016-04-05 16:57:30.039




-- tables
-- Table applicants
CREATE TABLE applicants (
    pid int  NOT NULL,
    name varchar(255)  NOT NULL,
    email varchar(255)  NOT NULL,
    phone_number int  NOT NULL,
    phd_of_cs bool  NOT NULL,
    student_semesters int  NOT NULL,
    passed_speak bool  NOT NULL,
    employee_semesters int  NOT NULL,
    created_at timestamp  NOT NULL,
    UNIQUE INDEX applicant_form_ak_1 (pid),
    UNIQUE INDEX applicant_form_ak_2 (email),
    CONSTRAINT pid PRIMARY KEY (pid)
);

CREATE INDEX applicant_form_idx_1 ON applicants (pid);


-- Table grad_courses
CREATE TABLE grad_courses (
    id int  NOT NULL,
    name varchar(255)  NOT NULL,
    CONSTRAINT grad_courses_pk PRIMARY KEY (id)
);

-- Table grad_courses_taken
CREATE TABLE grad_courses_taken (
    id int  NOT NULL,
    course_id int  NOT NULL,
    applicant_pid int  NOT NULL,
    grade int  NOT NULL,
    applicant_form_pid int  NOT NULL,
    grad_courses_id int  NOT NULL,
    CONSTRAINT grad_courses_taken_pk PRIMARY KEY (id)
);

CREATE INDEX grad_courses_take_idx_1 ON grad_courses_taken (course_id);


CREATE INDEX grad_courses_take_idx_2 ON grad_courses_taken (applicant_pid);






-- foreign keys
-- Reference:  grad_courses_take_applicant_forms (table: grad_courses_taken)

ALTER TABLE grad_courses_taken ADD CONSTRAINT grad_courses_take_applicant_forms FOREIGN KEY grad_courses_take_applicant_forms (applicant_form_pid)
    REFERENCES applicants (pid)
    ON DELETE CASCADE
    ON UPDATE CASCADE;
-- Reference:  grad_courses_take_grad_courses (table: grad_courses_taken)

ALTER TABLE grad_courses_taken ADD CONSTRAINT grad_courses_take_grad_courses FOREIGN KEY grad_courses_take_grad_courses (grad_courses_id)
    REFERENCES grad_courses (id);



-- End of file.


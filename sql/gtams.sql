-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2016-04-14 01:05:17.989

-- tables
-- Table: advisors
CREATE TABLE advisors (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    CONSTRAINT advisors_pk PRIMARY KEY (id)
);

-- Table: applicant_advisors
CREATE TABLE applicant_advisors (
    id int NOT NULL AUTO_INCREMENT,
    "current" bool NOT NULL DEFAULT 0,
    applicant_pid int NOT NULL,
    advisor_id int NOT NULL,
    time_period_start date NOT NULL,
    time_period_end date NOT NULL,
    CONSTRAINT applicant_advisors_pk PRIMARY KEY (id)
);

-- Table: applicants
CREATE TABLE applicants (
    pid int NOT NULL,
    email varchar(255) NOT NULL,
    first_name varchar(255) NOT NULL,
    last_name varchar(255) NOT NULL,
    phone_number int NOT NULL,
    phd_of_cs bool NOT NULL,
    passed_speak bool NOT NULL,
    student_semesters int NOT NULL,
    employee_semesters int NOT NULL,
    application_status int NOT NULL DEFAULT 0,
    gpa decimal(4,3) NOT NULL,
    created_at timestamp NOT NULL,
    link_id int NOT NULL,
    letter text NULL,
    letter_pdf blob NULL,
    semester_session_id int NOT NULL,
    advisor_rank int NOT NULL DEFAULT 0,
    advisor_verified bool NOT NULL DEFAULT 0,
    responded bool NULL,
    warning_sent bool NOT NULL DEFAULT 0,
    UNIQUE INDEX applicants_ak_1 (pid),
    UNIQUE INDEX applicants_ak_2 (email),
    UNIQUE INDEX applicants_ak_3 (link_id),
    CONSTRAINT pid PRIMARY KEY (pid)
);

CREATE INDEX applicant_form_idx_1 ON applicants (pid,email);

-- Table: gc_members
CREATE TABLE gc_members (
    id int NOT NULL AUTO_INCREMENT,
    email varchar(255) NOT NULL,
    password_digest varchar(255) NOT NULL,
    first_name varchar(255) NOT NULL,
    last_name varchar(255) NOT NULL,
    chair bool NOT NULL DEFAULT 0,
    semester_session_id int NOT NULL,
    UNIQUE INDEX gc_member_ak_1 (email),
    CONSTRAINT gc_members_pk PRIMARY KEY (id)
);

-- Table: gc_scores
CREATE TABLE gc_scores (
    id int NOT NULL AUTO_INCREMENT,
    value int NOT NULL,
    applicants_pid int NOT NULL,
    gc_members_id int NOT NULL,
    CONSTRAINT gc_scores_pk PRIMARY KEY (id)
);

-- Table: grad_courses
CREATE TABLE grad_courses (
    id int NOT NULL AUTO_INCREMENT,
    course_name varchar(255) NOT NULL,
    grade int NOT NULL,
    applicant_pid int NOT NULL,
    UNIQUE INDEX grad_courses_taken_ak_1 (course_name),
    CONSTRAINT grad_courses_pk PRIMARY KEY (id)
);

CREATE INDEX grad_courses_take_idx_1 ON grad_courses (applicant_pid);

-- Table: publications
CREATE TABLE publications (
    id int NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    citation varchar(255) NOT NULL,
    applicant_pid int NOT NULL,
    CONSTRAINT publications_pk PRIMARY KEY (id)
);

-- Table: semester_sessions
CREATE TABLE semester_sessions (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    form_deadline timestamp NOT NULL,
    letter_deadline timestamp NOT NULL,
    CONSTRAINT semester_sessions_pk PRIMARY KEY (id)
);

-- Table: system_admins
CREATE TABLE system_admins (
    id int NOT NULL AUTO_INCREMENT,
    email varchar(255) NOT NULL,
    password_digest varchar(255) NOT NULL,
    UNIQUE INDEX system_admins_ak_1 (email),
    CONSTRAINT system_admins_pk PRIMARY KEY (id)
);

-- foreign keys
-- Reference: applicant_advisors_advisors (table: applicant_advisors)
ALTER TABLE applicant_advisors ADD CONSTRAINT applicant_advisors_advisors FOREIGN KEY applicant_advisors_advisors (advisor_id)
    REFERENCES advisors (id);

-- Reference: applicant_advisors_applicants (table: applicant_advisors)
ALTER TABLE applicant_advisors ADD CONSTRAINT applicant_advisors_applicants FOREIGN KEY applicant_advisors_applicants (applicant_pid)
    REFERENCES applicants (pid);

-- Reference: applicants_sessions (table: applicants)
ALTER TABLE applicants ADD CONSTRAINT applicants_sessions FOREIGN KEY applicants_sessions (semester_session_id)
    REFERENCES semester_sessions (id);

-- Reference: gc_member_sessions (table: gc_members)
ALTER TABLE gc_members ADD CONSTRAINT gc_member_sessions FOREIGN KEY gc_member_sessions (semester_session_id)
    REFERENCES semester_sessions (id);

-- Reference: gc_score_applicants (table: gc_scores)
ALTER TABLE gc_scores ADD CONSTRAINT gc_score_applicants FOREIGN KEY gc_score_applicants (applicants_pid)
    REFERENCES applicants (pid);

-- Reference: gc_score_gc_members (table: gc_scores)
ALTER TABLE gc_scores ADD CONSTRAINT gc_score_gc_members FOREIGN KEY gc_score_gc_members (gc_members_id)
    REFERENCES gc_members (id);

-- Reference: grad_courses_take_applicant_forms (table: grad_courses)
ALTER TABLE grad_courses ADD CONSTRAINT grad_courses_take_applicant_forms FOREIGN KEY grad_courses_take_applicant_forms (applicant_pid)
    REFERENCES applicants (pid)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: publications_applicants (table: publications)
ALTER TABLE publications ADD CONSTRAINT publications_applicants FOREIGN KEY publications_applicants (applicant_pid)
    REFERENCES applicants (pid);

-- End of file.


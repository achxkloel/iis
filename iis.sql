CREATE TABLE IF NOT EXISTS Person (
    id SERIAL NOT NULL PRIMARY KEY,
    login VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) UNIQUE NOT NULL,
    birth_number VARCHAR(255) UNIQUE,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    address VARCHAR(255),
    birth_date DATE,
    phone_number VARCHAR(255),
    email VARCHAR(255),
    role VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Course (
    id SERIAL NOT NULL PRIMARY KEY,
    shortcut VARCHAR(255) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    type VARCHAR(255) NOT NULL,
    price INT,
    capacity INT NOT NULL,
    public INT DEFAULT 0,
    guarantorID INT NOT NULL,
    FOREIGN KEY (guarantorID) REFERENCES Person(id)
);

CREATE TABLE IF NOT EXISTS Class (
    id SERIAL NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    type VARCHAR(255) NOT NULL,
    capacity INT NOT NULL,
    floor INT
);

CREATE TABLE IF NOT EXISTS Term (
    id SERIAL NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    type VARCHAR(255) NOT NULL,
    score INT NOT NULL,
    date_from DATETIME NOT NULL,
    date_to DATETIME NOT NULL,
    capacity INT NOT NULL,
    open INT DEFAULT 0,
    courseID INT NOT NULL,
    classID INT,
    teacherID INT NOT NULL,
    FOREIGN KEY (courseID) REFERENCES Course(id),
    FOREIGN KEY (classID) REFERENCES Class(id),
    FOREIGN KEY (teacherID) REFERENCES Person(id)
);

CREATE TABLE IF NOT EXISTS TeacherCourse (
    teacherID INT NOT NULL,
    courseID INT NOT NULL,
    PRIMARY KEY (teacherID, courseID),
    FOREIGN KEY (teacherID) REFERENCES Person(id),
    FOREIGN KEY (courseID) REFERENCES Course(id)
);

CREATE TABLE IF NOT EXISTS StudentCourse (
    studentID INT NOT NULL,
    courseID INT NOT NULL,
    registration_date DATETIME NOT NULL,
    status VARCHAR(255) NOT NULL,
    PRIMARY KEY (studentID, courseID),
    FOREIGN KEY (studentID) REFERENCES Person(id),
    FOREIGN KEY (courseID) REFERENCES Course(id)
);

CREATE TABLE IF NOT EXISTS StudentTerm (
    studentID INT NOT NULL,
    termID INT NOT NULL,
    PRIMARY KEY (studentID, termID),
    FOREIGN KEY (studentID) REFERENCES Person(id),
    FOREIGN KEY (termID) REFERENCES Term(id)
);

CREATE TABLE IF NOT EXISTS StudentScore (
    teacherID INT NOT NULL,
    studentID INT NOT NULL,
    termID INT NOT NULL,
    score INT DEFAULT 0,
    PRIMARY KEY (teacherID, studentID, termID),
    FOREIGN KEY (teacherID) REFERENCES Person(id),
    FOREIGN KEY (studentID) REFERENCES Person(id),
    FOREIGN KEY (termID) REFERENCES Term(id)
);
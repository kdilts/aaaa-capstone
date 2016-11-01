DROP TABLE IF EXISTS comment;
DROP TABLE IF EXISTS alert;
DROP TABLE IF EXISTS student;
DROP TABLE IF EXISTS cohort;
DROP TABLE IF EXISTS attendance;


CREATE TABLE cohort (
	cohortId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	cohortStartDate DATE NOT NULL,
	PRIMARY KEY(cohortId)
);

CREATE TABLE alert (
	alertId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	alertLevel VARCHAR(16) NOT NULL,
	alertClassName VARCHAR (16) NOT NULL,
	PRIMARY KEY(alertId)
);

CREATE TABLE student (
	studentId CHAR(9) NOT NULL,
	studentCohortId INT UNSIGNED NOT NULL,
	studentLumenClassId INT UNSIGNED,
	studentName VARCHAR(128) NOT NULL,
	studentUsername VARCHAR(20) NOT NULL,
	studentSlackUsername VARCHAR(32),
	INDEX(studentId),
	INDEX(studentCohortId),
	FOREIGN KEY(studentCohortId) REFERENCES cohort(cohortId),
	PRIMARY KEY(studentId, studentCohortId)
);

CREATE TABLE comment (
	commentId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	commentAlertId INT UNSIGNED NOT NULL,
	commentCohortId INT UNSIGNED NOT NULL,
	commentCreateDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	commentStudentId CHAR(9) NOT NULL,
	commentStudentVisible TINYINT UNSIGNED NOT NULL,
	commentText VARCHAR(255) NOT NULL,
	commentUsername VARCHAR(20) NOT NULL,
	INDEX(commentAlertId),
	INDEX(commentCohortId),
	INDEX(commentStudentId),
	FOREIGN KEY(commentAlertId) REFERENCES alert(alertId),
	FOREIGN KEY(commentCohortId) REFERENCES cohort(cohortId),
	FOREIGN KEY(commentStudentId) REFERENCES student(studentId),
	PRIMARY KEY(commentId)
);

CREATE TABLE attendance (
	attendanceId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	attendanceCohortId INT UNSIGNED NOT NULL,
	attendanceStudentId CHAR(9) NOT NULL,
	attendanceDate DATE NOT NULL,
	attendanceCreateDateTime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	attendanceIpAddress VARBINARY(16),
	attendanceBrowser VARCHAR(255),
	attendanceHours DECIMAL(3, 2),
	attendanceOverrideUsername CHAR(20),
	INDEX(attendanceCohortId),
	INDEX(attendanceStudentId),
	INDEX(attendanceDate),
	UNIQUE(attendanceCohortId, attendanceStudentId, attendanceDate),
	FOREIGN KEY(attendanceCohortId) REFERENCES cohort(cohortId),
	FOREIGN KEY(attendanceStudentId) REFERENCES student(studentId),
	PRIMARY KEY(attendanceId)
);

INSERT INTO alert(alertLevel, alertClassName) VALUES("Green - Normal Status", "green");
INSERT INTO alert(alertLevel, alertClassName) VALUES("Yellow - Warning Status", "yellow");
INSERT INTO alert(alertLevel, alertClassName) VALUES("Orange - Probationary Status", "orange");
INSERT INTO alert(alertLevel, alertClassName) VALUES("Red - Failing Status", "red");

INSERT INTO cohort(cohortStartDate) VALUES("2016-01-11");
INSERT INTO cohort(cohortStartDate) VALUES("2016-04-11");
INSERT INTO cohort(cohortStartDate) VALUES("2016-07-11");
INSERT INTO cohort(cohortStartDate) VALUES("2016-10-10");
INSERT INTO cohort(cohortStartDate) VALUES("2017-01-09");
INSERT INTO cohort(cohortStartDate) VALUES("2017-04-10");
INSERT INTO cohort(cohortStartDate) VALUES("2017-07-10");
INSERT INTO cohort(cohortStartDate) VALUES("2017-10-09");
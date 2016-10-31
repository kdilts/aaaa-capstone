CREATE TABLE permit(
	permitId INT UNSIGNED NOT NULL,
	permitStatus INT NOT NULL,
	INDEX (permitId),
	PRIMARY KEY(permitId)
);

CREATE TABLE studentPermit(
	spPermitId INT NOT NULL,
	spStudentId INT NOT NULL,
	INDEX (spPermitId),
	INDEX (spStudentId),
	FOREIGN KEY(spPermitId) REFERENCES permit(permitId),
	FOREIGN KEY(spStudentId) REFERENCES student(studentId)
);

CREATE TABLE prospect(
	prospectId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	prospectFirstName VARCHAR(40) NOT NULL,
	prospectLastName VARCHAR(40) NOT NULL,
	prospectEmail VARCHAR(100) NOT NULL,
	prospectPhoneNumber VARCHAR(30) NOT NULL,
	prospectCohortId INT UNSIGNED NOT NULL,
	INDEX (prospectId),
	PRIMARY KEY(prospectId),
	FOREIGN KEY(prospectCohortId) REFERENCES cohort(cohortId)
);

CREATE TABLE student(
	studentId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	studentFirstName VARCHAR(40) NOT NULL,
	studentLastName VARCHAR(40) NOT NULL,
	studentEmail VARCHAR(100) NOT NULL,
	studentPhoneNumber VARCHAR(30) NOT NULL,
	studentCohortId INT UNSIGNED NOT NULL,
	studentDateOfBirth DATE NOT NULL,
	studentAddress VARCHAR(200) NOT NULL,
	INDEX (studentId),
	PRIMARY KEY(studentId),
	FOREIGN KEY(studentCohortId) REFERENCES cohort(cohortId)
);

CREATE TABLE application(
	applicationId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	applicationFirstName VARCHAR(40) NOT NULL,
	applicationLastName VARCHAR(40) NOT NULL,
	applicationEmail VARCHAR(100) NOT NULL,
	applicationPhoneNumber VARCHAR(30) NOT NULL,
	applicationSource TEXT NOT NULL,
	applicationCohortId TEXT NOT NULL,
	applicationAboutYou TEXT NOT NULL,
	applicationHopeToAccomplish TEXT NOT NULL,
	applicationExperience TEXT NOT NULL,
	INDEX (applicationId),
	PRIMARY KEY(applicationId)
	FOREIGN KEY(applicationCohortId) REFERENCES cohort(cohortId)
);

CREATE TABLE note();

CREATE TABLE cohort();

CREATE TABLE noteTypeEnum();

CREATE TABLE bridge();
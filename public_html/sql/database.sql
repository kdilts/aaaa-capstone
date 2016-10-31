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

CREATE TABLE student();

CREATE TABLE application();

CREATE TABLE note();

CREATE TABLE cohort();

CREATE TABLE noteTypeEnum();

CREATE TABLE bridge();
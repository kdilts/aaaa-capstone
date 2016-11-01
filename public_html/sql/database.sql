CREATE TABLE swipe(
	swipeId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	swipeNumber INT UNSIGNED NOT NULL,
	swipeStatus INT UNSIGNED NOT NULL,
	INDEX (swipeId),
	PRIMARY KEY(swipeId)
);

CREATE TABLE placard(
	placardId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	placardNumber INT UNSIGNED NOT NULL,
	placardStatus INT UNSIGNED NOT NULL,
	INDEX (placardId),
	PRIMARY KEY(placardId)
);

CREATE TABLE noteType(
	statusId INT UNSIGNED NOT NULL,
	statusName VARCHAR(40) NOT NULL,
	INDEX (statusId),
	PRIMARY KEY(statusId)
);

CREATE TABLE bridge(
	bridgeStaffId varchar(9),
	bridgeName varchar(64),
	bridgeUserName varchar(20),
	INDEX (bridgeStaffId),
	PRIMARY KEY(bridgeStaffId)
);

CREATE TABLE studentPermit(
	studentPermitStudentId INT NOT NULL,
	studentPermitSwipeId INT NOT NULL,
	studentPermitPlacardId INT NOT NULL,
	INDEX (studentPermitStudentId),
	INDEX (studentPermitPlacardId),
	INDEX (studentPermitSwipeId),
	PRIMARY KEY(studentPermitStudentId),
	FOREIGN KEY(studentPermitSwipeId) REFERENCES swipe(swipeId),
	FOREIGN KEY(studentPermitPlacardId) REFERENCES placard(placardId)
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
	applicationDateTime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	applicationUtmCampaign TEXT NOT NULL,
	applicationUtmMedium TEXT NOT NULL,
	applicationUtmSource TEXT NOT NULL,
	INDEX (applicationId),
	PRIMARY KEY(applicationId),
	FOREIGN KEY(applicationCohortId) REFERENCES cohort(cohortId)
);

CREATE TABLE note(
	noteId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	noteStudentId INT NOT NULL,
	noteStatusId INT UNSIGNED NOT NULL,
	noteContent TEXT NOT NULL,
	INDEX (noteId),
	PRIMARY KEY(noteId),
	FOREIGN KEY(noteStudentId) REFERENCES student(studentId)
);

CREATE TABLE cohort(
	cohortId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	cohortApplicationId INT UNSIGNED NOT NULL,
	INDEX (cohortId),
	PRIMARY KEY(cohortId),
	FOREIGN KEY(cohortApplicationId) REFERENCES application(applicationId)
);

CREATE TABLE cohortApplication(
	cohortApplicationCohortId INT UNSIGNED NOT NULL,
	cohortApplicationApplicationId INT UNSIGNED NOT NULL,
	FOREIGN KEY(cohortApplicationCohortId) REFERENCES cohort(cohortId),
	FOREIGN KEY(cohortApplicationApplicationId) REFERENCES application(applicationId)
);
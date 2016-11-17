DROP TABLE IF EXISTS note;
DROP TABLE IF EXISTS prospect;
DROP TABLE IF EXISTS prospectCohort;
DROP TABLE IF EXISTS studentPermit;
DROP TABLE IF EXISTS application;
DROP TABLE IF EXISTS applicationCohort;
DROP TABLE IF EXISTS swipe;
DROP TABLE IF EXISTS placard;
DROP TABLE IF EXISTS statusType;
DROP TABLE IF EXISTS noteType;
DROP TABLE IF EXISTS cohort;
DROP TABLE IF EXISTS bridge;

CREATE TABLE bridge(
	bridgeStaffId VARCHAR(9),
	bridgeName VARCHAR(64),
	bridgeUserName VARCHAR(20),
	INDEX (bridgeStaffId),
	PRIMARY KEY(bridgeStaffId)
);

CREATE TABLE cohort(
	cohortId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	cohortApplicationId INT UNSIGNED NOT NULL,
	INDEX (cohortId),
	PRIMARY KEY(cohortId)
);

CREATE TABLE noteType(
	noteTypeId INT UNSIGNED NOT NULL,
	noteTypeName VARCHAR(40) NOT NULL,
	INDEX (noteTypeName),
	PRIMARY KEY(noteTypeId)
);

CREATE TABLE statusType(
statusTypeId INT UNSIGNED AUTO_INCREMENT NOT NULL,
statusTypeName VARCHAR(40) NOT NULL,
INDEX (statusTypeId),
PRIMARY KEY (statusTypeId)
);

CREATE TABLE placard(
	placardId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	placardNumber INT UNSIGNED NOT NULL,
	placardStatusTypeId INT UNSIGNED NOT NULL,
	INDEX (placardId),
	INDEX (placardStatusTypeId),
	PRIMARY KEY(placardId),
	FOREIGN KEY(placardStatusTypeId) REFERENCES statusType(statusTypeId)

);

CREATE TABLE swipe(
	swipeId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	swipeNumber INT UNSIGNED NOT NULL,
	swipeStatusTypeId INT UNSIGNED NOT NULL,
	INDEX (swipeId),
	INDEX (swipeStatusTypeId),
	PRIMARY KEY(swipeId),
	FOREIGN KEY(swipeStatusTypeId) REFERENCES statusType(statusTypeId)
);

CREATE TABLE applicationCohort(
	applicationCohortId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	applicationCohortApplicationId INT UNSIGNED NOT NULL,
	applicationCohortCohortId INT UNSIGNED NOT NULL,
	INDEX (applicationCohortId),
	PRIMARY KEY (applicationCohortId),
	FOREIGN KEY(applicationCohortApplicationId) REFERENCES application(applicationId),
	FOREIGN KEY(applicationCohortCohortId) REFERENCES cohort(cohortId)
);

CREATE TABLE application(
applicationId INT UNSIGNED AUTO_INCREMENT NOT NULL,
applicationFirstName VARCHAR(40) NOT NULL,
applicationLastName VARCHAR(40) NOT NULL,
applicationEmail VARCHAR(100) NOT NULL,
applicationPhoneNumber VARCHAR(30) NOT NULL,
applicationSource VARCHAR(200) NOT NULL,
applicationCohortId INT UNSIGNED NOT NULL,
applicationAboutYou VARCHAR(2000) NOT NULL,
applicationHopeToAccomplish VARCHAR(2000) NOT NULL,
applicationExperience VARCHAR(2000) NOT NULL,
applicationDateTime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
applicationUtmCampaign VARCHAR(500) NOT NULL,
applicationUtmMedium VARCHAR(500) NOT NULL,
applicationUtmSource VARCHAR(500) NOT NULL,
INDEX (applicationId),
PRIMARY KEY(applicationId),
FOREIGN KEY(applicationCohortId) REFERENCES applicationCohort (applicationCohortCohortId)
);

CREATE TABLE studentPermit(

	studentPermitId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	studentPermitApplicationId INT UNSIGNED NOT NULL,
	studentPermitSwipeId INT UNSIGNED NOT NULL,
	studentPermitPlacardId INT UNSIGNED NOT NULL,
	studentPermitCheckOutDate DATE NOT NULL,
	studentPermitCheckInDate DATE NOT NULL,
	INDEX (studentPermitId),
	INDEX (studentPermitApplicationId),
	INDEX (studentPermitPlacardId),
	INDEX (studentPermitSwipeId),
	PRIMARY KEY(studentPermitId),
	FOREIGN KEY (studentPermitApplicationId) REFERENCES application(applicationId),
	FOREIGN KEY(studentPermitSwipeId) REFERENCES swipe(swipeId),
	FOREIGN KEY(studentPermitPlacardId) REFERENCES placard(placardId)
);

CREATE TABLE prospectCohort(
	prospectCohortId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	prospectCohortProspectId INT UNSIGNED NOT NULL,
	prospectCohortCohortId INT UNSIGNED NOT NULL,
	INDEX (prospectCohortId),
	PRIMARY KEY (prospectCohortId),
	FOREIGN KEY(prospectCohortProspectId) REFERENCES prospect(prospectId),
	FOREIGN KEY(prospectCohortCohortId) REFERENCES cohort(cohortId)
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
FOREIGN KEY(prospectCohortId) REFERENCES prospectCohort(prospectCohortCohortId)
);

CREATE TABLE note(
	noteId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	noteApplicationId INT UNSIGNED,
	noteProspectId INT UNSIGNED,
	noteNoteTypeId INT UNSIGNED NOT NULL,
	noteContent VARCHAR(2000) NOT NULL,
	INDEX (noteId),
	PRIMARY KEY(noteId),
	FOREIGN KEY(noteProspectId) REFERENCES prospect (prospectId)
);


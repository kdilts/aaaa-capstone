DROP TABLE IF EXISTS note;
DROP TABLE IF EXISTS prospect;
DROP TABLE IF EXISTS studentPermit;
DROP TABLE IF EXISTS application;
DROP TABLE IF EXISTS swipe;
DROP TABLE IF EXISTS statusType;
DROP TABLE IF EXISTS placard;
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

CREATE TABLE placard(
	placardId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	placardNumber INT UNSIGNED NOT NULL,
	placardStatusId INT UNSIGNED NOT NULL,
	INDEX (placardId),
	PRIMARY KEY(placardId)
);

CREATE TABLE statusType(
	statusTypeId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	statusTypeName VARCHAR(40) NOT NULL,
	INDEX (statusTypeId),
	PRIMARY KEY (statusTypeId)
);

CREATE TABLE swipe(
	swipeId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	swipeNumber INT UNSIGNED NOT NULL,
	swipeStatus INT UNSIGNED NOT NULL,
	INDEX (swipeId),
	PRIMARY KEY(swipeId)
);

CREATE TABLE application(
	applicationId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	applicationFirstName VARCHAR(40) NOT NULL,
	applicationLastName VARCHAR(40) NOT NULL,
	applicationEmail VARCHAR(100) NOT NULL,
	applicationPhoneNumber VARCHAR(30) NOT NULL,
	applicationSource TEXT NOT NULL,
	applicationCohortId INT UNSIGNED NOT NULL,
	applicationAboutYou TEXT NOT NULL,
	applicationHopeToAccomplish TEXT NOT NULL,
	applicationExperience TEXT NOT NULL,
	applicationDateTime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	applicationUtmCampaign TEXT NOT NULL,
	applicationUtmMedium TEXT NOT NULL,
	applicationUtmSource TEXT NOT NULL,
	INDEX (applicationId),
	PRIMARY KEY(applicationId),
	FOREIGN KEY(applicationCohortId) REFERENCES cohort (cohortId)
);

CREATE TABLE studentPermit(

	studentPermitId INT UNSIGNED NOT NULL,
	studentPermitSwipeId INT UNSIGNED NOT NULL,
	studentPermitPlacardId INT UNSIGNED NOT NULL,
	studentPermitCheckOutDate DATE NOT NULL,
	studentPermitCheckInDate DATE NOT NULL,
	INDEX (studentPermitId),
	INDEX (studentPermitPlacardId),
	INDEX (studentPermitSwipeId),
	PRIMARY KEY(studentPermitId),
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

CREATE TABLE note(
	noteNoteId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	noteProspectId INT UNSIGNED NOT NULL,
	noteStatusId INT UNSIGNED NOT NULL,
	noteContent TEXT NOT NULL,
	INDEX (noteNoteId),
	PRIMARY KEY(noteNoteId),
	FOREIGN KEY(noteProspectId) REFERENCES prospect (prospectId)
);


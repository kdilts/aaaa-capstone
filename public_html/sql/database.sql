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

CREATE TABLE prospect();

CREATE TABLE student();

CREATE TABLE application();

CREATE TABLE note();

CREATE TABLE cohort();

CREATE TABLE noteTypeEnum();

CREATE TABLE bridge();
INSERT INTO cohort (cohortId, cohortName) VALUES (NULL, "Fullstack January 2017");
INSERT INTO cohort (cohortId, cohortName) VALUES (NULL, "Fullstack April 2017");
INSERT INTO cohort (cohortId, cohortName) VALUES (NULL, ".Net February 2017");

INSERT INTO application (applicationID,
								 applicationFirstName,
								 applicationLastName,
								 applicationEmail,
								 applicationPhoneNumber,
								 applicationSource,
								 applicationAboutYou,
								 applicationHopeToAccomplish,
								 applicationExperience,
								 applicationDateTime,
								 applicationUtmCampaign,
								 applicationUtmMedium,
								 applicationUtmSource)
	VALUES (NULL, "Foo", "Bar", "test1@test.net", "5052345678", "sourceempty", "aboutempty","hopeempty", "expempty", CURRENT_TIMESTAMP, "empty", "empty", "empty");
INSERT INTO application (applicationID,
								 applicationFirstName,
								 applicationLastName,
								 applicationEmail,
								 applicationPhoneNumber,
								 applicationSource,
								 applicationAboutYou,
								 applicationHopeToAccomplish,
								 applicationExperience,
								 applicationDateTime,
								 applicationUtmCampaign,
								 applicationUtmMedium,
								 applicationUtmSource)
VALUES (NULL, "Foo2", "Bar2", "test2@test.net", "5052345679", "sourceempty2", "aboutempty2","hopeempty2", "expempty2", CURRENT_TIMESTAMP, "empty2", "empty2", "empty2");


INSERT INTO applicationCohort (applicationCohortId, applicationCohortApplicationId, applicationCohortCohortId)
	VALUE (NULL, 1, 1);

INSERT INTO applicationCohort (applicationCohortId, applicationCohortApplicationId, applicationCohortCohortId)
	VALUE (NULL, 2, 2);






SELECT * FROM application, cohort AS tempApp, tempCohort;












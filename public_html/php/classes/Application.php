<?php
namespace Edu\Cnm\jwood47\aaaacapstone;

require_once ("autoload.php");

/**
 * class Application for aaaa
 *
 * @version 1.0.0
 **/

class application {
	/**
	 * @var int $applicationId
	 */
	private $applicationId;
	/**
	 * @var int $applicationFirstName
	 */
	private $applicationFirstName;
	/**
	 * @var int $applicationLastName
	 */
	private $applicationLastName;
	/**
	 * @var int $applicationEmail
	 */
	private $applicationEmail;
	/**
	 * @var int $applicationPhoneNumber
	 */
	private $applicationPhoneNumber;
	/**
	 * @var string $applicationSource
	 */
	private $applicationSource;
	/**
	 * @var string $applicationCohortId
	 */
	private $applicationCohortId;
	/**
	 * @var string $applicationAboutYou
	 */
	private $applicationAboutYou;
	/**
	 * @var string $applicationHopeToAccomplish
	 */
	private $applicationHopeToAccomplish;
	/**
	 * @var string $applicationExperienc
	 */
	private $applicationExperience;
	/**
	 * @var string $applicationDateTime
	 */
	private $applicationDateTime;
	/**
	 * @var string $applicationUtmCampaign
	 */
	private $applicationUtmCampaign;
	/**
	 * @var string $applicationUtmMedium
	 */
	private $applicationUtmMedium;
	/**
	 * @var string $applicationUtmSource
	 */
	private $applicationUtmSource;

	/**
	 * @return int| null value of applicationId
	 */
	public function getApplicationId() {
		return $this->applicationId;
	}



}

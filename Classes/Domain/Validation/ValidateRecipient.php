<?php
declare(strict_types = 1);
namespace Mocean\MoceanApiBroadcast\Domain\Validation;

use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ValidateRecipient extends AbstractValidator
{
	protected function isValid($value)
	{
		if ($value == 0) 
		{
			$this->addError('Select a recipient', 1591175982);
			return;
		}
	}
}
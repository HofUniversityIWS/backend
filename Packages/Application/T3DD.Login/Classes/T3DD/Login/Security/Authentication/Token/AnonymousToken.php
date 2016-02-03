<?php
namespace T3DD\Login\Security\Authentication\Token;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Security\Account;
use TYPO3\Flow\Security\Authentication\Token\Typo3OrgSsoToken;
use TYPO3\Flow\Security\Authentication\TokenInterface;
use TYPO3\Flow\Security\Exception\UnsupportedAuthenticationTokenException;
use TYPO3\Party\Domain\Model\ElectronicAddress;
use TYPO3\Party\Domain\Model\Person;
use TYPO3\Party\Domain\Model\PersonName;

/**
 * Enter descriptions here
 */
class AnonymousToken extends \TYPO3\Flow\Security\Authentication\Token\AbstractToken {

	/**
	 * @param \TYPO3\Flow\Mvc\ActionRequest $actionRequest The current action request instance
	 * @return void
	 */
	public function updateCredentials(\TYPO3\Flow\Mvc\ActionRequest $actionRequest) {
		if ($actionRequest->getControllerActionName() === 'login') {
			$this->setAuthenticationStatus(self::AUTHENTICATION_NEEDED);
		}
	}

	/**
	 * @param string $username
	 */
	public function setUsername($username) {
		$this->credentials['username'] = $username;
	}

	/**
	 * Returns a string representation of the token for logging purposes.
	 *
	 * @return string The username credential
	 */
	public function  __toString() {
		return 'Username: "' . $this->credentials['username'] . '"';
	}

}
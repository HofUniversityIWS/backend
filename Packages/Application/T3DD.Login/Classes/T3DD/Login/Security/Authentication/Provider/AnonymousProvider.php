<?php
namespace T3DD\Login\Security\Authentication\Provider;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Security\Account;
use TYPO3\Flow\Security\Authentication\TokenInterface;
use TYPO3\Flow\Security\Exception\UnsupportedAuthenticationTokenException;
use TYPO3\Party\Domain\Model\ElectronicAddress;
use TYPO3\Party\Domain\Model\Person;
use TYPO3\Party\Domain\Model\PersonName;
use T3DD\Login\Security\Authentication\Token\AnonymousToken;

/**
 * Enter descriptions here
 */
class AnonymousProvider extends Typo3OrgSsoProvider {

	/**
	 * @var array
	 */
	protected $userData = array(
		'username' => 'typo3cms',
		'name' => 'TYPO3 CMS',
		'email' => 'no-reply@typo3.org',
		// 'tx_t3ouserimage_img_hash' => 'd3b8d9cee0eb37ffa145e673c033f21',
	);

	/**
	 * Returns the class names of the tokens this provider can authenticate.
	 *
	 * @return array
	 */
	public function getTokenClassNames() {
		return array('T3DD\Login\Security\Authentication\Token\AnonymousToken');
	}

	/**
	 * @param TokenInterface|AnonymousToken $authenticationToken
	 * @throws \TYPO3\Flow\Security\Exception\UnsupportedAuthenticationTokenException
	 */
	public function authenticate(TokenInterface $authenticationToken) {
		if (!($authenticationToken instanceof AnonymousToken)) {
			throw new UnsupportedAuthenticationTokenException('This provider cannot authenticate the given token.', 1217339840);
		}

		/** @var $account Account */
		$account = null;

		$username = $this->getUsername();
		$providerName = $this->name;
		$this->securityContext->withoutAuthorizationChecks(
			function () use ($username, $providerName, &$account) {
				$account = $this->accountRepository->findActiveByAccountIdentifierAndAuthenticationProviderName(
					$username,
					$providerName
				);
			}
		);

		if (!is_object($account)) {
			$account = $this->createAccount($this->userData);
		} elseif (is_object($account)) {
			$account = $this->updateAccount($account, $this->userData);
		}

		$authenticationToken->setUsername($username);
		$authenticationToken->setAccount($account);
		$authenticationToken->setAuthenticationStatus(TokenInterface::AUTHENTICATION_SUCCESSFUL);
	}

	/**
	 * @return string
	 */
	protected function getUsername() {
		return $this->userData['username'];
	}

}
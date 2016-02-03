<?php
namespace T3DD\Login\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow framework.                       *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * An action controller for generic authentication in Flow
 *
 * @Flow\Scope("singleton")
 */
class AnonymousAuthenticationController extends AuthenticationController {

	/**
	 * @var \TYPO3\Flow\Security\Policy\PolicyService
	 * @Flow\Inject
	 */
	protected $policyService;

	/**
	 */
	public function loginAction() {
		$this->forward('authenticate');
	}

	/**
	 *
	 */
	public function logoutAction() {
		$this->authenticationManager->logout();
		if ($this->request->getFormat() === 'json') {
			$this->response->setHeader('Content-Type', 'application/json', TRUE);
			$this->response->setContent('null');
			throw new \TYPO3\Flow\Mvc\Exception\StopActionException();
		} elseif($this->request->getFormat() === 'html') {
			$this->redirectToUri('/');
		}
	}

	/**
	 *
	 */
	public function statusAction() {
		$account = $this->securityContext->getAccount();
		if (is_object($account)) {
			$this->response->setHeader('Content-Type', 'application/json', TRUE);
			$this->response->setContent(json_encode($this->buildAccountDTO($this->securityContext->getAccount(), $this->response->getCookie('TYPO3_Flow_Session'))));
		} else {
			$this->response->setStatus(401, 'Not logged in.');
			$this->response->setContent('null');
		}
		throw new \TYPO3\Flow\Mvc\Exception\StopActionException();
	}

}

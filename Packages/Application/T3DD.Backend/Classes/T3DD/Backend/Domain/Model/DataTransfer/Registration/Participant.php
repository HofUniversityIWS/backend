<?php
namespace T3DD\Backend\Domain\Model\DataTransfer\Registration;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "T3DD.Backend".          *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

class Participant extends \Netlogix\Crud\Domain\Model\DataTransfer\AbstractDataTransferObject {

	/**
	 * @var \T3DD\Backend\Domain\Model\Registration\Participant
	 */
	protected $payload;

	/**
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 * @Flow\Inject
	 */
	protected $persistenceManager;

	/**
	 * @param \T3DD\Backend\Domain\Model\Registration\Participant $payload
	 */
	public function __construct(\T3DD\Backend\Domain\Model\Registration\Participant $payload) {
		parent::__construct($payload);
	}

	/**
	 * @return array<string>
	 */
	public function getPropertyNamesToBeApiExposed() {
		return array('__identity', 'isRegistrant', 'rate', 'roomSize', 'companyName', 'name', 'email', 'foodType', 'foodWishes', 'tshirtType', 'tshirtSize', 'newcomer', 'yearExpertise', 'ticketBookingState', 'roomBookingState');
	}

	/**
	 * @return \T3DD\Backend\Domain\Model\Registration\Participant
	 */
	public function getPayload() {
		return $this->payload;
	}

	/**
	 * @return string
	 */
	public function getTicketBookingState() {
		if ($this->payload->getTicket()) {
			return $this->payload->getTicket()->getBookingState();
		}
	}

	/**
	 * @return string
	 */
	public function getRoomBookingState() {
		if ($this->payload->getRoom()) {
			return $this->payload->getRoom()->getBookingState();
		}
	}

}
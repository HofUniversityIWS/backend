<?php
namespace T3DD\Backend\Domain\Model\Registration;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "T3DD.Backend".          *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * @Flow\Entity
 */
class Registration {

	/**
	 * @var \DateTime
	 */
	protected $date;

	/**
	 * @var \TYPO3\Flow\Security\Account
	 * @ORM\ManyToOne
	 */
	protected $account = NULL;

	/**
	 * @var integer
	 */
	protected $participantCount;

	/**
	 * @var BillingAddress
	 * @ORM\OneToOne(cascade={"all"})
	 */
	protected $billingAddress;

	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection<Participant>
	 * @ORM\OneToMany(mappedBy="registration", cascade={"all"})
	 * @ORM\OrderBy({"positionInRegistration" = "ASC"})
	 */
	protected $participants;

	/**
	 * @var string
	 * @ORM\Column(type="text")
	 */
	protected $notes = '';

	/**
	 * @var bool
	 */
	protected $completed = false;

	public function __construct() {
		$this->date = new \DateTime();
		$this->participants = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * @return \DateTime
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * @return \TYPO3\Flow\Security\Account
	 */
	public function getAccount() {
		return $this->account;
	}

	/**
	 * @param \TYPO3\Flow\Security\Account $account
	 */
	public function setAccount($account) {
		$this->account = $account;
	}

	/**
	 * @return int
	 */
	public function getParticipantCount() {
		return $this->participantCount;
	}

	/**
	 * @param int $participantCount
	 */
	public function setParticipantCount($participantCount) {
		$this->participantCount = $participantCount;
	}

	/**
	 * @return BillingAddress
	 */
	public function getBillingAddress() {
		return $this->billingAddress;
	}

	/**
	 * @param BillingAddress $billingAddress
	 */
	public function setBillingAddress(BillingAddress $billingAddress) {
		$this->billingAddress = $billingAddress;
	}

	/**
	 * @return Collection
	 */
	public function getParticipants() {
		return $this->participants;
	}

	/**
	 * @param Collection $participants
	 */
	public function setParticipants($participants) {
		$this->participants = $participants;
	}

	/**
	 * @param Participant $participant
	 */
	public function addParticipant(\T3DD\Backend\Domain\Model\Registration\Participant $participant) {
		$this->participants->add($participant);
	}

	/**
	 * @param Participant $participant
	 */
	public function removeParticipant(\T3DD\Backend\Domain\Model\Registration\Participant $participant) {
		$this->participants->remove($participant);
	}

	/**
	 * @return mixed
	 */
	public function getNotes() {
		return $this->notes;
	}

	/**
	 * @param mixed $notes
	 */
	public function setNotes($notes) {
		$this->notes = $notes;
	}

	/**
	 * @return boolean
	 */
	public function isCompleted() {
		return $this->completed;
	}

	/**
	 * @param boolean $completed
	 */
	public function setCompleted($completed) {
		$this->completed = $completed;
	}

	/**
	 * @return mixed|null
	 */
	public function getSecondsToExpiration() {
		if ($this->isCompleted()) {
			return null;
		}
		$now = new \DateTime();
		$expirationDate = clone $this->getDate();
		$expirationDate->add(new \DateInterval('PT30M'));
		return max($expirationDate->getTimestamp() - $now->getTimestamp(), 0);
	}

}
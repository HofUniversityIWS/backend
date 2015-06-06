<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20150605102831 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
		// this up() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("CREATE TABLE t3dd_backend_domain_model_participant (persistence_object_identifier VARCHAR(40) NOT NULL, account VARCHAR(40) DEFAULT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, companyname VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, rate ENUM('nonassoc', 'assoc', 'student', 'speaker', 'core', 'helper', 'sponsornonassoc', 'sponsorassoc', 'voucher'), roomsize ENUM('0', '2', '3', '4'), roommates VARCHAR(255) NOT NULL, foodtype ENUM('default', 'vegetarian', 'vegan', 'other'), foodwishes LONGTEXT NOT NULL, tshirtsize ENUM('xs', 's', 'm', 'l', 'xl', 'xxl', '3xl', '4xl'), tshirttype ENUM('default', 'girlie'), newcomer TINYINT(1) NOT NULL, yearexpertise INT NOT NULL, completed TINYINT(1) NOT NULL, lastemailsent DATETIME NOT NULL, INDEX IDX_F65620387D3656A4 (account), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_participant ADD CONSTRAINT FK_F65620387D3656A4 FOREIGN KEY (account) REFERENCES typo3_flow_security_account (persistence_object_identifier)");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
		// this down() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("DROP TABLE t3dd_backend_domain_model_participant");
	}
}
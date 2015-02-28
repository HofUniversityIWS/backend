<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20150228141024 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
		// this up() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("CREATE TABLE t3dd_backend_domain_model_value (persistence_object_identifier VARCHAR(40) NOT NULL, title VARCHAR(80) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX flow_identity_t3dd_backend_domain_model_value (title), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_session ADD account VARCHAR(40) DEFAULT NULL, ADD theme VARCHAR(40) DEFAULT NULL, ADD type VARCHAR(40) DEFAULT NULL, ADD expertiselevel VARCHAR(40) DEFAULT NULL");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_session ADD CONSTRAINT FK_20A5F4E77D3656A4 FOREIGN KEY (account) REFERENCES typo3_flow_security_account (persistence_object_identifier)");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_session ADD CONSTRAINT FK_20A5F4E79775E708 FOREIGN KEY (theme) REFERENCES t3dd_backend_domain_model_value (persistence_object_identifier)");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_session ADD CONSTRAINT FK_20A5F4E78CDE5729 FOREIGN KEY (type) REFERENCES t3dd_backend_domain_model_value (persistence_object_identifier)");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_session ADD CONSTRAINT FK_20A5F4E775DD9F59 FOREIGN KEY (expertiselevel) REFERENCES t3dd_backend_domain_model_value (persistence_object_identifier)");
		$this->addSql("CREATE INDEX IDX_20A5F4E77D3656A4 ON t3dd_backend_domain_model_session (account)");
		$this->addSql("CREATE INDEX IDX_20A5F4E79775E708 ON t3dd_backend_domain_model_session (theme)");
		$this->addSql("CREATE INDEX IDX_20A5F4E78CDE5729 ON t3dd_backend_domain_model_session (type)");
		$this->addSql("CREATE INDEX IDX_20A5F4E775DD9F59 ON t3dd_backend_domain_model_session (expertiselevel)");

		$values = array(
			'theme' => array(
				'566e1778-6984-e8b1-6938-921a6b62b12b' => 'TYPO3 Neos',
				'3f5de1db-c201-fbae-039e-1344cbd2e630' => 'TYPO3 Flow',
				'2bfe4987-480b-bc9f-5865-dc6ca8708cab' => 'TYPO3 CMS',
				'e2e73b69-0701-cabb-74f9-d759c1aedb5d' => 'Server',
				'cb7fc56a-0899-1870-687b-67d9937674d4' => 'Frontend'),
			'type' => array(
				'868351dc-cdad-850c-b4c3-eff2ffe6976f' => 'Presentation',
				'd3569875-7b2f-d1c2-c488-d460bec0eef0' => 'Discussion',
				'3bcb1be6-834f-82c4-34bf-96a1a54d62b5' => 'Initiative'
			),
			'expertiseLevel' => array(
				'e784a615-1f1d-70c2-dd66-9a578a8940da' => 'Low',
				'ad5817c7-7923-b6e9-9c73-06a2f7b5e391' => 'Middle',
				'742ecb91-1f3a-1258-65bc-a183a1496139' => 'High',
				'd9a3d833-d53e-f968-6ba4-4706ca1ef355' => 'Expert'
			),
		);

		foreach ($values as $category => $selections) {
			foreach ($selections as $persistenceObjectIdentifier => $selection) {
				$query = "INSERT INTO t3dd_backend_domain_model_value (persistence_object_identifier, title, type) VALUES ('" . $persistenceObjectIdentifier . "','" . $selection . "','" . $category . "');";
				$this->addSql($query);
			}
		}
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
		// this down() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_session DROP FOREIGN KEY FK_20A5F4E79775E708");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_session DROP FOREIGN KEY FK_20A5F4E78CDE5729");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_session DROP FOREIGN KEY FK_20A5F4E775DD9F59");
		$this->addSql("DROP TABLE t3dd_backend_domain_model_value");
		$this->addSql("DROP INDEX IDX_20A5F4E77D3656A4 ON t3dd_backend_domain_model_session");
		$this->addSql("DROP INDEX IDX_20A5F4E79775E708 ON t3dd_backend_domain_model_session");
		$this->addSql("DROP INDEX IDX_20A5F4E78CDE5729 ON t3dd_backend_domain_model_session");
		$this->addSql("DROP INDEX IDX_20A5F4E775DD9F59 ON t3dd_backend_domain_model_session");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_session DROP account, DROP theme, DROP type, DROP expertiselevel");
	}
}
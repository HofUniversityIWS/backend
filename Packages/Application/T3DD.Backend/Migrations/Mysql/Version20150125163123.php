<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20150125163123 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
		// this up() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("CREATE TABLE t3dd_backend_domain_model_datatransfer_session (persistence_object_identifier VARCHAR(40) NOT NULL, innermostself VARCHAR(40) DEFAULT NULL, UNIQUE INDEX UNIQ_A84B4FEC41B3E602 (innermostself), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
		$this->addSql("CREATE TABLE t3dd_backend_domain_model_datatransfer_speaker (persistence_object_identifier VARCHAR(40) NOT NULL, innermostself VARCHAR(40) DEFAULT NULL, UNIQUE INDEX UNIQ_38A415941B3E602 (innermostself), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
		$this->addSql("CREATE TABLE t3dd_backend_domain_model_session (persistence_object_identifier VARCHAR(40) NOT NULL, date DATETIME NOT NULL, title VARCHAR(120) NOT NULL, description LONGTEXT NOT NULL, UNIQUE INDEX flow_identity_t3dd_backend_domain_model_session (title), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
		$this->addSql("CREATE TABLE t3dd_backend_domain_model_session_speakers_join (backend_session VARCHAR(40) NOT NULL, backend_participant VARCHAR(40) NOT NULL, INDEX IDX_496127EDE84CD28D (backend_session), INDEX IDX_496127ED840E0F2A (backend_participant), PRIMARY KEY(backend_session, backend_participant)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_datatransfer_session ADD CONSTRAINT FK_A84B4FEC41B3E602 FOREIGN KEY (innermostself) REFERENCES t3dd_backend_domain_model_session (persistence_object_identifier)");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_datatransfer_session ADD CONSTRAINT FK_A84B4FEC47A46B0A FOREIGN KEY (persistence_object_identifier) REFERENCES netlogix_crud_domain_model_datatransfer_abstractdatatrans_3c9fe (persistence_object_identifier) ON DELETE CASCADE");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_datatransfer_speaker ADD CONSTRAINT FK_38A415941B3E602 FOREIGN KEY (innermostself) REFERENCES t3dd_backend_domain_model_participant (persistence_object_identifier)");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_datatransfer_speaker ADD CONSTRAINT FK_38A415947A46B0A FOREIGN KEY (persistence_object_identifier) REFERENCES netlogix_crud_domain_model_datatransfer_abstractdatatrans_3c9fe (persistence_object_identifier) ON DELETE CASCADE");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_session_speakers_join ADD CONSTRAINT FK_496127EDE84CD28D FOREIGN KEY (backend_session) REFERENCES t3dd_backend_domain_model_session (persistence_object_identifier)");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_session_speakers_join ADD CONSTRAINT FK_496127ED840E0F2A FOREIGN KEY (backend_participant) REFERENCES t3dd_backend_domain_model_participant (persistence_object_identifier)");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_datatransfer_participant ADD resource VARCHAR(255) NOT NULL");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
		// this down() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_datatransfer_session DROP FOREIGN KEY FK_A84B4FEC41B3E602");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_session_speakers_join DROP FOREIGN KEY FK_496127EDE84CD28D");
		$this->addSql("DROP TABLE t3dd_backend_domain_model_datatransfer_session");
		$this->addSql("DROP TABLE t3dd_backend_domain_model_datatransfer_speaker");
		$this->addSql("DROP TABLE t3dd_backend_domain_model_session");
		$this->addSql("DROP TABLE t3dd_backend_domain_model_session_speakers_join");
		$this->addSql("ALTER TABLE t3dd_backend_domain_model_datatransfer_participant DROP resource");
	}
}
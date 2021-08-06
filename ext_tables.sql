CREATE TABLE tx_moceanapibroadcast_domain_model_history (
	uid int(11) unsigned DEFAULT 0 NOT NULL auto_increment,

	sender varchar (255) DEFAULT '' NOT NULL,
	datetime int(10) NOT NULL,
	message varchar(255) DEFAULT '' NOT NULL,
	recipient varchar(15) DEFAULT '' NOT NULL,
	response varchar(255) DEFAULT '' NOT NULL,
	status varchar(10) DEFAULT '' NOT NULL,
	sms_log varchar(400) DEFAULT '' NOT NULL,

	PRIMARY KEY (uid),
);

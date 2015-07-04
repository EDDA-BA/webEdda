create database RFIDAUTH;
use RFIDAUTH;

CREATE TABLE user (
# php unigid 23 byte + 7 byte prefix
   userId CHAR(30) NOT NULL,
   name CHAR(50) NOT NULL, # todo : find better name (externUserId)
   PRIMARY KEY (userId)
                  ) 
ENGINE=MyISAM;

##########
#INSERT INTO user (name) VALUES ("tester1");
##########

CREATE TABLE uid (
   uidId INT NOT NULL AUTO_INCREMENT,
   uid CHAR(20) NOT NULL,
   userId CHAR(30),
   PRIMARY KEY (uidId) 
                  )
ENGINE=MyISAM;

##########

CREATE TABLE publickey (
   keyId INT NOT NULL AUTO_INCREMENT,
# RSA key-pair size in PEM format (8192 Bit -> 6363 bytes PEM)
   publicKey TEXT(6363) NOT NULL, 
   userId CHAR(30),
   PRIMARY KEY (keyId) 
                  )
ENGINE=MyISAM;

##########

CREATE TABLE currentAuth (
   authId INT NOT NULL AUTO_INCREMENT,
   challenge TEXT(1024) NOT NULL,
   userId CHAR(30),
   time  CHAR(15),
   PRIMARY KEY (authId) 
                  )
ENGINE=MyISAM;



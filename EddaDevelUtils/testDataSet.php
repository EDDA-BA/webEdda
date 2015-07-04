<?php
include 'odbc.php';

// insert one testuser (tester1) in table user
$userId = uniqid(true,"FHS");
$name = "tester1";
$command = 'INSERT INTO user (userID , name) VALUES ("' . $userId . '" , "' . $name  . '" );';
odbcSqlQuery($command,1);

// insert one test UID in table UID
$uid="04703d323b2480";
$command = 'INSERT INTO uid (uid , userId) VALUES ("' . $uid . '","' . $userId . '");';
odbcSqlQuery($command,1);

// insert one test pblickey in table publickey
$pubkey = <<<EOF
-----BEGIN RSA PUBLIC KEY-----
MIICCAKCAgEAsryP0O+R7n4WlyviS3JXX2UY69tIy9UHSriODbusXr37FBXJLmRW
BhDPYZCGk3cPyhBiujOFBjvWM6K7zQpjPA8jabbnGO2N79HyVFxzS2GWh/hCn/Hm
ak5GYDFqp8xRwIZQB+NmQrw1K1rcQkeD0R/pkWYeq9u5gpafkNuonbUkk19DTcgQ
iz0XHHICAvPPROMQjU8qLjZzxkDMSsCo5QWnMDzCTP/Hkw4vPNh0jjT3PR7a9YgA
Mlg0LXV92KtVNuZZoa2oDjLxFc3UB5lsxI0DCIS1/hlBoBtNrR7Rm3ElHTh8XBPq
3Q89FheNW9VzvjB7akSUEPNPXqoJWdbeeYUNPZjbsiImuDyL+0yBMC+89OJmy5SN
FQBslvM3hExp4X1Te6cnjWjd6QBP8hSEOcNP1BAj37XwNVtaGceFIapVTwAvPfvR
pT0wuS3Ux1nGHBFbvCvU3kFKBEIszHcUbAb7lpZa5A8er4BWVZPLzYHTHHGhjjr6
8yhWwVBmrcg/iip3q9JpfA4JPUOrgKZmQmWTzlBouiZ2mMDNxRhGq3tcCIyRfFoZ
aCUw1hXVdCY1s3LbT/X/KkEuCObLU+o/8UfuMLG1xV1W0oluJ+tVHhcdfbZq3Abx
jHLiPQky/KNiefMIncoCSSjKzpHeGoQh7ZAwSKKJwUUzzK5iaNprWRECAQM=
-----END RSA PUBLIC KEY-----
EOF;

$command = 'INSERT INTO publickey (publicKey , userId) VALUES ("' . $pubkey . '","' . $userId . '");';
odbcSqlQuery($command,1);

?>

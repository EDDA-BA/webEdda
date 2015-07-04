<?php
  /*
  This file is part of edda.

  edda is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  edda is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with edda.  If not, see <http://www.gnu.org/licenses/>.
  */

  include 'odbc.php';

  function getPublickey ($uid) 
    {
    $sqlCommand = 'select publicKey from publickey where userId=(select userId from uid where uid="' . $uid .'");';
    return (substr(odbcSqlQuery($sqlCommand,1) , 1 , -1));
    }
  
  function setCurrentAuth ( $rnd , $uid , $time) 
    {
    $sqlCommand = 'INSERT INTO currentAuth (challenge , userId , time) VALUES ("' . base64_encode(sha1($rnd,true)) . '" , (SELECT userId from uid WHERE uid="' . $uid  . '") , "'. $time  .'" );';
    return (substr(odbcSqlQuery($sqlCommand,1) , 1 , -1));
    }
  
  function getShouldSolvedChallenge ($uid) 
    {
    $sqlCommand = 'select challenge from currentAuth where userId=(select userId from uid where uid="' . $uid  . '");';
    return( base64_decode(substr(odbcSqlQuery($sqlCommand,1) , 1 )));
    }
  
  function getExternalUserId ($uid) 
    {
    $sqlCommand = 'select name from user where userId=(select userId from uid where uid="' . $uid  . '");';
    return (substr(odbcSqlQuery($sqlCommand,1) , 1));
    }
  
  function getAuthRequestTime ($uid) 
    {
    $sqlCommand = 'select time from currentAuth where userId=(select userId from uid where uid="' . $uid  . '");';
    return (substr(odbcSqlQuery($sqlCommand,1) , 1));
    }
  
  function clearCurrentAuth ($uid) 
    {
    $sqlCommand = 'delete from currentAuth where userId=(select userId from uid where uid="' . $uid  . '");';
    odbcSqlQuery($sqlCommand,1);
    }
?>

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


  include 'dbFunctions.php';
  include 'config.php';
  include '../EddaChallengeTestOk.php';
  include '../EddaChallengeTestFails.php';

  session_start();
  $uid = substr($_POST["uid"],0,-2);
  $solvedChallenge = base64_decode(substr($_POST["solvedChallenge"],0 , -2 )) ;

  $shouldSolvedChallenge = getShouldSolvedChallenge($uid);
  if($shouldSolvedChallenge == NULL)
    {clearCurrentAuth($uid); die("NO CURRENTAUTH ENTRY FOR IS UID");}

  $externalUserId = getExternalUserId($uid);  
  if($externalUserId == NULL)
    {clearCurrentAuth($uid); die("NO EXTERNALUSERID FOR THIS UID");}

  $authRequestTime = getAuthRequestTime($uid);
  if($externalUserId == NULL)
    {clearCurrentAuth($uid); die("NO AUTH REQUEST TIME FOR THIS UID");}

  echo '<br><br>' . 'uid = ' . $uid . '<br><br>';
  echo 'externalUserId: ' . $externalUserId  . '<br><br>';
  echo 'authRequestTime: ' . $authRequestTime . '<br><br>';

  if ($solvedChallenge == $shouldSolvedChallenge && $maxAuthTime >= (time() - $authRequestTime) )
    {
    echo "challenge test OK";
    challengeTestOk($externalUserId , session_id(), $authRequestTime);
    }
  else
    {
    echo "challenge test FAIL";
    challengeTestFails($externalUserId  , session_id(), $authRequestTime);
    }

  clearCurrentAuth($uid);

?>

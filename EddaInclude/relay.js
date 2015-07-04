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

var daemonPort = "12345";
var daemonAdress = "http://localhost";

function startAuth()
{  
  var httpUid = new XMLHttpRequest();
  httpUid.open('POST',daemonAdress + ':' + daemonPort,false);
  httpUid.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  httpUid.send('cmd='+'uid'+'!');
 
  var httpCreateChallenge = new XMLHttpRequest();
  httpCreateChallenge.open('POST','EddaInclude/createChallenge.php',false);
  httpCreateChallenge.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
  httpCreateChallenge.send('uid=' + httpUid.responseText); 

  var httpSolvedChallenge = new XMLHttpRequest();
  httpSolvedChallenge.open('POST',daemonAdress  + ':' + daemonPort,false);
  httpSolvedChallenge.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  httpSolvedChallenge.send('cmd='+'chg' + '&' +'rnd=' + httpCreateChallenge.responseText + '!');

  var httpCheckChallenge = new XMLHttpRequest();
  httpCheckChallenge.open('POST','EddaInclude/checkChallenge.php',false);
  httpCheckChallenge.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  httpCheckChallenge.send('solvedChallenge=' +  encodeURIComponent(httpSolvedChallenge.responseText) + '&' + 'uid=' + httpUid.responseText);

  // gives the response from the checkChallenge.php to tha "develInfo" span-tag
  document.getElementById("develInfo").innerHTML = httpCheckChallenge.responseText;
} 


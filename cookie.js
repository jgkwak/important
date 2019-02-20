
let name = prompt("Please type in your name", "");
var nameFound = false;

readDoc('important.txt', isImportant);
document.getElementById("notice").innerHTML += name;

if (nameFound === true)
{
  document.getElementById("valid").style.display = "block";
  document.getElementById("title").style.display = "block";
}
else{
  document.getElementById("invalid").style.display = "block";
 document.getElementById("title").style.display = "block";
}

move();

function readDoc(text, funct){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
         funct(this);
       }
     };
  xhttp.open("GET", text, true);
  xhttp.send();
}

function color(){

  document.getElementById("object").style.backgroundColor = $('input[name="color"]:checked').val();

}

function move() {
  var width = window.outerWidth - 430;   
  var pos = 0;
  var trig = 1;
  var id = setInterval(frame, 1);

  function frame() {
    color();
    var increment = (speed()/8);
    if (trig == -1) {
      pos-= increment;
      trig = -1;
      if(pos <= 0){
        trig = 1;
      }
    } 
    else if (trig == 1) {
      pos+= increment;
      trig = 1;
      if(pos >= width){
        trig = -1;
      } 
    }
    document.getElementById("object").style.left = pos + "px"; 
  }

  function speed(){
    return parseInt($('input[name="number"]:checked').val());
  }
  
}

function isImportant(xhttp){
  var array = xhttp.responseText.split("\n");
  console.log(array[0]);
  var one = array[0];
  var word;
  var i;
  for (i = 0; i < one.length; i++)
  {
    if(one[i] != (NaN && undefined && null))
      {
        word+= one[i];
      }
  }
  console.log(word);
  document.getElementById("testing").innerHTML = String(array[0]);

  for (i of array) {
    if(array[i] === name){
      nameFound = true;
    }
    console.log(array[i]);
  }

}






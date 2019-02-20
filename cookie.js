
let name = prompt("Please type in your name", "");


if (name === "Jennifer Kwak")
{
  document.getElementById("invalid").style.display = "none";
}
else{
   document.getElementById("valid").style.display = "none";
}

document.getElementById("notice").innerHTML += name;
compute();
move();

function compute(){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
         // Typical action to be performed when the document is ready:
          //document.getElementById("demo").innerHTML = xhttp.responseText;
       }
     };
  xhttp.open("GET", "https://raw.githubusercontent.com/jgkwak/another/master/hello.txt", true);
  console.log(xhttp.responseText);
  xhttp.send();
}

function color(){

  if(document.getElementById("red").checked){
    document.getElementById("object").style.backgroundColor = "red";
  }

  else if(document.getElementById("blue").checked){
    document.getElementById("object").style.backgroundColor = "blue";
  }

  else if(document.getElementById("yellow").checked){
    document.getElementById("object").style.backgroundColor = "yellow";
  }

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
      document.getElementById("object").style.left = pos + "px"; 
    } 
    else if (trig == 1) {
      pos+= increment;
      trig = 1;
      if(pos >= width){
        trig = -1;
      } 
      document.getElementById("object").style.left = pos + "px"; 
    }
  }

  function speed(){
    var fastVal = parseInt($('input[name="number"]:checked').val());
    return fastVal;
  }
  
}








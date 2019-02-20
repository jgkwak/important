
let name = prompt("Please type in your name", "");
var nameFound = false;


if (name === "Jennifer Kwak")
{
  document.getElementById("valid").style.display = "block";
  document.getElementById("title").style.display = "block";
}
else{
  document.getElementById("invalid").style.display = "block";
 document.getElementById("title").style.display = "block";
}

document.getElementById("notice").innerHTML += name;
readDoc('important.txt', isImportant);
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
  let para_node = document.getElementsByTagName("p")[0]; 
  //let newtext = xhttp.responseText.replace(/\\n/mg,"\n");
  let array = xhttp.responseText.split("\n");
  document.getElementById("testing").innerHTML = String(array[0]);
  console.log(String(array[1]);

  // for (i of array) {
  //   let new_p = document.createElement("p");
  //   let label = document.createTextNode(array[i]);
  //   new_p.appendChild(label);
  //   let first_child = para_node.firstChild;
  //   para_node.appendChild(new_p); 
  // }
  // document.getElementById("testing").innerHTML = xhttp.responseText;
}






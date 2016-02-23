function setProgress(){
  var value = parseInt(document.getElementById("progress_value").innerHTML);
  var backBar = document.getElementById("back_bar");
  var bar = document.getElementById("bar");
  var label = document.getElementById("label");
  var maxSize = parseInt(482);

  if(value < 0 || value > 100){
    value = 0;
  }

  if(value > 60){
    label.style.color = "#EFEFEF";
  }

  var size = (value/100)*maxSize;
  bar.style.width = size+"px";
}
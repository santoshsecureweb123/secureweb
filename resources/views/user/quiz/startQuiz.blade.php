@extends('user.user.header')
@section('dashboard_content')
<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}
input.invalid {
  background-color: #ffdddd;
}

.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

.step.finish {
  background-color: #4CAF50;
}
</style>
<div class="content-page">
  <div class="content">
    <div class="container-fluid">
      <div class="row">
         
<form id="regForm" action="{{route('quizAnswer')}}" method="post">
  <h1>Quiz Start</h1>
  @csrf
<div id="clockdiv"></div>
  <input type="hidden" name="quiz_id" value="{{$quizID}}"> 
  <input type="hidden" name="user_id" value="{{$user_id}}"> 
@foreach($allQuestions as $question)
  <div class="tab">{{$question->question_name}}:
    <?php $answers = json_decode($question->option); ?>
      @foreach($answers as $key => $answer)
      <p><input type="radio" name="answer_{{$question->question_id}}" class="answer" value="{{$answer}}">{{$answer}}</p>
      @endforeach  
    </div>
@endforeach
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
      <button type="submit"  id="submit" style="display: none;">Submit</button>
    </div>
  </div>

</form>
      </div>
    </div>
  </div>
</div>
<script>
var currentTab = 0;
showTab(currentTab);

function showTab(n) {
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    // document.getElementById("nextBtn").innerHTML = "Submit";
    $('#nextBtn').hide();
    $('#submit').show();
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  fixStepIndicator(n)
}

function nextPrev(n) {
  var x = document.getElementsByClassName("tab");

     // console.log(x.length);
  if (n == 1 && !validateForm()) return false;
  x[currentTab].style.display = "none";
  currentTab = currentTab + n;

  if (currentTab >= x.length) {
   
    // document.getElementById("regForm").submit();
    return false;
  }
  showTab(currentTab);
}

function validateForm() {

  var x, y, i, x_tab, y_tab, valid = true;
  
  x_tab = document.getElementsByClassName("tab");
  y_tab = x_tab[currentTab].getElementsByTagName("input").item(0);
  list = x_tab[currentTab].getElementsByTagName("input");
  input_type = y_tab.getAttribute('type')
  // console.log(type);
  /*if(input_type == 'radio')
  {
    var queryArr=[];
      // console.log(item);
      if( $('.answer').is(':checked')) {
          valid_check = true;
        }else{
          valid_check = false;
        }
        queryArr.push(valid_check);
        if($.inArray(true,queryArr) !== -1){
          valid = true;
        }else{
          valid = false;
        }
    
  }*/


  for (i = 0; i < list.length; i++) {
    if (list[i].value == "") {
      list[i].className += " invalid";
      valid = false;
    }
  }
  
  return valid; 
}

function fixStepIndicator(n) {
  
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  // x[n].className += " active";
}
// function skip(){
//   nextPrev(1);
// }
// setInterval(skip, 5000);
// Set the date we're counting down to
$(document).ready(function(){


var time_in_minutes = 1;
var current_time = Date.parse(new Date());
console.log(current_time);
var deadline = new Date(current_time + time_in_minutes*60*1000);
});

function time_remaining(endtime){
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor( (t/1000) % 60 );
  var minutes = Math.floor( (t/1000/60) % 60 );
  var hours = Math.floor( (t/(1000*60*60)) % 24 );
  var days = Math.floor( t/(1000*60*60*24) );
  return {'total':t, 'days':days, 'hours':hours, 'minutes':minutes, 'seconds':seconds};
}
function run_clock(id,endtime){
  var clock = document.getElementById(id);
  function update_clock(){
    var t = time_remaining(endtime);
    clock.innerHTML = t.seconds;
    if(t.total<=0){ clearInterval(timeinterval); }
  }
  update_clock(); // run function once at first to avoid delay
  var timeinterval = setInterval(update_clock,1000);
}
run_clock('clockdiv',deadline);
</script>
@endsection
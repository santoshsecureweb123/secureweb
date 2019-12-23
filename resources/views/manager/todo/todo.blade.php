
<style type="text/css">	
body, html {
  background: #093028; /* fallback for old browsers */
background: -webkit-linear-gradient(to left, #093028 , #237A57); /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to left, #093028 , #237A57); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
font-family: 'Roboto', sans-serif;
  cursor: default;
}

.removeall {
  float: right;
  font-size: 0.4em;
  margin-right: 0%;
  line-height: 30px;
  padding-left: 1em;
  cursor: pointer;
}

.add {
  float:right;
  cursor: pointer;
}

#container {
  background: #7D3B44;
  width: 360px;
  margin: 100px auto;
  box-shadow: 0 0 3px rgba(0,0,0, 1);
}

h1 {
  background: #66202A;
  color: white;
  margin: 0;
  padding: 10px 20px;
  text-transform: uppercase;
  font-size: 24px;
  font-weight: normal;
}

ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

li {
  background: #66202A;
  max-height: 400px;
  line-height: 40px;
  color:  lightgray;
}

li:nth-child(2n) {
  background: #7D3B44;
}
 

input {
  font-size: 15px;
  text-align: center;
  letter-spacing: 1px;
  background: #84593D;
  width: 100%;
  border: none;
  box-sizing: border-box;
  padding: 13px 13px 13px 20px;
  color: white;
}

input:focus {
  background: #84593D;
  outline:none;
  border: 2px solid #84593D;
  color: white;
}
.completed {
  text-decoration: line-through;
  color: gray;
}

li:hover {
  cursor: pointer;
}

span {
  background: #217353;
  height: 40px;
  margin-right: 20px;
  text-align: center;
  color: white;
  width: 0px;
  display: inline-block;
  transition: 0.2s linear;
  opacity: 0;
}

li:hover span {
  width: 40px;
  opacity: 1;
}

::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    color:    lightgray;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
   color:    lightgray;
   opacity:  1;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
   color:    lightgray;
   opacity:  1;
}
:-ms-input-placeholder { /* Internet Explorer 10-11 */
   color:    lightgray;
}
	</style>
</head>
<body> 
<div id = "container">
  <h1>To-Do List<i class="removeall">Clear</i><i class="add">+</i></h1>
  <input type="text" placeholder="[Add New Todo]">
  <ul>
    <li><span><i class="fa fa-trash"></i></span><number></number>Go to potions Class </li>
    <li> <span><i class="fa fa-trash"></i></span><number></number> Buy new Robes </li>
    <li> <span><i class="fa fa-trash"></i></span><number></number> Visit Hagrid </li>
  </ul>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
		function updateNumbers() {
  //update variable
    var lists = document.querySelectorAll("number");
    //update number
    for(var i = 0; i < lists.length; i++) {
      $(lists[i]).html(i+1 + ") ");
    }
}
updateNumbers();
//Check off Specific Todos By Clicking
$("ul").on("click", "li", function () {
  $(this).toggleClass("completed");
});

//Click on X to delete Todo
$("ul").on('click', "span", function (e) {
  e.stopPropagation();
  $(this).closest("li").fadeOut(500,function() {
   $(this).remove();
    updateNumbers();
  });
});

//Clear All
$(".removeall").on('click', function (e) {
    $("li").fadeOut(500, function() {
      $(this).remove();
    });
});

//Add new todos
$("input[type='text']").keypress(function(e) {
  if(e.which === 13) {
    //grab text
    var todoText = $(this).val();
    //append todotext to ul
    if( $(this).val() !== "") {
    $("ul").append("<li><span><i class='fa fa-trash'> </i></span>" + "<number></number>" + todoText + "</li>");
      }
    updateNumbers();
    //clear text
    $(this).val("");
  }
});

$(".add").click(function() {
  $("input[type='text']").fadeToggle(200);
});
</script>

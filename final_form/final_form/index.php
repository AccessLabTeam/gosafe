<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style>

#loading-img{
display:none;
}

.response_msg{
margin-top:10px;
font-size:13px;
background:#E5D669;
color:#ffffff;
width:250px;
padding:3px;
display:none;
}

</style>
</head>
<body>

<div class="container">
<div class="row">

<div class="col-md-8">
<h1><img src="a.png" width="80px">Ypoboli simeiou Provlimatos</h1>
<form name="contact-form" action="" method="post" id="contact-form">
<div class="form-group">
<label for="Name">Title</label>
<input type="text" class="form-control" name="your_title" placeholder="Name" required>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Email address</label>
<input type="email" class="form-control" name="your_email" placeholder="Email" required>
</div>
<div class="form-group"><label class="control-label required" for="vp_simeiabundle_problem_category">Κατηγορία</label>
  <div class="controls"><select id="vp_simeiabundle_problem_category" name="vp_simeiabundle_problem[category]" class="form-control">
    <option value="1">Ράμπα ΑμεΑ</option>
    <option value="2">Θέση Πάρκινγκ ΑμεΑ</option>
    <option value="3">Κτίριο</option>
    <option value="4">Σύστημα SEATRAC</option></select>
  </div>
</div>
<div class="form-group">
<label for="comments">Comments</label>
<textarea name="comments" class="form-control" rows="3" cols="28" rows="5" placeholder="Comments"></textarea>
</div>
<div class="form-group">
  <label class="control-label" for="vp_simeiabundle_problem_file">Εικόνα (μόνο εικόνες μέχρι 2ΜΒ)</label>
  <div class="controls">
    <input type="file" id="vp_simeiabundle_problem_file" name="vp_simeiabundle_problem[file]"
    class="form-control" />
  </div>
</div>

<button type="submit" class="btn btn-primary" name="submit" value="Submit" id="submit_form">Submit</button>
<img src="b.gif" id="loading-img">
</form>

<div class="response_msg"></div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
$("#contact-form").on("submit",function(e){
e.preventDefault();
if($("#contact-form [name='your_title']").val() === '')
{
$("#contact-form [name='your_title']").css("border","1px solid red");
}
else if ($("#contact-form [name='your_email']").val() === '')
{
$("#contact-form [name='your_email']").css("border","1px solid red");
}
else
{
$("#loading-img").css("display","block");
var sendData = $( this ).serialize();
$.ajax({
type: "POST",
url: "get_response.php",
data: sendData,
success: function(data){
$("#loading-img").css("display","none");
$(".response_msg").text(data);
$(".response_msg").slideDown().fadeOut(3000);
$("#contact-form").find("input[type=text], input[type=email], textarea, input[type=file]").val("");
}

});
}
});

$("#contact-form input").blur(function(){
var checkValue = $(this).val();
if(checkValue != '')
{
$(this).css("border","1px solid #eeeeee");
}
});
});
</script>
</body>
</html>

<!DOCTYPE html >
<?php
	session_start();
	if(!isset($_SESSION['User_type'])){
		header("Location:index.php?feedback=user");
	}
	if($_SESSION['User_type']=="norm"){
	header("Location:index.php?feedback=user");
	}
 ?>
<html>
	<head>
		<title>Upload</title>
		<link rel="stylesheet" type="text/css" href="CSS/upload.css" media="all">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdn.tiny.cloud/1/em8lmiijbqvpt1w0p0zkg93lmk9uafce6517ai1wsrfmuu8e/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		<script>
			tinymce.init({selector: '#element_2',
			init_instance_callback : function(editor) {
    			editor.setContent('<p style=\"text-align: left;\"><span style=\" font-family: \'andale mono\', monospace; color: #545454;\"><strong>Description</strong></span></p>\n<p>\&nbsp;</p>\n<h4 style=\"text-align: left;\"><span style=\" font-family: \'andale mono\', monospace; color: #545454;\"><strong>Constraints</strong></span></h4>\n<p>\&nbsp;</p>\n<h4 style=\"text-align: left;\"><span style=\" font-family: \'andale mono\', monospace; color: #545454;\"><strong>Format</strong></span></h4>\n<p>\&nbsp;</p>\n<h4 style=\"text-align: left;\"><span style=\" font-family: \'andale mono\', monospace; color: #545454;\"><strong>Sample Input</strong></span></h4>\n<p>\&nbsp;</p>\n<h4 style=\"text-align: left;\"><span style=\" font-family: \'andale mono\', monospace; color: #545454;\"><strong>Sample Output</strong></span></h4>\n<p style=\"text-align: left;\">\&nbsp;</p>\n<h4 style=\"text-align: left;\"><span style=\" font-family: \'andale mono\', monospace; color: #545454;\"><strong>Explanation</strong></span></h4>\n<p style=\"text-align: left;\">\&nbsp;</p>');
  			}
			});
		</script>
		<script type="text/javascript">
			function uploadProblem(){
				var name=document.getElementById('input-title').value;
				var diff=document.querySelector('input[name="diff"]:checked').value;
				var score=document.getElementById('element_5').value;
				var inp =document.getElementById('element_3').value;
				var out=document.getElementById('element_4').value;
				var desc=tinymce.activeEditor.getContent();
				$('#btn').hide();
				$.ajax({
					url: 'includes/uploader.php',
					type: 'POST',
					data: {
						prob_name: name,
						Difficulty: diff,
						Score: score,
						Input: inp,
						Output: out,
						Description: desc
					},
					success:function(){
						alert('Problem Uploaded Successfully.');
						document.getElementById("prob_form").reset();
						$('#btn').show();
					}
				});
			}
		</script>
	</head>
	<body id="main_body" >
		<div id="form_container">
			<form id="prob_form"  method="post" >
				<div class="form_description">
					<h2>Problem Upload Form</h2>
					<p></p>
				</div>
				<ul>
					<li>
						<label class="description"> Problem Name </label>
						<div>
							<input required id="input-title" name="title" class="element text large" type="text" maxlength="255" value=""/>
						</div>
					</li>
					<li id="li_5" >
					<label class="description">Problem Difficulty </label>
						<span>
								<input required id="element_5_1" name="diff" class="element radio" type="radio" value="Easy" />
								<label class="choice" >Easy</label>
								<input id="element_5_2" name="diff" class="element radio" type="radio" value="Medium" />
								<label class="choice" >Medium</label>
								<input id="element_5_3" name="diff" class="element radio" type="radio" value="Hard" />
								<label class="choice" >Hard</label>
						</span>

					</li>
					<li id="li_2" >
						<label class="description" >Problem Description </label>
						<div>
							<textarea  id="element_2"  class="element textarea large"></textarea>
						</div>
					</li>
					<li id="li_3" >
						<label class="description" >Input Testcase </label>
						<div>
							<textarea required id="element_3" name="test-in" class="element textarea medium"></textarea>
						</div>
					</li>
					<li id="li_4" >
						<label class="description">Output Testcase </label>
						<div>
							<textarea required id="element_4" name="test-out" class="element textarea medium"></textarea>
						</div>
					</li>
					<li id="li_5" >
						<label class="description" >Problem Score </label>
						<div>
							<input id="element_5" name="element_5" class="element text small" type="number" min="1" max="100"/>
						</div>
					</li>
					<li class="buttons" align="center">
						<button id="btn" type="button" onclick="uploadProblem()">Upload</button>
					</li>
				</ul>
			</form>
		</div>
	</body>
</html>

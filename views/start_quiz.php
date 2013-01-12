<script>var test_id = <?php echo $id; ?>;</script>
<div class="width center" id="main">
  <h1><?php echo $title->title." &mdash; ".$title->description; ?></h1>
  <input type="button" id="restartbutton" onclick="init();" value="Restart?">
</div>
<div class="width">
  <div id="mainleft" class="content">
  <h4>Question:</h4>
<p><span id="question"></span></p>
</div>
  <div id="mainright" class="content">
<h4>Answers:</h4>
<input type="radio" name="itemquestion" id="1" onclick="validate(1);"><label id="label1" for="1">Test label 1</label>
<div class="clearfloat"></div>
<input type="radio" name="itemquestion" id="2" onclick="validate(2);"><label id="label2" for="2">Test label 2</label>
<div class="clearfloat"></div>
<input type="radio" name="itemquestion" id="3" onclick="validate(3);"><label id="label3" for="3">Test label 3</label>
<div class="clearfloat"></div>
<input type="button" id="nextbutton" onclick="nextQuestion(questions);" value="Next Question">
<input type="button" id="endbutton" onclick="showSummary();" value="End now">
  </div>
  <div class="clearfloat"></div>
  </div>
<script type="text/javascript"
  src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=default">
</script>


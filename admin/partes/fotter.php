        <div class="clear"></div>
    </div>
    <div class="footer">   
    	<div class="left_footer"></div>
    </div>
</div>		

<?php
	/*
	<pre id="debug">
		<h2> $_SESSION </h2>
		<?php var_dump($_SESSION); ?>
	</pre>

	<pre>
		<h2> $_POST </h2>
		<?php var_dump($_POST); ?>
	</pre>

	<pre>
		<h2> $_FILES </h2>
		<?php var_dump($_FILES); ?>
	</pre>

	<pre>
		<h2> $_GLOBALS </h2>
		<?php var_dump($GLOBALS); ?>
	</pre>
*/ ?>
</body>
</html>

<?php
// footer?
printf("<div id='ob_get_length'>%sseg, %db</div>",
  microtime(1)-$StartTime,
  ob_get_length()+58);
ob_end_flush();
?>
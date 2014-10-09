<?php 

if (isset($_GET['markup'])) {

	header('Content-Type: text/html; charset=utf-8');
	
	echo stripslashes(urldecode($_GET['markup']));

} else { ?>

<!DOCTYPE html>
<html>
<head>
    
<meta charset=utf-8 />
<meta name="author" content="Nathan Ford" />
<meta name="description" content="Write a description here." />

<meta name="viewport" content="width=device-width, minimum-scale=1.0" />

<title>Builder</title>

<link href="./css/styles.css" rel="stylesheet" />

</head>
			
<body>
	
	<div id="main" class="clearfix">
			
		<div id="elements" class="box">
		
			<!--<h2>Favorites</h2>
			
			<ul id="list-favorites" class="list">
			</ul>-->
			
			<h2>Elements</h2>
			
			<ul id="list-elements" class="list">
				<li class="list-header">A</li>
				<li data-tag="address" title="Use to contain an address"><span>&lt;address></span></li>
				<li data-tag="article" title="Use to contain an article"><span>&lt;article></span></li>
				<li data-tag="aside" title="Use to contain ancillary info like pull-quotes, sidebars, etc."><span>&lt;aside></span></li>
				<li data-tag="audio" title="Use to embed audio"><span>&lt;audio></span></li>
				<li class="list-header">B</li>
				<li data-tag="blockquote" title="Use for quotes as part of your main text"><span>&lt;blockquote></span></li>
				<li class="list-header">C</li>
				<li data-tag="canvas" title="Use for advanced JavaScript graphics and animations"><span>&lt;canvas></span></li>
				<li class="list-header">D</li>
				<li data-tag="dd" title="Definition list definition"><span>&lt;dd></span></li>
				<li data-tag="div" title="Use as a generic container"><span>&lt;div></span></li>
				<li data-tag="dl" title="Use to contain a list of terms and definitions"><span>&lt;dl></span></li>
				<li data-tag="dt" title="Definition list term"><span>&lt;dt></span></li>
				<li class="list-header">F</li>
				<li data-tag="fieldset" title="Use to contain a form label and inputs"><span>&lt;fieldset></span></li>
				<li data-tag="figcaption" title="Use for captions within figures"><span>&lt;figcaption></span></li>
				<li data-tag="figure" title="Use to contain images, video, and their captions"><span>&lt;figure></span></li>
				<li data-tag="footer" title="Use to contain footer information, either within an article or an entire page"><span>&lt;footer></span></li>
				<li data-tag="form" title="Use to contain form elements like labels, textareas, and inputs"><span>&lt;form></span></li>
				<li class="list-header">H</li>
				<li data-tag="h1" title="The most important heading in an article, aside, or section"><span>&lt;h1></span></li>
				<li data-tag="h2" title="A secondary heading in an article, aside, or section"><span>&lt;h2></span></li>
				<li data-tag="h3" title="A tertiary heading in an article, aside, or section"><span>&lt;h3></span></li>
				<li data-tag="h4" title="A heading in an article, aside, or section"><span>&lt;h4></span></li>
				<li data-tag="h5" title="A heading in an article, aside, or section"><span>&lt;h5></span></li>
				<li data-tag="h6" title="A heading in an article, aside, or section"><span>&lt;h6></span></li>
				<li data-tag="header" title="Use to contain header information, like headings and author info, for and article or page"><span>&lt;header></span></li>
				<li class="list-header">L</li>
				<li data-tag="li" title="List item: use for items in an ordered or unordered list"><span>&lt;li></span></li>
				<li class="list-header">O</li>
				<li data-tag="ol" title="Ordered list: use to contain a numbered list of list items"><span>&lt;ol></span></li>
				<li class="list-header">P</li>
				<li data-tag="p" title="Paragraph: use to contain paragraphs of text"><span>&lt;p></span></li>
				<li data-tag="pre" title="Preformat: use to contain code examples"><span>&lt;pre></span></li>
				<li class="list-header">S</li>
				<li data-tag="section" title="Use to contain articles or sections within an article"><span>&lt;section></span></li>
				<li class="list-header">T</li>
				<li data-tag="table" title="Use to contain table rows and cells"><span>&lt;table></span></li>
				<li data-tag="tr" title="Table row: use to contain table cells"><span>&lt;tr></span></li>
				<li data-tag="td" title="Table cell: use to contain table content"><span>&lt;td></span></li>
				<li class="list-header">U</li>
				<li data-tag="ul" title="Unordered list: use to contain a bulleted list of list items"><span>&lt;ul></span></li>
				<li class="list-header">V</li>
				<li data-tag="video" title="Use to embed video"><span>&lt;video></span></li>
			</ul>
			
		</div>
		
		<div id="html" class="box">
		
			<h2>Structure</h2>
			
			<ul id="list-structure" class="list">
				<li id="body" class="list"><!-- body -->
				<ul id="body-children" class="children">
					
				</ul></li>
			</ul>
			
		</div>
		
		<div id="output" class="box">
			
			<a id="validate" href="#">Validate</a>
			
			<a id="generate" href="#">Preview</a>
		
			<h2>HTML</h2>
			
			<div id="text-html"><pre class="html" contenteditable="true">&lt;!DOCTYPE html>
&lt;html>
&lt;head>
    
&lt;meta charset=utf-8 />
&lt;meta name="author" content="Anon" />
&lt;meta name="description" content="Write a description here." />

&lt;title>Page&lt;/title>

&lt;/head>
			
&lt;body>
</pre>
			<pre id="body-html" class="html" contenteditable="true"></pre>
			<pre class="html" contenteditable="true">
	
&lt;/body>
&lt;/html></pre>
			
			</div>
			
		</div>
		
		<div id="render" class="box">
			<div id="body-render" data-id="body"></div>
		</div>
			
	</div><!-- end #main -->
	
	<form id="attrPrompt">
	
		<input id="ele-selected" type="hidden" name="ele-selected" value="" />
		
		<fieldset>
			<label for="ele-id">ID</label>
			<input id="ele-id" type="text" name="ele-id" value="" tabindex="1" />
		</fieldset>
		
		<fieldset>
			<label for="ele-class">Class</label>
			<input id="ele-class" type="text" name="ele-class" value="" tabindex="2" />
		</fieldset>
		
		<fieldset>
			<label for="ele-title">Title</label>
			<input id="ele-title" type="text" name="ele-title" value="" tabindex="3" />
		</fieldset>
		
		<div class="submit-area">
			<button type="submit" tabindex="4">Apply</button>
			<a href="#" id="cancel">Cancel</a>
		</div>
	
	</form>	
	
	<script src="./js/jquery.js" type="text/javascript"></script>
	<script src="./js/jquery-ui.js"></script>
	<script src="./js/marker.js" type="text/javascript"></script>
	
</body>
</html>
<?php } ?>
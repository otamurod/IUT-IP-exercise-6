<?php

	$pattern="";
	/* /(quick)/  contains a string
	 * /[a-zA-Z0-9.-_]+[@]\w+[.]\w{2,3}/ contains email string
	 * /\+\d{3}-\d{2}-\d{3}-\d{4}/  a string contains a phone number of format +998-##-###-####
	*/
	$text="";
	$replaceText="";
	$replacedText="";
    $withoutWhitespace="";
    $numerics="";
    $string=
"Twinkle, twinkle, little star,
How I wonder what you are.
Up above the world so high,
Like a diamond in the sky.";

    $withoutNewLines="";
	$match="Not checked yet.";

if ($_SERVER["REQUEST_METHOD"]=="POST") {
	$pattern=$_POST["pattern"];
	$text=$_POST["text"];
	$replaceText=$_POST["replaceText"];

	$replacedText=preg_replace($pattern, $replaceText, $text);

	$withoutWhitespace=preg_replace('/\s+/', '', $text); //remove whitespaces
    $numerics=preg_replace('/[^0-9,.]/', '', $text); //remove nonnumericals except , and .
    $withoutNewLines=preg_replace('/\n/', ' ', $string); //remove new lines
    preg_match('#\[(.*?)\]#', $text, $withoutParenthesis); //remove parenthesis

	if(preg_match($pattern, $text)) {
						$match="Match!";
					} else {
						$match="Does not match!";
					}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Valid Form</title>
</head>
<body>
	<form action="regex_valid_form.php" method="post">
		<dl>
			<dt>Pattern</dt>
			<dd><input type="text" name="pattern" value="<?= $pattern ?>"></dd>

			<dt>Text</dt>
			<dd><input type="text" name="text" value="<?= $text ?>"></dd>

			<dt>Replace Text</dt>
			<dd><input type="text" name="replaceText" value="<?= $replaceText ?>"></dd>

			<dt>Output Text</dt>
			<dd><?=	$match ?></dd>

			<dt>Replaced Text</dt>
			<dd> <code><?=	$replacedText ?></code></dd>

            <dt>Text without whitespaces</dt>
            <dd> <code><?=	$withoutWhitespace ?></code></dd>

            <dt>Text without nonnumericals</dt>
            <dd> <code><?=	$numerics ?></code></dd>

            <dt>Text without new lines</dt>
            <dd> <code><?=	$withoutNewLines ?></code></dd>

            <dt>Text without parenthesis</dt>
            <dd> <code><?=	$withoutParenthesis[1]."\n" ?></code></dd>

			<dt>&nbsp;</dt>
			<dd><input type="submit" value="Check"></dd>
		</dl>

	</form>
</body>
</html>

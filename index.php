<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHPmyCalculator</title>
	<link rel="stylesheet" href="style.css">
	<script src="app.js" defer></script>
</head>

<!--
	TODO: Implement the logic  for the calculator using the form
	- The logic of the calculator need to be implemented in php
	- Can add a final 0 + at the start of the total operation
	- Implement the logic to assign the value to total and calculate the "equal"
	- Implement the logic to calculate
	- Check to use the title to display the value or another element, using the input only for the new value
-->

<body>
	<header>
		<h1>
			<?php
				if (isset($_POST["operation"])) {
					$operation = $_POST["operation"];
					eval("echo $operation;");
				} else {echo "PHPmyCalculator";}
			?>
		</h1>
	</header>
	<main>
		<section>
			<form name="calculate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
				<input type="number" name="number" id="value" value="0" min="<?php echo PHP_INT_MIN; ?>"
					max="<?php echo PHP_INT_MAX; ?>" step="1" pattern="\d{1}" required>
				<input type="hidden" name="operator"
					value="<?php echo isset($_POST["operator"])? $_POST["operator"]:"+"?>">
				<input type="hidden" name="operation" value="<?php
					if (isset($_POST["calculate"]) && $_POST["calculate"] == "true") echo "0";
					else echo isset($_POST["operation"])? $_POST["operation"]:"0";
				?>">
				<input type="hidden" name="calculate" value="false">
				<button type="submit">=</button>
			</form>
		</section>
		<aside>
			<div>
				<button value="+">+</button>
				<button value="-">-</button>
				<button value="*">&CenterDot;</button>
				<button value="/">&divide;</button>
			</div>
			<div>
				<button value="1">1</button>
				<button value="2">2</button>
				<button value="3">3</button>
				<button value="4">4</button>
			</div>
			<div>
				<button value="5">5</button>
				<button value="6">6</button>
				<button value="7">7</button>
				<button value="8">8</button>
			</div>
			<div>
				<button value="9">9</button>
				<button value="0">0</button>
				<button value=".">,</button>
				<button value="clear">C</button>
			</div>
		</aside>
	</main>
</body>

</html>
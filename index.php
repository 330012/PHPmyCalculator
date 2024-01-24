<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHPmyCalculator</title>
	<link rel="stylesheet" href="style.css">
</head>

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
				<button value="*">·</button>
				<button value="/">÷</button>
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

	<script>
		window.addEventListener('DOMContentLoaded', (event) => {
			const buttons = Array.from(document.querySelectorAll("div > button"));
			const numericButtons = buttons.filter(button => button.innerText.match(/\d/g));
			const operatorsButtons = buttons.filter(button => button.innerText.match(/\+|\-|·|÷/g));
			const decimalButton = buttons.filter(button => button.innerText == ",")[0];
			const clearButton = buttons.filter(button => button.innerText == "C")[0];
			const numberInput = document.querySelector("input[name=\"number\"]");
			const operatorInput = document.querySelector("input[name=\"operator\"]");
			const operationInput = document.querySelector("input[name=\"operation\"]");
			const calculateInput = document.querySelector("input[name=\"calculate\"]");
			const submitButton = document.querySelector("button[type=\"submit\"]");
			const form = document.querySelector("form[name=\"calculate\"]");

			let nextDecimal = false;

			operatorsButtons.forEach(
				operator => operator.addEventListener(
					"click",
					() => {
						operationInput.value += operatorInput.value + numberInput.value;
						operatorInput.value = operator.value;
						form.submit();
					}
				)
			);

			numericButtons.forEach(
				number => number.addEventListener(
					"click",
					() => {
						const numberValue = number.value;

						if (nextDecimal) numberInput.value += ".".concat(numberValue);
						else if (numberInput.value === "0") numberInput.value = numberValue;
						else numberInput.value += numberValue;
							
						nextDecimal = false;

						limitInput();
					}
				)
			);

			decimalButton.addEventListener(
				"click",
				() => nextDecimal = numberInput.value.includes(".")? false:true
			);

			clearButton.addEventListener(
				"click",
				() => numberInput.value = "0"
			);

			numberInput.addEventListener("input", limitInput);

			numberInput.addEventListener("change", limitInput);

			submitButton.addEventListener(
				"click",
				() => {
					operationInput.value += operatorInput.value + numberInput.value;
					calculateInput.value = "true";
					form.submit();
				}
			);

			function limitInput() {
				if (numberInput.value.length > 13) numberInput.value = numberInput.value.slice(0, 13);
			}
		});
	</script>
</body>

</html>

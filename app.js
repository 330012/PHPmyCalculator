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

// get value for get parameter "pin-code"
const toGetValueFromURL = (parameterName)=>{
    const queryString = window.location.search;

    const params = new URLSearchParams(queryString);

    return params.get(parameterName);
}
// toShow info about order
 const toShowOrderInfo = ()=>{
     const orderNumberInput = document.querySelector("#order-number");
     const orderAmountInput = document.querySelector("#order-amount");

     orderNumberInput.closest('.form-group').classList.remove("--hidden");
     orderAmountInput.closest('.form-group').classList.remove("--hidden");

     const orderNumber = toGetValueFromURL('order-number')
     const orderAmount = toGetValueFromURL('order-amount')

     orderNumberInput.value = orderNumber;
     orderAmountInput.value = orderAmount;

 }

// validation code with user typed
const toValidatePinCode = ()=>{
    const codeInput = document.querySelector("#pin-code");
    const pinCode = Number(toGetValueFromURL('pin-code'))

    if (Number(codeInput.value) === pinCode) {
        codeInput.closest('.form-group').classList.add("--hidden");
        return true
    }

    return false

}


//add event for submit button
const toAddSubmitButtonEvent = (button) =>{

    button.addEventListener("click", function () {
        if(toValidatePinCode()){
            toShowOrderInfo()

            button.classList.add("--hidden");

            const completeBtn = document.querySelector("#complete-btn");
            completeBtn.classList.remove("--hidden");
        }

        else {
            Swal.fire({
                title: 'Error!',
                text: 'Wrong PIN code',
                icon: 'error',
            })
        }
    })
}

//add event for complete button for send data for email
const toAddCompleteButtonEvent = (button) =>{

    button.addEventListener("click", function () {

        const requestOptions = {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ 'data' : {email: toGetValueFromURL('email'),
                    order_number: toGetValueFromURL('order-number'),
                    order_amount: toGetValueFromURL('order-amount'),}
            })
        };
        fetch('/emailSender.php', requestOptions)
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    title: data.success === true ? 'Success !' : 'Error!',
                    text: data.message,
                    icon: data.success === true ? 'success' : 'error',
                })
            } );

    })
}



// to involve functions after DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
    const submitBtn = document.querySelector("#validate-btn")
    const completeBtn = document.querySelector("#complete-btn")

    toAddSubmitButtonEvent(submitBtn)
    toAddCompleteButtonEvent(completeBtn)
});

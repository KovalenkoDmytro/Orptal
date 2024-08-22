// get value from all inputs inside the form and join it together and return string url with get parameters
const toGetFormData = (form) => {

    const formInputs = form.querySelectorAll('input');

    const params = Array.prototype.map.call(formInputs, (input) => `${input.name}=${encodeURIComponent(input.value)}`);

    return params.join('&');

}

// generate qr code and show it on page
const toGenerateQRCode = (data) => {
    const qrCodeContainer = document.querySelector('#qr-code-image');

    // if qrCode is existed, remove it
    if (qrCodeContainer.children.length) {
        qrCodeContainer.innerHTML = '';
    }

    const qrCodeOptions = {
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H,
        type: 'image/png',
    };
    const qrCode = new QRCode(qrCodeContainer, qrCodeOptions);

    qrCode.clear();
    qrCode.makeCode(`${window.location.origin}/order.php?${data}`);

    // to show qr cod in modal window
    setTimeout(()=>{
        Swal.fire({
            imageUrl: `${qrCodeContainer.querySelector('img').src}`,
            imageWidth: 300,
            imageHeight: 300,
        });
    }, 10 )


}


//add event for form
const toAddFormEvent = (form) =>{
    form.addEventListener("submit", function (event) {
        event.preventDefault()

        const data = toGetFormData(this)

        toGenerateQRCode(data)

    })
}




// to involve functions after DOM is loaded

document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("#order-form")

    toAddFormEvent(form)
});






<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="public/scss/main.scss">
        <title>Order</title>
    </head>

    <body>

        <main class="index-page">
            <section class="content-wrapper">
                <h1>Order Information</h1>

                <div class="form">
                    <div class="form-group ">

                        <label for="pin-code">Please type your 4-digit PIN Code:</label>

                        <input type="text" name="pin-code" id="pin-code" pattern="^\d{4}$" placeholder="PIN code" required>

                    </div>

                    <div class="form-group --hidden --disabled">

                        <label for="order-number">Order Number:</label>

                        <input type="text" id="order-number" name="order-number">

                    </div>

                    <div class="form-group --hidden --disabled">

                        <label for="order-amount">Order Amount:</label>

                        <input type="number" id="order-amount" name="order-amount">

                    </div>

                    <button class="btn" id="validate-btn">Submit</button>
                    <button type="submit" class="btn --hidden" id="complete-btn">Complete</button>
                </div>

                <div class="qr-code-image" id="qr-code-image"></div>

            </section>
        </main>

        <footer>
            <script src="public/js/libs/sweetalert2.js"></script>
            <script src="public/js/pages/order.js"></script>
        </footer>

    </body>
</html>
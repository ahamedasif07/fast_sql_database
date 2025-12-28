<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Form</title>

    <style>
    body {
        font-family: Arial, sans-serif;
        background: #f8fafc;
        padding: 40px;
    }

    .form-wrapper {
        max-width: 700px;
        margin: auto;
        background: #fff;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    h2 {
        margin-bottom: 20px;
        color: #0f172a;
    }

    label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 6px;
    }

    input,
    textarea {
        width: 100%;
        padding: 14px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        margin-bottom: 15px;
    }

    button {
        width: 100%;
        background: #045cb4;
        color: white;
        border: none;
        padding: 16px;
        border-radius: 18px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }

    .success {
        background: #d1fae5;
        color: #065f46;
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .grid-3 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 15px;
    }

    @media(max-width:768px) {

        .grid-2,
        .grid-3 {
            grid-template-columns: 1fr;
        }
    }
    </style>
</head>

<body>

    <div class="form-wrapper">
        <h2>Complete Your Order</h2>

        <?php if (isset($_GET['success'])): ?>
        <div class="success">✅ Order Submitted Successfully!</div>
        <?php endif; ?>

        <form action="process.php" method="POST">

            <div class="grid-2">
                <input type="text" name="firstName" placeholder="First Name" required>
                <input type="text" name="lastName" placeholder="Last Name" required>
            </div>

            <div class="grid-2">
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="phone" placeholder="Phone" required>
            </div>

            <input type="text" name="address" placeholder="Address" required>

            <div class="grid-3">
                <input type="text" name="city" placeholder="City" required>
                <input type="text" name="state" placeholder="State" required>
                <input type="text" name="zip" placeholder="ZIP" required>
            </div>

            <textarea name="notes" placeholder="Order Notes (optional)"></textarea>

            <button type="submit">Place Order</button>

        </form>
    </div>

</body>

</html> -->
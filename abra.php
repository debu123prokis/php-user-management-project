<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            padding: 50px;
        }

        .popup {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #f44336;
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            opacity: 0;
            transform: translateX(150%);
            transition: transform 0.4s ease, opacity 0.4s ease;
            z-index: 99999;
        }

        .popup.success {
            background-color: #4CAF50;
        }

        .popup.toastshow {
            opacity: 1;
            transform: translateX(0%);
        }
    </style>
</head>

<body>

    <h2>Popup Manual Test</h2>
    <button id="testBtn">Show Popup</button>

    <div id="popup" class="popup"></div>

    <script>
        function showPopup(message, type) {
            const popup = jQuery("#popup");

            popup
                .removeClass("success toastshow")
                .css({ right: "-350px", opacity: 0 })
                .text(message);

            if (type === "success") popup.addClass("success");

            // Add show class with slight delay
            setTimeout(() => popup.addClass("toastshow"), 50);

            // Hide automatically
            setTimeout(() => popup.removeClass("toastshow"), 3000);
        }

        // Test button
        $("#testBtn").click(function () {
            showPopup("✅ Manual test success!", "success");
        });
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-ask</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            background-image: url('https://wallpapercave.com/wp/wp5104088.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: black; /* Grey background color */
            padding: 10px; /* Adjust padding as needed */
        }
        
        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex; /* Display items in a row */
            justify-content: center; /* Center items horizontally */
        }
        
        .navbar li {
            margin-right: 20px; /* Adjust spacing between menu items */
        }
        
        .navbar a {
            color: white;
            text-decoration: none;
        }

        /* Popup styles */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .popup {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            width: 300px; /* Adjust width as needed */
        }

        .close-btn {
            float: right;
            cursor: pointer;
        }

        .fixed-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1001;
            cursor: pointer;
        }

        .container-fluid {
            background: rgba(255, 255, 255, 0.8); /* Semi-transparent background for content */
            padding-top: 60px; /* Adjust to create space for the fixed navbar */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .wrapper {
            width: 370px;
            background: #fff;
            border-radius: 5px;
            border: 1px solid lightgrey;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        .wrapper .title {
            background: #007bff;
            color: #fff;
            font-size: 20px;
            font-weight: 500;
            line-height: 60px;
            text-align: center;
            border-bottom: 1px solid #006fe6;
            border-radius: 5px 5px 0 0;
        }
        .wrapper .form {
            padding: 20px 15px;
            min-height: 400px;
            max-height: 400px;
            overflow-y: auto;
        }
        .wrapper .form .inbox {
            width: 100%;
            display: flex;
            align-items: baseline;
        }
        .wrapper .form .user-inbox {
            justify-content: flex-end;
            margin: 13px 0;
        }
        .wrapper .form .inbox .icon {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            background: url('https://cdn-icons-png.flaticon.com/512/4712/4712009.png') no-repeat center center;
            background-size: cover;
        }
        .wrapper .form .inbox .msg-header {
            max-width: 53%;
            margin-left: 10px;
        }
        .form .inbox .msg-header p {
            color: #fff;
            background: #007bff;
            border-radius: 10px;
            padding: 8px 10px;
            font-size: 14px;
            word-break: break-all;
        }
        .form .user-inbox .msg-header p {
            color: #333;
            background: #efefef;
        }
        .wrapper .typing-field {
            display: flex;
            height: 60px;
            width: 100%;
            align-items: center;
            justify-content: space-evenly;
            background: #efefef;
            border-top: 1px solid #d9d9d9;
            border-radius: 0 0 5px 5px;
        }
        .wrapper .typing-field .input-data {
            height: 40px;
            width: 335px;
            position: relative;
        }
        .wrapper .typing-field .input-data input {
            height: 100%;
            width: 100%;
            outline: none;
            border: 1px solid transparent;
            padding: 0 80px 0 15px;
            border-radius: 3px;
            font-size: 15px;
            background: #fff;
            transition: all 0.3s ease;
        }
        .typing-field .input-data input:focus {
            border-color: rgba(0, 123, 255, 0.8);
        }
        .input-data input::placeholder {
            color: #999999;
            transition: all 0.3s ease;
        }
        .input-data input:focus::placeholder {
            color: #bfbfbf;
        }
        .wrapper .typing-field .input-data button {
            position: absolute;
            right: 5px;
            top: 50%;
            height: 30px;
            width: 65px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            outline: none;
            opacity: 0;
            pointer-events: none;
            border-radius: 3px;
            background: #007bff;
            border: 1px solid #007bff;
            transform: translateY(-50%);
            transition: all 0.3s ease;
        }
        .wrapper .typing-field .input-data input:valid ~ button {
            opacity: 1;
            pointer-events: auto;
        }
        .typing-field .input-data button:hover {
            background: #006fef;
        }
        .horizontal-menu {
            display: flex;
            justify-content: space-between; /* Adjust as needed */
            align-items: center;
        }

        .horizontal-menu ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .horizontal-menu li {
            display: inline;
        }

        .horizontal-menu a {
            color: grey;
            text-decoration: none;
        }

        /* Loading Animation */
        .loading {
            display: flex;
            align-items: center;
        }

        .loading .dots {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #007bff;
            margin: 0 2px;
            animation: blink 1.4s infinite both;
        }

        .loading .dots:nth-child(2) {
            animation-delay: 0.2s;
        }

        .loading .dots:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes blink {
            0%, 80%, 100% {
                opacity: 0;
            }
            40% {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="navbar fixed-top"> <!-- Added fixed-top class -->
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="pages/about.html">About</a></li>
            <li><a href="pages/contact.html">Contact</a></li>
            <li><a href="login.html">Login</a></li> <!-- Updated link to point to login.html -->
        </ul>
    </div>
    <div class="row"> <!-- Removed margin top -->
        <div class="col">
            <div class="wrapper">
                <div class="title">KCT E-Ask</div>
                
                <div class="form">
                    <div class="bot-inbox inbox">
                        <div class="icon"></div>
                        <div class="msg-header">
                            <p>Hello there, how can I help you?</p>
                        </div>
                    </div>
                </div>
                <div class="typing-field">
                    <div class="input-data">
                        <input id="data" type="text" placeholder="Type something here.." required>
                        <button id="send-btn">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popup Trigger Button -->
<button id="open-popup" class="btn btn-primary fixed-icon"><i class="fas fa-envelope"></i> ?</button>

<!-- Popup Overlay -->
<div class="popup-overlay"></div>

<!-- Popup Form -->
<div class="popup">
    <span class="close-btn">&times;</span>
    <form id="user-info-form">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="query" class="form-label">Your Query</label>
            <textarea class="form-control" id="query" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    $(document).ready(function(){
        $("#send-btn").on("click", function(){
            let value = $("#data").val();
            let userMsg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ value +'</p></div></div>';
            let loadingDots = '<div class="bot-inbox inbox loading"><div class="icon"></div><div class="msg-header"><div class="dots"></div><div class="dots"></div><div class="dots"></div></div></div>';
            $(".form").append(userMsg).append(loadingDots);
            $("#data").val('');

            $(".form").scrollTop($(".form")[0].scrollHeight);

            // Start AJAX code
            $.ajax({
                url: 'message.php',
                type: 'POST',
                data: 'text='+value,
                success: function(result){
                    setTimeout(function() {
                        $(".loading").remove();
                        let reply = '<div class="bot-inbox inbox"><div class="icon"></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                        $(".form").append(reply);
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }, 2000); // 2 seconds delay
                }
            });
        });

        $("#user-info-form").submit(function(event) {
            event.preventDefault();
            var email = $("#email").val();
            var query = $("#query").val();
            $.ajax({
                url: 'submit_query.php',
                type: 'POST',
                data: { email: email, query: query },
                success: function(response) {
                    // You can add any success message or handle the response as required
                    alert("Query submitted successfully!");
                    // Clear the form fields
                    $("#email").val('');
                    $("#query").val('');
                    // Close the popup
                    $(".popup-overlay, .popup").fadeOut();
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });

        // Open Popup
        $("#open-popup").on("click", function() {
            $(".popup-overlay, .popup").fadeIn();
        });

        // Close Popup
        $(".close-btn, .popup-overlay").on("click", function() {
            $(".popup-overlay, .popup").fadeOut();
        });
    });
</script>
<script>
window.embeddedChatbotConfig = {
chatbotId: "88AF4Z9Q0eGFEPm1JffBl",
domain: "www.chatbase.co"
}
</script>
<script
src="https://www.chatbase.co/embed.min.js"
chatbotId="88AF4Z9Q0eGFEPm1JffBl"
domain="www.chatbase.co"
defer>
</script>

</body>
</html>

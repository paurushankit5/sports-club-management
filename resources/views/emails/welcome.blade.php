<!DOCTYPE html>
<html lang="en-US">
<head>
	<style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
        .appname{
        	text-align:center;
        	font-size:24px;
        	background-color:grey;
        	padding: 20px;
        	color:white;
        }
        body{
        	font-family: Georgia, serif
        }
        .link{
        	background-color: #3490dc;
        	padding: 8px 10px;
        	color:white !important;
        	text-decoration: none;
        	border-radius: 3px;

        }
        .link-div{
        	display: flex;
        	justify-content: center;
        }
    </style>
</head>
<body>

<div class="appname"><strong>{{ env('APP_NAME') }}</strong></div>
<br>
<div>Hi <strong>{{ $name }}</strong></div>

<p>You have been registered to {{ env('APP_NAME') }}. Please reset your password to gain access to the account. To reset your Password</p>
<div class="link-div">
	<a href="{{ env('APP_URL') }}/password/reset" class="link">Click Here</a>
</div>
<br>
<hr>
<br>
<p>If you find an issue clicking on the button above, please copy the url and paste it on browser. </p>
<p>{{ env('APP_URL') }}/password/reset</p>







</body>
</html>





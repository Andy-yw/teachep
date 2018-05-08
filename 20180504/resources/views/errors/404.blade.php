<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404页面</title>
    <style>
        #box{
            margin: 0 auto;
            width: 540px;
            height: 540px;
        }
        p{
            margin-bottom: 60px;
            width: 540px;
            height: 20px;
            text-align: center;
            line-height: 20px;
        }
        #mes{
            font-size: 30px;
            color: red;
        }
        .hint{
            color: #999;
        }
        a{
            color: #259AEA;
        }
    </style>
    <script>
        var i = 5;
        var intervalid;
        intervalid = setInterval("fun()", 1000);
        function fun() {
            if (i == 0) {
                window.location.href = "/";
                clearInterval(intervalid);
            }
            document.getElementById("mes").innerHTML = i;
            i--;
        }
    </script>
</head>
<body>
<div id="box" style="text-align:center;">
    <img src="{{ asset('images/home/404.jpg') }}" alt="404" >

</div>
</body>
</html>

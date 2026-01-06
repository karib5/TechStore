<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ajax Example</title>
</head>
<body>
        <h1 id="head"> Ajax Exmaple </h1>
        <form>
            Username: <input type="text" id="username" name="Username" value=""/>
            <input type="button" name="submit" value="submit" onclick="ajax()" /> 
        </form>


        <script>
            function ajax(){
                let Username = document.getElementById('username').value;
                let xhttp = new XMLHttpRequest();
                //xhttp.open('GET', 'upload.php?username='+Username, true);
                xhttp.open('POST', 'upload.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('username='+Username);
                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        //alert(this.responseText);
                        document.getElementById('head').innerHTML = this.responseText;
                    }
                }
            }
        </script>
</body>
</html>
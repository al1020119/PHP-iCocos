
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script type="text/javascript" src='jquery.min.js'></script>
</head>
<body>
<form id="myForm">
 <input type="text" name="picName"/>
 <input id="file" type="file" name="file"/>
 <input type="submit" name="submit">
 <input id="token" name="token" type="hidden" />
</form>
</body>
</html>
<script type="text/javascript">
  $("#myForm").submit(function(){
     var fm = document.getElementsByTagName('form')[0];
     var formData = new FormData(fm);
     var xhr = new XMLHttpRequest();
     xhr.onreadystatechange = function(){
      if(xhr.readyState == 4){
        alert(xhr.responseText);
      }
     
     } 
     xhr.open('post','./ajax.php');
    xhr.send(formData);
  })

</script>
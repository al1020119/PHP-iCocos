
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script type="text/javascript" src='jquery.min.js'></script>
</head>
<body>
<div id="file_upload"></div>
</body>
</html>
<script type="text/javascript">
$(function() { 
  $("#file_upload").uploadify({ 
      auto: true, 
      method: "Post", 
      width: 120, 
      height: 30, 
      swf: './uploadify.swf', 
      uploader: 'http://uploadUrl', 
      formData: { 
          token: $("#token").val() 
      }, 
      fileObjName: "file", 
      onUploadSuccess: function(file, data, response){ 
          // 根据返回结果指定界面操作 
      } 
  }); 
});
</script>
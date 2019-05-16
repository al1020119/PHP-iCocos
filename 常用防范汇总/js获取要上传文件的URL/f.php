 <?php
 $("input[name='pic_card2']").change(function(event){
            var file=document.getElementById("pic_card2")
                var src = window.URL.createObjectURL(file.files[0]);//获取所选文件的在线临时URL                                    
                $(".btn_up").attr("src",src);
                //window.URL.revokeObjectURL(src);//清除临时URL
        });           
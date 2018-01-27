$(document).ready(function() {
     var dropbox;
     var oprand = {
         dragClass: "active",
         on: {
             load: function(e, file) {
                 // check file type
                 var imageType = /image.*/;
                 if (!file.type.match(imageType)) {
                     alert("File \"" + file.name + "\" is not a valid image file");
                     return false;
                 }

                 // check file size
                 if (parseInt(file.size / 1024) > 2050) {
                     alert("File \"" + file.name + "\" is too big.Max allowed size is 2 MB.");
                     return false;
                 }

                 create_box(e, file);
             },
         }
     };

     FileReaderJS.setupDrop(document.getElementById('dropbox'), oprand);

 });

 create_box = function(e, file) {
     var rand = Math.floor((Math.random() * 100000) + 3);
     var imgName = file.name; // not used, Irand just in case if user wanrand to print it.
     var src = e.target.result;

     var template = '<div class="eachImage" id="' + rand + '" main="eachImage_' + rand + '">';
     template += '<span class="preview" id="' + rand + '"><img id="img_' + rand + '" src="' + src + '"><span class="overlay"><span class="updone"></span></span>';
     template += '</span>';
     template += '<div class="progress" id="' + rand + '"><span></span></div>';
     template += '<div id="master_' + rand + '"></div>Choose to make it main image';

     if ($("#dropbox .eachImage").html() == null)
         $("#dropbox").html(template);
     else
         $("#dropbox").append(template);

     upload(file, rand);
 }

 upload = function(file, rand) {
     // now upload the file
     var xhr = new Array();
     xhr[rand] = new XMLHttpRequest();
     xhr[rand].open("post", site_url+'admin/'+"ajax_fileupload", true);

     xhr[rand].upload.addEventListener("progress", function(event) {
         console.log(event);
         if (event.lengthComputable) {
             $(".progress[id='" + rand + "'] span").css("width", (event.loaded / event.total) * 100 + "%");
             $(".preview[id='" + rand + "'] .updone").html(((event.loaded / event.total) * 100).toFixed(2) + "%");
         } else {
             alert("Failed to compute file upload length");
         }
     }, false);

     xhr[rand].onreadystatechange = function(oEvent) {
         if (xhr[rand].readyState === 4) {
             if (xhr[rand].status === 200) {
                 $(".progress[id='" + rand + "'] span").css("width", "100%");
                 $(".preview[id='" + rand + "']").find(".updone").html("100%");
                 $(".preview[id='" + rand + "'] .overlay").css("display", "none");
                 var img_name = atob(xhr[rand].responseText);
                 console.log(xhr[rand].responseText);
                 var input = document.createElement("input");
                 input.type = "radio";
                 input.value = img_name; // set the CSS class
                 input.name = "img_master";
                 container = document.getElementById('master_' + rand);
                 container.appendChild(input);
                 var image_title = document.getElementById('image_name').value;
                 if (image_title != "") {
                     document.getElementById('image_name').value = image_title + ',' + img_name;

                 } else {
                     document.getElementById('image_name').value = img_name;
                 }
             } else {
                 alert("Error : Unexpected error while uploading file");
             }
         }
     };

     // Set headers
     xhr[rand].setRequestHeader("Content-Type", "multipart/form-data");
     xhr[rand].setRequestHeader("X-File-Name", file.fileName);
     xhr[rand].setRequestHeader("X-File-Size", file.fileSize);
     xhr[rand].setRequestHeader("X-File-Type", file.type);
     xhr[rand].send(file);
 }
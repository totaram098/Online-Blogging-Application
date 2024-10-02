function check_email(obj,role){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.responseText == "true") {
                document.getElementById('submit_button').disabled = true;
                document.getElementById('email_msg').innerHTML = "This Email Is Already Registered..!";
            }else{
                document.getElementById('submit_button').disabled = false;
                document.getElementById('email_msg').innerHTML = "";
            }
        }
    }
    if (role == 'Admin') {
        xhr.open("GET","../assets/common-pages/email_check.php?email="+(obj.value));
    }else{
        xhr.open("GET","assets/common-pages/email_check.php?email="+(obj.value));
    }
    xhr.send();
}
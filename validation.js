$(document).ready(function () {

    jQuery.validator.addMethod("emailExt", function(value, element, param) {
        return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
    });

    jQuery.validator.addMethod("phoneExt", function(value, element, param) {
        return value.match(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/);
    });

    $("#form").validate({

        errorPlacement: function(error, element) {
            if (element.attr('type') == 'radio' || element.attr('type') == 'checkbox') {
                error.appendTo(element.closest('.form-group'));
            } else {
                error.insertAfter(element);
            }
        },
        
        rules: {
            name : {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                emailExt: true
            },
            phone: {
                required: true,
                phoneExt: true
            },
            city: {
                required: true
            },
            gender: {
                required: true
            },
            'hobbies[]': {
                required: true
            },
            address: {
                required: true
            },
            uploadfile: {
                required: true, 
                extension: "jpg|jpeg|png|gif"          
            }
        },
        
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Name should be at least 3 characters"
            },
        
            email: {
                required: "Please enter your mail Id",
                emailExt: "The email should be in the format: abc@domain.tld"
            },
        
            phone: {
                required: "Please enter your mobile no.",
                phoneExt: "Enter valid phone number"
            },

            city: {
                required: "Enter your preferred city"
            },
            gender: {
                required: "Please select your gender"
            },

            'hobbies[]': {
                required: "Please select atleast one"
            },
        
            address: {
                required: "Please enter your address"
            },

            uploadfile: {
                required: "Please upload an image",
                extension: "Please select an image format"
            }
        }
    });

    $(document).on('click','#submit', function(e){  
        
        ($("#form").valid()) 
        
        if($("#form").valid()){   
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", "", true)
            xmlhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200)
                {
                    document.getElementById("form_success").innerHTML = this.responseText;
                }
            }
            var form = document.getElementById("form");
            var formData = new FormData(form);

            xmlhttp.send(formData);
           
            e.preventDefault();
            document.getElementById("form").reset(); 
        }
    });

});  
 
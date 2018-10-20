
$(document).ready(function(){


    $("#new_pwd").click(function () {
       var current_pwd=$("#current_pwd").val();
       $.ajax({
           type:'get',
           url:'/admin/check_pwd',
           data:{current_pwd:current_pwd},
           success(resp){
               if(resp=="false"){
                   $("#check_pwd").html("<font color='red'>Веденный пароль не коректен</font>")
               }
               else if(resp=="true"){
                   $("#check_pwd").html("<font color='green'>OK</font>")
               }
           },
           error:function () {
               alert("Error");
           },



       })

    });


	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
    $("#add_validate").validate({
        rules:{
            name:{
                required:true
            },
            description:{
                required:true,

            },

            url:{
                required:true,
                url: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });
	
	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#password_validate").validate({
		rules:{
            current_pwd:{
                required: true,
                minlength:6,
                maxlength:20
            },
			new_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			confirm_pwd :{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

//** validation for add_product form   **
    $("#add_product").validate({
        rules:{
            product_name :{
                required: true,

                maxlength:20
            },
            description:{
                required: true,

            },
            category_id : {
                required: true,

            },
				price :{
                    required:true,


            },
            code :{
                required:true,

			},

            color :{
                required:true,

            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

   /* $(".delete_product").click(function () {
        if(confirm('Вы точно хотите удалить данную категорию ?')){
            return true;
        }
        return false;
    });

*/

$(document).on('click','.deleteRecord',function (e) {

	var  id=$(this).attr('rel');

	swal(

		{
			title:"Вы уверены что хотите удалить?",
			text:"Вы можите отменить процесс удаления",
			type: "warning",
			showCancelButton:true,
            cancelButtonText:"Отменить",
			confirmButtonClass:"btn-danger",
			confirmButtonText:"Удалить!"
		}
,
		function () {
        window.location.href="/admin/delete-product/"+id;
        }

		)
return false;
});

//Alert for category
    $(document).on('click','.delete_Category',function (e) {

        var  id=$(this).attr('rel');

        swal(

            {
                title:"Вы уверены что хотите удалить?",
                text:"Вы можите отменить процесс удаления",
                type: "warning",
                showCancelButton:true,
                cancelButtonText:"Отменить",
                confirmButtonClass:"btn-danger",
                confirmButtonText:"Удалить!"
            }
            ,
            function () {
                window.location.href="/admin/delete-category/"+id;
            }

        )
        return false;
    });


    //Alert for Attribute
    $(document).on('click','.delete_Attribute',function (e) {

        var  id=$(this).attr('rel');

        swal(

            {
                title:"Вы уверены что хотите удалить?",
                text:"Вы можите отменить процесс удаления",
                type: "warning",
                showCancelButton:true,
                cancelButtonText:"Отменить",
                confirmButtonClass:"btn-danger",
                confirmButtonText:"Удалить!"
            }
            ,
            function () {
                window.location.href="/admin/delete-attributes/"+id;
            }

        )
        return false;
    });




    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input type="text" name="sku[]" id="sku" placeholder="SKU" style="width: 120px" required/>  <select  name="size[]" id="size" placeholder="SIZE" style="width: 120px" required  > <option>Small</option> <option>Medium</option><option>Large</option></select>                 <input type="text" name="price[]" id="price" placeholder="PRICE" style="width: 120px" required/> <input type="text" name="stock[]" id="stock" placeholder="STOCK" style="width: 120px" required/>  <a href="javascript:void(0);" class="remove_button"><a href="javascript:void(0);" class="remove_button">' +
            '<img width="20px" height="20px" src="/img/icons/remove.png"/></a></div>'; //New input field html
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });



});

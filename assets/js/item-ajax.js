var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;


manageData();

$('#submitbtn').removeAttr('disabled');
/* manage data list */
function manageData() {
   $.ajax({
      dataType: 'json',
      url: url,
      data: {page:page}
    }).done(function(data){


       total_page = data.total % 5;
       current_page = page;


       $('#pagination').twbsPagination({
            totalPages: total_page,
            visiblePages: current_page,
            onPageClick: function (event, pageL) {


                page = pageL;


                if(is_ajax_fire != 0){
                   getPageData();
                }
            }
        });


        manageRow(data.data);


        is_ajax_fire = 1;


   });
}


/* Get Page Data*/
function getPageData() {


    $.ajax({
       dataType: 'json',
       url: url,
       data: {page:page}
	}).done(function(data){


       manageRow(data.data);


    });


}


/* Add new Item table row */
function manageRow(data) {


    var	rows = '';


    $.each( data, function( key, value ) {


        rows = rows + '<tr>';
        rows = rows + '<td>'+value.product_name+'</td>';
        rows = rows + '<td>'+value.product_price+'</td>';
        rows = rows + '<td data-id="'+value.id+'">';
        rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';
        rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
        rows = rows + '</td>';
        rows = rows + '</tr>';


    });


    $("#grid").html(rows);


}


/* Create new Item */
$('#saveform').on('submit', function(e){
    e.preventDefault(); 
    var form_action = $("#create-item").find("form").attr("action");
   var name = $('#name').val();
        var dob = $('#dob').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var department_id = $('#department_id').val();
        var salary = $('#salary').val();
        var status = $('#status').val();

        var data = new FormData(this);
      data.append('name', name);
      data.append('dob', dob);
      data.append('phone', phone);
      data.append('email', email);
      data.append('department_id', department_id);
      data.append('salary', salary);
      data.append('status', status);
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_action,
        processData:false,
             contentType:false,
             cache:false,
             async:true,
        data:data
    }).done(function(data){


        getPageData();
        $(".modal").modal('hide');
        toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000});


    });


});


/* Remove Item */
$("body").on("click",".remove-item",function(){
    if(confirm("Are you sure you want to delete this?")){
        var id = $(this).data('id');
        var c_obj = $(this).parent("div");


        $.ajax({
            dataType: 'json',
            type:'delete',
            url: url + '/delete/' + id,
        }).done(function(data){


            c_obj.remove();
            toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 2000});
            getPageData();


        });
    }
    else{
        return false;
    }

    


});
$("body").on("click",".create-item",function(){
    $("#create-item").find("form").attr("action",url + '/store/');
    $("#saveform").trigger( "reset" );
    $("#image").hide();
    //$('#photo').addAttr('required');
});

/* Edit Item */
$("body").on("click",".edit-item",function(){
    //$('#photo').removeAttr('required');
    $('#submitbtn').removeAttr('disabled');
    $("#image").show();
    var id = $(this).data('id');
    $.ajax({
        dataType: 'json',
        type : "POST",
        url: url + '/edit/' + id,
    }).done(function(data){

        console.log(data);
        $("#name").val(data.name);
        $("#dob").val(data.dob);
        $("#phone").val(data.phone);
        $("#email").val(data.email);
        $("#salary").val(data.salary);
        $("#department_id").val(data.department_id).attr('selected','selected');
        $("#status").val(data.status).attr('selected','selected');
        $("#image").attr("src",baseurl+"upload/"+data.photo);
        $("#old_photo").val(data.photo);
        //c_obj.remove();
        //toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 2000});
        getPageData();


    });
    $("#create-item").find("form").attr("action",url + '/update/' + id);


});


/* Updated new Item */
$(".crud-submit-edit").click(function(e){


    e.preventDefault();


    var form_action = $("#create-item").find("form").attr("action");
   var name = $('#name').val();
        var dob = $('#dob').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var department_id = $('#department_id').val();
        var salary = $('#salary').val();
        var status = $('#status').val();

        var data = new FormData(this);
      data.append('name', name);
      data.append('dob', dob);
      data.append('phone', phone);
      data.append('email', email);
      data.append('department_id', department_id);
      data.append('salary', salary);
      data.append('status', status);
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_action,
        processData:false,
             contentType:false,
             cache:false,
             async:true,
        data:data
    }).done(function(data){


        getPageData();
        $(".modal").modal('hide');
        toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 2000});


    });


});
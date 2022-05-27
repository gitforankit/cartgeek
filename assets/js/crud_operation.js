$(document).ready(function(){
	listEmployee();		
	var table = $('#employeeListing').dataTable({     
		"bPaginate": false,
		"bInfo": false,
		"bFilter": false,
		"bLengthChange": false,
		"pageLength": 5		
	}); 
	// list all employee in datatable
	function listEmployee(){
		$.ajax({
			type  : 'ajax',
			url   : 'products/show',
			async : false,
			dataType : 'json',
			success : function(data){

				var html = '';
				var imgs = '';
				var i;
				for(i=0; i<data.length; i++){
					//console.log(data[i].product_image);	
					if (data[i].product_image != null) {
						var myArray = data[i].product_image.split(',');
						for(j=0; j<myArray.length; j++){
							imgs +='<img src="upload/'+myArray[j]+'" width="80" height="80" class="img-thumbnail" />'
						}
					}

					html += '<tr id="'+data[i].id+'">'+
							'<td>'+data[i].id+'</td>'+
							'<td>'+data[i].product_name+'</td>'+
							'<td>'+data[i].product_price+'</td>'+
							'<td>'+imgs+'</td>'+	
							'<td style="text-align:right;">'+
								'<a href="javascript:void(0);" class="btn btn-info btn-sm editRecord" data-id="'+data[i].id+'" data-product_name="'+data[i].product_name+'" data-product_price="'+data[i].product_price+'" data-product_desccription="'+data[i].product_desccription+'" data-product_image="'+data[i].product_image+'"">Edit</a>'+' '+
								'<a href="javascript:void(0);" class="btn btn-danger btn-sm deleteRecord" data-id="'+data[i].id+'">Delete</a>'+
							'</td>'+
							'</tr>';
					imgs = '';
				}
				$('#listRecords').html(html);					
			}

		});
	}
	// save new employee record
	$('#saveEmpForm').on('submit', function(e){
            e.preventDefault(); 
		var product_name = $('#product_name').val();
		var product_price = $('#product_price').val();
		var product_desccription = $('#product_desccription').val();

		var data = new FormData(this);
      data.append('product_name', product_name);
      data.append('product_price', product_price);
      data.append('product_desccription', product_desccription);
		$.ajax({
			type : "POST",
			url  : "products/save",
			processData:false,
	         contentType:false,
	         cache:false,
	         async:true,
			data : data,
			success: function(res){
				$('#product_name').val("");
				$('#product_price').val("");
				$('#product_desccription').val("");
				$('#product_image').val("");
				$('#addEmpModal').modal('hide');
				listEmployee();
			}
		});
		return false;
	});
	// show edit modal form with emp data
	$('#listRecords').on('click','.editRecord',function(){
		$('#editEmpModal').modal('show');
		$("#productID").val($(this).data('id'));
		$("#edit_name").val($(this).data('product_name'));
		$("#edit_price").val($(this).data('product_price'));
		$("#edit_desccription").val($(this).data('product_desccription'));
		$("#old_image").val($(this).data('product_image'));
	});
	// save edit record
	 $('#editEmpForm').on('submit',function(e){
		 e.preventDefault(); 
		 var data = new FormData(this);
		var productID = $('#productID').val();
		var product_name = $('#edit_name').val();
		var product_price = $('#edit_price').val();
		var product_desccription = $('#edit_desccription').val();
		console.log($('#edit_image').get(0).files.length);
		if ($('#edit_image').get(0).files.length === 0) {
			data.append('edit_image', $('#edit_image').get(0).files.length);
		}
		else{
			data.append('edit_image', $('#edit_image').get(0).files.length);
		}
		//return false;
		
      data.append('id', productID);
      data.append('product_name', product_name);
      data.append('product_price', product_price);
      data.append('product_desccription', product_desccription);
		$.ajax({
			type : "POST",
			url  : "products/update",
			processData:false,
	         contentType:false,
	         cache:false,
	         async:true,
			data : data,
			success: function(res){
				$('#productID').val("");
				$('#edit_name').val("");
				$('#edit_price').val("");
				$('#edit_desccription').val("");
				$('#editEmpModal').modal('hide');
				listEmployee();
			}
		});
		return false;
	});
	// show delete form
	$('#listRecords').on('click','.deleteRecord',function(){
		var empId = $(this).data('id');            
		$('#deleteEmpModal').modal('show');
		$('#deleteEmpId').val(empId);
	});
	// delete emp record
	 $('#deleteEmpForm').on('submit',function(){
		var empId = $('#deleteEmpId').val();
		$.ajax({
			type : "POST",
			url  : "products/delete",
			dataType : "JSON",  
			data : {id:empId},
			success: function(data){
				$("#"+empId).remove();
				$('#deleteEmpId').val("");
				$('#deleteEmpModal').modal('hide');
				listEmployee();
			}
		});
		return false;
	});
});
<!DOCTYPE html>
<html>
<head>
	<title>Employee List</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css">
	<style type="text/css">
	#grid img.img-thumbnail {
    	width: 100px;
	    height: 100px;
	}
	div#grid {
	    text-align: center;
	}
	.items{
		background: #ccc;
    	margin: 5px;
    	padding: 10px;
	}
	.items p {
	    margin: 0;
	}
	</style>
</head>
<body>

<p style="margin: 50px;"></p>
<div class="container">


<div class="row">
  	<div class="col-lg-12 margin-tb">
  	  <div class="pull-left">
  	    <h2>Employee List</h2>
  	  </div>
  	  <div class="pull-right">
  	    <button type="button" class="btn btn-success create-item" data-toggle="modal" data-target="#create-item">Add New</button>
  	  </div>
  	</div>
</div>



<table class="table table-bordered">


	<thead>
	    <tr>
		      <th>Product</th>
		      <th>Price</th>
		      <th width="200px">Action</th>
	    </tr>
	</thead>


	<tbody>
	</tbody>


</table>


<ul id="pagination" class="pagination-sm"></ul>


</div>


<!-- Create Item Modal -->
<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">


  <div class="modal-dialog" role="document">
    <div class="modal-content">


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Employee</h4>
      </div>

      <!-- <form data-toggle="validator" action="items/store" method="POST" id="saveform"> -->
      <form action="items/store" method="POST" id="saveform">
      <div class="modal-body">


            


                <div class="form-group row">
					<label class="col-md-2 col-form-label">Name*</label>
					<div class="col-md-10">
					  <input type="text" name="name" id="name" class="form-control" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-2 col-form-label">DOB*</label>
					<div class="col-md-10">
					  <input type="date" name="dob" id="dob" class="form-control" required> 
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-2 col-form-label">Phone*</label>
					<div class="col-md-10">
					  <input type="text" name="phone" id="phone" class="form-control" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-2 col-form-label">Photo*</label>
					<div class="col-md-10">
					  <input type="file" name="photo" id="photo" required>
					  <input type="hidden" name="old_photo" id="old_photo" >
					  <img id="image" src="" width="100" height="100" class="img-thumbnail" />
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-2 col-form-label">Email*</label>
					<div class="col-md-10">
					  <input type="text" name="email" id="email" class="form-control" required>
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-md-2 col-form-label">Salary*</label>
					<div class="col-md-10">
					  <input type="text" name="salary" id="salary" class="form-control" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-2 col-form-label">Status*</label>
					<div class="col-md-10">
					  <select name="status" id="status" class="form-control" required>
					  	<option value="">Select Status</option>
					  	<option value="1">Active</option>
					  	<option value="0">Inactive</option>
					  </select>
					</div>
				</div>


            


      </div>
      <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button id="submitbtn" type="submit" class="btn btn-primary">Save</button>
		  </div>
		</form>
    </div>
  </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">


<script type="text/javascript">
	var url = "items";
	var baseurl = "<?php echo base_url() ?>";
</script>


<script src="<?php echo base_url('assets') ?>/js/item-ajax.js"></script> 


</body>
</html>
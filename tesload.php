<?php
require_once "model/konek.php";
require_once "model/add.php";
require_once "model/del.php";
require_once "model/edit.php";
require_once "model/load.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/lokal.css">
<script>
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
</script>
</head>
<body>
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>K 	elola <b>Mata Kuliah</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Tambah Matkul</span></a>
						<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>Nama</th>
						<th>SKS</th>
						<th>Jurusan</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($arrdb as $entri)
						{
						
					?>
					<tr>
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="options[]" value="1">
								<label for="checkbox1"></label>
							</span>
						</td>
						<td><?=$entri['nama']?></td>
						<td><?=$entri['SKS']?></td>
						<td><?=isset($entri['Jurusan'])?$entri['Jurusan']:"&nbsp;"?></td>
						<td>
							<a href="#editEmployeeModal" class="edit" data-toggle="modal" data-nama="<?=$entri['nama']?>" data-sks="<?=$entri['SKS']?>" data-jurusan="<?=(isset($entri['Jurusan']))?$entri['Jurusan']:""?>" data-val="<?=$entri['_id']?>" ><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#deleteEmployeeModal" class="delete" data-toggle="modal" data-nama="<?=$entri['nama']?>" data-val="<?=$entri['_id']?>" ><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
						</td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Showing <b><?=($jmlhasil>5)?"5":$jmlhasil?></b> out of <b><?=$jmlhasil?></b> entries</div>
				<ul class="pagination">
					<li class="page-item disabled"><a href="#" class="page-link btn disabled">Previous</a></li>
					<li class="page-item active"><a href="#" class="page-link">1</a></li>
					<li class="page-item"><a href="#" class="page-link btn disabled">2</a></li>
					<li class="page-item"><a href="#" class="page-link btn disabled">3</a></li>
					<li class="page-item"><a href="#" class="page-link btn disabled">4</a></li>
					<li class="page-item"><a href="#" class="page-link btn disabled">5</a></li>
					<li class="page-item"><a href="#" class="page-link btn disabled">Next</a></li>
				</ul>
			</div>
		</div>
	</div>        
</div>
<!-- Add Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?=$_SERVER["PHP_SELF"]?>?pg=<?=$pgMulai?>&ofset=<?=$pgOffset?>" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Tambah Mata Kuliah</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" required name="txtnama">
					</div>
					<div class="form-group">
						<label>SKS</label>
						<input type="text" class="form-control" required name="txtsks">
					</div>
					<div class="form-group">
						<label>Jurusan</label>
						<textarea class="form-control" name="txtjurusan"></textarea>
					</div>				
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add" name="btnAdd">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="<?=$_SERVER["PHP_SELF"]?>">
				<div class="modal-header">						
					<h4 class="modal-title">Edit Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" required id="ideditnama" name="txtnama">
					</div>
					<div class="form-group">
						<label>SKS</label>
						<input type="text" class="form-control" required id="ideditsks" name="txtsks">
					</div>
					<div class="form-group">
						<label>Jurusan</label>
						<input type="text" class="form-control" required id="ideditjurusan" name="txtjurusan">
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" value="Save" name="btnEdit">
					<input type="hidden" id="hidetxtid" name="txtId">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POSt" action="<?=$_SERVER["PHP_SELF"]?>" id="frmHapus">
				<div class="modal-header">						
					<h4 class="modal-title">Delete Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Are you sure you want to delete <font color=red class=coba></font>?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete" name="btnDel">
					<input type="hidden" id="sembunyi" name="txtId">
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$('#editEmployeeModal').on('show.bs.modal', function (event) {
		var myVal = $(event.relatedTarget).data('nama');
		
		$(this).find("#ideditnama").val(myVal);
		myVal = $(event.relatedTarget).data('sks');
		$(this).find("#ideditsks").val(myVal);
		myVal = $(event.relatedTarget).data('jurusan');
		$(this).find("#ideditjurusan").val(myVal);
		myVal = $(event.relatedTarget).data('val');
		$(this).find("#hidetxtid").val(myVal);
	});

	$('#deleteEmployeeModal').on('show.bs.modal', function (event) {
		var myVal = $(event.relatedTarget).data('nama');
		$(this).find(".coba").text(myVal);
		myVal = $(event.relatedTarget).data('val');
		$(this).find("#sembunyi").val(myVal);
	});
    </script>
</body>
</html>
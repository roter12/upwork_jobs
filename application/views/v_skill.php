<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">Skill</h2>
  </div>
</header>
<div class="container-fluid">
<div class="table-agile-info">
		<?php if ($this->session->userdata('level')=="admin"): {
			
		}  ?>
			
		<?php if ($this->session->flashdata('message')!=null) {
			echo "<br><div class='alert alert-success alert-dismissible fade show' role='alert'>"
			.$this->session->flashdata('message')."<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			<span aria-hidden='true'>&times;</span>
			</button> </div>";
		} ?>
			<?php elseif ($this->session->userdata('level')=="cashier"): {
				
			} ?>
		<?php endif  ?>
		<div class="card rounded-0 mt-10">
			<div class="card-header row">
				<div class="form-group col-2">
					<input type="date" id="sdate" class="form-control" onfocusout="on_search()">
				</div>
				<div class="form-group col-2">
					<input type="date" id="edate" class="form-control" onfocusout="on_search()">
				</div>
				<div class="col-2">
					<button type="submit" class="btn btn-primary" onclick="on_search()"><i class="fa fa-search"></i> Search</button>
				</div>
			</div>
			<div class="card-body">
				<table class="table table-hover table-bordered" id="example" ui-options=ui-options="{
						&quot;paging&quot;: {
						&quot;enabled&quot;: true
						},
						&quot;filtering&quot;: {
						&quot;enabled&quot;: true
						},
						&quot;sorting&quot;: {
						&quot;enabled&quot;: true
						}}">
					<thead style="background-color: #464b58; color:white;">
						<tr>
							<td>#</td>
							<td>Skill</td>
							<td>Price[$]</td>
							<td>Period[M]</td>
							<td>Unit[$/M]</td>
							<td>Bid</td>
						</tr></thead>
						<tbody style="background-color: white;">
						<?php $no=0; foreach ($skill as $kat) : $no++;?>
						<tr style="background-color: rgb(255,255,<?=$no?>)">
							<td><?=$no?></td>
							<td><?=$kat[0]?></td>
							<td><?=number_format(floor($kat[1]))?></td>
							<td><?=number_format(floor($kat[2]))?></td>
							<td><?=$kat[2]?number_format(floor($kat[1]/$kat[2])):'-'?></td>
							<td><?=$kat[3]?></td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>

<div class="modal" id="add">
	<div class="modal-dialog" style="max-width: 90%;">
		<div class="modal-content">
			<div class="modal-header">
				Add New Jobs
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
				<span class="sr-only">Close</span>
				</button>
			</div>
			<form action="<?=base_url('index.php/upwork/add_jobs')?>" method="post">
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-sm-12">
							<textarea name="job_data" required class="form-control" rows=30 autofocus></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-end">
					<input type="submit" name="save" value="Save" class="btn btn-primary btn-sm rounded-0">
					<button type="button" class="btn btn-default btn-sm border rounded-0" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal" id="skill">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				Top Skills
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group row">
					<div class="col-sm-12">
						<table id="skill_tb"></table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="edit">
	<div class="modal-dialog" style="max-width: 90%;">
		<div class="modal-content">
			<div class="modal-header">
				View Job
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
				<span class="sr-only">Close</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group row">
					<div class="col-sm-12">
						<textarea id="job_desc" required class="form-control" rows=30></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		<?php if ($sdate == NULL) { ?>
			document.getElementById('sdate').valueAsDate = new Date();
		<?php } else { ?>
			document.getElementById('sdate').value = "<?=$sdate?>";
		<?php } ?>

		<?php if ($edate == NULL) { ?>
			document.getElementById('edate').valueAsDate = new Date();
		<?php } else { ?>
			document.getElementById('edate').value = "<?=$edate?>";
		<?php } ?>

		$('#example').DataTable({
			"pageLength": <?=count($skill)?>,
			columnDefs: [
				{ targets: 0, className: 'dt-body-right' },
				{ targets: 2, className: 'dt-body-right' },
				{ targets: 3, className: 'dt-body-right' },
				{ targets: 4, className: 'dt-body-right' },
			]
		});
	});

	function on_search() {
		window.location.href = "<?=base_url()?>index.php/upwork/skill/"+$('#sdate').val()+'/'+$('#edate').val();
	}
</script>


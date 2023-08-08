<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">Upwork Jobs</h2>
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
			<div class="card-header">
				<a href="#add" data-toggle="modal" class="btn btn-primary btn-sm rounded-0 pull-right"><i class="fa fa-plus"></i> Jobs</a>
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
							<td>title</td>
							<td>shortDuration</td>
							<td>budget</td>
							<td>proposals</td>
							<td>client</td>
							<td>skills</td>
						</tr></thead>
						<tbody style="background-color: white;">
						<?php $no=0; foreach ($all_job as $kat) : $no++;?>
						<tr>
							<td><?=$no?></td>
							<td><a href="https://www.upwork.com/ab/proposals/job/<?=$kat->ciphertext?>/apply/"><?=$kat->title?></a></td>
							<td><?=$kat->shortDuration?></td>
							<td><?=$kat->type==1?$kat->amount_amount:$kat->hourlyBudgetText?></td>
							<td><?=$kat->proposalsTier?></td>
							<td><?=$kat->client_paymentVerificationStatus?'✅':''?> <?=$kat->client_location_country?><br><?=$kat->client_totalSpent?>-<?=$kat->client_totalFeedback.'/'.$kat->client_totalReviews?></td>
							<td><a href="#edit" onclick="edit('<?=$kat->id?>')" data-toggle="modal"><?=$kat->skills?></a></td>
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
		$('#example').DataTable();
	}
	);
	function edit(a) {
		$.ajax({
			type:"post",
			url:"<?=base_url()?>index.php/upwork/view_job/"+a,
			dataType:"json",
			success:function(data){
				$("#job_desc").val(data.description);
			}
		});
	}
</script>


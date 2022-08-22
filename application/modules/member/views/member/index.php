<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
	<h1> Member  <small>Control panel</small> <?php echo anchor(site_url(Backend_URL . 'member/create'), ' + Add New', 'class="btn btn-default"'); ?> </h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
		<li class="active">Member</li>
	</ol>
</section>
<?php echo $this->session->flashdata('message'); ?>
<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<div class="col-md-3 col-md-offset-9 text-right">
				<form action="<?php echo site_url(Backend_URL . 'member'); ?>" class="form-inline" method="get">
					<div class="input-group">
						<input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
						<span class="input-group-btn">
							<?php if ($q != '') {?>
								<a href="<?php echo site_url(Backend_URL . 'member'); ?>" class="btn btn-default">Reset</a>
							<?php }?>
							<button class="btn btn-primary" type="submit">Search</button>
						</span>
					</div>
				</form>
			</div>
		</div>

		<div class="box-body">
			<?php echo $this->session->flashdata('message'); ?>
			<div class="table-responsive">
				<table class="table table-hover table-condensed">
					<thead>
						<tr>
							<th width="50">ক্রমিক নং</th>
							<th>ইউনিয়ন</th>
							<th>পূর্ববর্তী হোল্ডিং নাম্বার</th>
							<th>বর্তমান হোল্ডিং নাম্বার</th>
							<th>ওয়ার্ড নং</th>
							<th>গ্রাম/মহল্লার নাম</th>
							<th>নাম</th>
							<th>মোবাইল নং</th>
							<th>পিতা/স্বামী</th>
							<th>মাতা</th>
							<th>জন্ম তারিখ</th>
							<th>জাতীয় পরিচয়পত্র/জন্ম নিবন্ধন নং</th>
							<th>সামাজিক সুরক্ষার সুবিধা</th>
							<th>আয়ের উৎস</th>
							<th>খানা সদস্য সংখ্যা</th>
							<th width="200">Action</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($members as $member) {
	?>
							<tr>
								<td><?php echo ++$start ?></td>
								<td><?php echo $member->union_name; ?></td>
								<td><?php echo $member->previous_holding_no; ?></td>
								<td><?php echo $member->present_holding_no; ?></td>
								<td><?php echo $member->word_no; ?></td>
								<td><?php echo $member->village; ?></td>
								<td><?php echo $member->khana_chief_name_ba.' <br/>'.$member->khana_chief_name_en; ?></td>
								<td><?php echo $member->mobile_no; ?></td>
								<td><?php echo $member->father_name; ?></td>
								<td><?php echo $member->mother_name; ?></td>
								<td><?php echo $member->date_of_birth; ?></td>
								<td><?php echo $member->nid; ?></td>
								<td><?php echo $member->ssb_name; ?></td>
								<td><?php echo $member->income_source_name; ?></td>
								<td><?php echo $member->house_members; ?></td>
								<td>
									<?php
										echo anchor(site_url(Backend_URL . 'member/read/' . $member->id), '<i class="fa fa-fw fa-external-link"></i> View', 'class="btn btn-xs btn-primary"');
										echo anchor(site_url(Backend_URL . 'member/update/' . $member->id), '<i class="fa fa-fw fa-edit"></i> Edit', 'class="btn btn-xs btn-warning"');
										echo anchor(site_url(Backend_URL . 'member/delete/' . $member->id), '<i class="fa fa-fw fa-trash"></i> Delete ', 'class="btn btn-xs btn-danger"');
									?>
								</td>
							</tr>
						<?php }?>
					</tbody>
				</table>
			</div>


			<div class="row">
				<div class="col-md-6">
					<span class="btn btn-primary">Total Member: <?php echo $total_rows ?></span>

				</div>
				<div class="col-md-6 text-right">
					<?php echo $pagination ?>
				</div>
			</div>
		</div>
	</div>
</section>
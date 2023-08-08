<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_upwork extends CI_Model {

	public function get_all()
	{
		return $tm_upwork=$this->db
			->select('id,title,shortDuration,type,amount_amount,hourlyBudgetText,proposalsTier,client_paymentVerificationStatus,client_location_country,client_totalSpent,client_totalFeedback,client_totalReviews,skills,ciphertext')
			->order_by('publishedOn','desc')
			->get('upwork_job')
			->result();
	}

	public function save_job($job)
	{
		$old_row=$this->db->select('id')
			->where('uid', $job->uid)
			->limit(1)
			->get('upwork_job')
			->row();

		if ($old_row == null) { // Add new
			return $this->db->insert('upwork_job', $job);			
		} else { // Update job
			return $this->db->where('id', $old_row->id)->update('upwork_job',$job);
		}
	}

	public function detail($a)
	{
		return $this->db->select('description')
						->where('id', $a)
						->get('upwork_job')
						->row();
	}
}

/* End of file M_upwork.php */
/* Location: ./application/models/M_upwork.php */
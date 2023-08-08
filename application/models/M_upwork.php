<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_upwork extends CI_Model {

	public function get_all()
	{
		return $this->db
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

	public function get_skills()
	{
		$money_by_skill = array();

		$month_count = array(
			'1 month' => 1,
			'1-3 months' => 3,
			'3-6 months' => 6,
			'6 months+' => 12
		);
		
		// (max-min)/2 * 6 hours * 22 days = (max-min) * 66
		$all=$this->db
			->select('skills,type,shortDuration,amount_amount,(hourlyBudget_max-hourlyBudget_min)*66 AS month_amount')
			->where("skills IS NOT NULL")
			->get('upwork_job')
			->result();

		foreach ($all as $row) {
			if ($row->type == 2)
				$row->amount_amount = $row->month_amount * $month_count[$row->shortDuration];

			if ($row->skills == '""' || trim($row->skills) == "")
				continue;
			$arr_skill = explode("|", $row->skills);
			$one_amount = $row->amount_amount / count($arr_skill);

			foreach ($arr_skill as $skill) {
				$skill = trim($skill);
				if (array_key_exists($skill, $money_by_skill)) {
					$money_by_skill[$skill] = $money_by_skill[$skill] + $one_amount;
				} else {
					$money_by_skill[$skill] = 0.0 + $one_amount;
				}
			}
		}

		arsort($money_by_skill);
		return $money_by_skill;
	}
}

/* End of file M_upwork.php */
/* Location: ./application/models/M_upwork.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_upwork extends CI_Model {

	public function get_table_data()
	{
		return $this->db
			->select('id,title,shortDuration,type,amount_amount,hourlyBudgetText,proposalsTier,client_paymentVerificationStatus,client_location_country,client_totalSpent,client_totalFeedback,client_totalReviews,skills,ciphertext')
			->order_by('publishedOn','desc')
			->get('upwork_job')
			->result();
	}

	public function save_job($job)
	{
		// Check if exists
		$old_row = $this->db->select('id')
			->where('uid', $job->uid)
			->limit(1)
			->get('upwork_job')
			->row();

		if ($old_row == null) { // Add new
			if (!$this->db->insert('upwork_job', $job))
				return 0;
			return 1;
		} else { // Update job
			if (!$this->db->where('id', $old_row->id)->update('upwork_job',$job))
				return 0;
			return 2;
		}
	}

	public function get_row_cell($row_id, $col_name = 'description')
	{
		return $this->db->select($col_name)
						->where('id', $row_id)
						->get('upwork_job')
						->row();
	}

	public function get_skills_stats($sdate, $edate, $limit_count = -1)
	{
		$money_by_skill = array();
		$month_by_skill = array();
		$bid_by_skill = array();

		$month_count = array( // ^_~ 
			'1 month' => 0.3, // less than month
			'1-3 months' => 3,
			'3-6 months' => 6,
			'6 months+' => 12
		);

		$bid_count = array(
			"Less than 5" => 3,
			"10 to 15" => 13,
			"5 to 10" => 8,
			"15 to 20" => 18,
			"20 to 50" => 35,
			"50+" => 70
		);
		
		if ($sdate != NULL)
			$this->db->where('publishedOn >=', $sdate);
		if ($edate != NULL)
			$this->db->where('publishedOn <=', $edate);

		// ^_~ (min+(max-min)*0.7) * 6 hours * 24 days
		$all = $this->db
			->select('skills,type,shortDuration,amount_amount,proposalsTier,(hourlyBudget_min+(hourlyBudget_max-hourlyBudget_min)*0.7)*144 AS month_amount')
			->where("skills IS NOT NULL")
			->where("shortDuration IS NOT NULL")
			->get('upwork_job')
			->result();

		foreach ($all as $row) {
			if ($row->type == 2) // calc total $ if hourly job
				$row->amount_amount = $row->month_amount * $month_count[$row->shortDuration];

			// get skills array
			if ($row->skills == '""' || trim($row->skills) == "")
				continue;
			$arr_skill = explode("|", $row->skills);
			if (count($arr_skill) > 3)  // ^_~ Only takes front 3 skills.
				$arr_skill = array_slice($arr_skill, 0, 3);

			// $ for one skill
			$one_amount = $row->amount_amount / count($arr_skill); // ^_~
			$one_period = $row->month_amount / count($arr_skill); // ^_~

			foreach ($arr_skill as $skill) {
				$skill = trim($skill);

				// update $money_by_skill
				if (array_key_exists($skill, $money_by_skill))
					$money_by_skill[$skill] = $money_by_skill[$skill] + $one_amount;
				else
					$money_by_skill[$skill] = $one_amount;

				// update $month_by_skill
				if (array_key_exists($skill, $month_by_skill))
					$month_by_skill[$skill] = $month_by_skill[$skill] + $one_period;
				else
					$month_by_skill[$skill] = $one_period;

				// update $month_by_skill
				if (array_key_exists($skill, $bid_by_skill))
					$bid_by_skill[$skill] = $bid_by_skill[$skill] + $bid_count[$row->proposalsTier];
				else
					$bid_by_skill[$skill] = $bid_count[$row->proposalsTier];
			}
		}

		arsort($money_by_skill);

		// create array to return.
		$ret = array();
		foreach ($money_by_skill as $key => $val)
			array_push($ret, array($key, $val, $month_by_skill[$key], $bid_by_skill[$key]));

		// Only take front part by limit.
		if ($limit_count != -1 && count($ret) > $limit_count)
			$ret = array_slice($ret, 0, $limit_count);

		return $ret;
	}
}

/* End of file M_upwork.php */
/* Location: ./application/models/M_upwork.php */
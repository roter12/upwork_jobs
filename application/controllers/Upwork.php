<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upwork extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_upwork','udb');
	}
	public function index()
	{
		$data['all_job']=$this->udb->get_all();
		$data['content']="v_upwork";
		$this->load->view('template', $data);
	}

	public function add_jobs()
	{
		if (!$this->input->post('save'))
			return;

		$json_data=json_decode($this->input->post('job_data'));
		if (!$json_data->searchResults->jobs) {
			$this->session->set_flashdata('message', 'Wrong data for creating Upwork jobs!');
			redirect('upwork','refresh');
			return;
		}

		foreach ($json_data->searchResults->jobs as $job) {
			$job->amount_currencyCode = $job->amount->currencyCode;
			$job->amount_amount = $job->amount->amount;
			$job->client_paymentVerificationStatus = $job->client->paymentVerificationStatus;
			$job->client_location_country = $job->client->location->country;
			$job->client_totalSpent = $job->client->totalSpent;
			$job->client_totalReviews = $job->client->totalReviews;
			$job->client_totalFeedback = $job->client->totalFeedback;
			$job->client_companyRid = $job->client->companyRid;
			$job->client_companyName = $job->client->companyName;
			$job->client_edcUserId = $job->client->edcUserId;
			$job->client_lastContractPlatform = $job->client->lastContractPlatform;
			$job->client_lastContractRid = $job->client->lastContractRid;
			$job->client_lastContractTitle = $job->client->lastContractTitle;
			$job->client_feedbackText = $job->client->feedbackText;
			$job->client_companyOrgUid = $job->client->companyOrgUid;
			$job->client_hasFinancialPrivacy = $job->client->hasFinancialPrivacy;
			$job->occupations_category_uid = $job->occupations->category->uid;
			$job->occupations_category_prefLabel = $job->occupations->category->prefLabel;
			$job->occupations_subcategories_uid = join('|', array_column($job->occupations->subcategories, 'uid'));
			$job->occupations_subcategories_prefLabel = join('|', array_column($job->occupations->subcategories, 'prefLabel'));
			$job->occupations_oservice_uid = $job->occupations->oservice->uid;
			$job->occupations_oservice_prefLabel = $job->occupations->oservice->prefLabel;
			$job->hourlyBudget_type = $job->hourlyBudget->type;
			$job->hourlyBudget_min = $job->hourlyBudget->min;
			$job->hourlyBudget_max = $job->hourlyBudget->max;
			$job->skills = join(' | ', array_column($job->attrs, 'prettyName'));
			$job->prefFreelancerLocation = join('|', $job->prefFreelancerLocation);
			$job->lowdata = json_encode($job);
			if (!$this->udb->save_job($job)) {
				$this->session->set_flashdata('message', 'Failed to add job: '.$job->uid);
				redirect('upwork','refresh');
				return;
			}
		}
		$this->session->set_flashdata('message', 'Upwork jobs have been added successfully');
		redirect('upwork', 'refresh');
	}

	public function view_job($id)
	{
		$data=$this->udb->detail($id);
		echo json_encode($data);
	}

	public function skill_list()
	{
		$data=$this->udb->get_skills();
		$ret['skill'] = array_keys($data);
		$ret['money'] = array_values($data);
		echo json_encode($ret);
	}
}

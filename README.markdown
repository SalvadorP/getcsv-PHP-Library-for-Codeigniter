#Codeigniter library for reading in CSV files

This is a simple PHP library built by Jason Michels, that can be used in Codeigniter to read in CSV files and return them as an associated array.

Currently the way I have built it is you have to send an array to the library telling it the names of the columns you want out of the CSV file.

Example of a basic controllerI created called Csv in Codeigniter 2 used for reading the CSV files and simply printing the result:




<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csv extends CI_Controller {
	
	function sample_read_csv()
	{
		$this->load->library('getcsv');
		
		$data = array('name', 'email', 'id', 'transaction');
		
		$csv_array = $this->getcsv->get_csv_assoc_array("path/to/file.csv", $data);
		print_r($csv_array);
	}
}

/* End of file csv.php */
/* Location: ./application/controllers/csv.php */
#Codeigniter library for reading in CSV files

This is a simple PHP library built by Jason Michels (http://www.thebizztech.com), that can be used in Codeigniter to read in CSV files and return them as an array.

Updated September 2011: I have rebuilt the library to allow you to set the url and then call the function to return the array with the first row being used for the titles.  Keep in mind since the first row is being used as the titles, if there are columns without a title they will be excluded from the returned array

Note: You can still use it the other way where you pass in an array of questions and an array with those questions will be returned.  This is good if you want to only extract data for specific questions.

Changelog:
1. Abstracted out some of the PHP code that reads the file so it can more easily be used for multiple types of functions.
2. Added "get_array()" function
3. (February 2013) Now you can pass an array with the names of the csv fields. The array and the csv must have the same number of columns/elements.

Example of a function used inside a controller in Codeigniter 2 used for reading the CSV files and simply printing the result:


function sample_read_csv()
{
	$this->load->library('getcsv');
	
	//NOTE if we use $fields the csv and the fields array MUST have the same number of columns, otherwise we'll get an empty array
	$fields = array('field1', 'field2'); 

	$data = $this->getcsv->set_file_path('path/to/file.csv')->get_array($fields);
	print_r($data);
}

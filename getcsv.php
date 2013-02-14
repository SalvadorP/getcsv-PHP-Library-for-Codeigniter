<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * TheBizzTech
 *
 * An open source library built for Codeigniter to read CSV files into associated arrays
 *
 * @author      Jason Michels
 * @link        http://thebizztech.com
 */

class Getcsv {
    
    private $file_path = "";
    private $handle = "";

    /**
     * set_file_path
     * 
     * @param mixed $file_path Description.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function set_file_path($file_path)
    {
        $this->file_path = $file_path;
        return $this;
    }

    /**
     * get_handle
     * 
     * @access private
     *
     * @return mixed Value.
     */
    private function get_handle()
    {
        $this->handle = fopen($this->file_path, "r");
        return $this;
    }

    /**
     * close_csv
     * 
     * @access private
     *
     * @return mixed Value.
     */
    private function close_csv()
    {
        fclose($this->handle);
        return $this;
    }

    //this is the most current function to use
    

    /**
     * This function gets the CSV and passes it to an associative array
     * If the $fields parameter is not empty, it gets the names of the csv fields from it
     * In case $fields is empty the names of the csv will be the ones in the first line of the CSV
     * 
     * @param string $fields name of the csv fields
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function get_array($fields = '')
    {
        $this->get_handle();

        $row = 0;
        while (($data = fgetcsv($this->handle, 0, ",")) !== FALSE) 
        {
            if($row == 0)
            {
                if(!empty($fields)){
                    foreach($fields as $key => $value)
                        $title[$key] = trim($value); //this extracts the titles from the first row and builds array
                }
                else
                {
                    foreach ($data as $key => $value)
                    {
                        $title[$key] = trim($value); //this extracts the titles from the first row and builds array
                    }
                }
            }
            else
            {
                $new_row = $row - 1; //this is needed so that the returned array starts at 0 instead of 1
                foreach($title as $key => $value) //this assumes there are as many columns as their are title columns
                {
                    $result[$new_row][$value] = trim($data[$key]);
                }
            }
            $row++;
        }
        $this->close_csv();
        return $result;
    }



// --------------------------------Main Functions Above----------------------------------------------------- //

    //This function is being left in incase I ever need it

    /**
     * get_csv_array
     * 
     * @access public
     *
     * @return mixed Value.
     */
    function get_csv_array()
    {
        $row = 0;
        if (($handle = fopen($this->file_path, "r")) !== FALSE) 
        {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
            {
                $final_array[$row] = $data;
                $row++;
            }
            fclose($handle);
        }
        return $final_array;
    }
    
    //Probably not going to use this much but would be helpful if there are not as many title columns as total columns and I wanted to pull out just specific titles

    /**
     * get_csv_assoc_array
     * 
     * @param mixed $questions Description.
     *
     * @access public
     *
     * @return mixed Value.
     */
    function get_csv_assoc_array($questions)
    {
        $row = 0;
        if (($handle = fopen($this->file_path, "r")) !== FALSE) 
        {
            while (($data = fgetcsv($handle, "", ",")) !== FALSE) 
            {
                if($row == 0)
                {
                    foreach ($questions as $key => $value)
                    {
                        foreach($data as $d_key => $d_value)
                        {
                            if($data[$d_key] == $value)
                            {
                                $q_location[$value] = $d_key;
                            }
                        }
                    }
                }
                else
                {
                    foreach ($questions as $key => $value)
                    {
                        $new_row = $row -1;
                        $final_array[$new_row][$value] = trim($data[$q_location[$value]]);
                    }
                }

                $row++;
            }
            fclose($handle);
        }
        return $final_array;
    }
    
} //End of class

//Here is the end of the getcsv.php class

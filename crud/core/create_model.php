<?php 

$string = "<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class " . $m . " extends Fm_model{

    public \$table = '$table_name';
    public \$id = '$pk';
    public \$order = 'DESC';

    function __construct(){
        parent::__construct();
    }    
    
    // get total rows
    function total_rows(\$q = NULL) {
    
    if(\$q){
        \t\$this->db->like('$pk', \$q);";

foreach ($non_pk as $row) {
    $string .= "\n\t\t\$this->db->or_like('" . $row['column_name'] ."', \$q);";
}    
    $string .= "\n\t}";

$string .= "\n\t\$this->db->from(\$this->table);
        return \$this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data(\$limit, \$start = 0, \$q = NULL) {
        \$this->db->order_by(\$this->id, \$this->order);
        if(\$q){
        \t\$this->db->like('$pk', \$q);";

foreach ($non_pk as $row) {
    $string .= "\n\t\t\$this->db->or_like('" . $row['column_name'] ."', \$q);";
}    
$string .= "\n\t}";
$string .= "\n\t\$this->db->limit(\$limit, \$start);
        return \$this->db->get(\$this->table)->result();
    }
    

}";


$hasil_model = createFile($string, $target. 'models/' . $m_file);

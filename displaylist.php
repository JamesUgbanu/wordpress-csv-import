<?php
global $wpdb;

// Import CSV
if(isset($_POST['butimport'])){
// File extension
					$extension = pathinfo($_FILES['import_file']['name'], PATHINFO_EXTENSION);
					// If file extension is 'csv'
                    if(!empty($_FILES['import_file']['name']) && $extension == 'csv'){
                    
                    						$totalInserted = 0;

						// Open file in read mode
						$csvFile = fopen($_FILES['import_file']['tmp_name'], 'r');

						fgetcsv($csvFile); // Skipping header row

						// Read file
						while(($csvData = fgetcsv($csvFile)) !== FALSE){
						$csvData = array_map("utf8_encode", $csvData);

						// Row column length
						$dataLen = count($csvData);

						// Skip row if length != 4
						//if( !($dataLen == 4) ) continue;

						// Assign value to variables
						$accountReference = trim($csvData[0]);
						$customerEmail = trim($csvData[1]);
						$accountNumber = trim($csvData[2]);
						$customer_email = explode(',', $customerEmail)[0];
						// Check record already exists or not
						$record = $wpdb->get_results("SELECT user_id FROM {$wpdb->usermeta} WHERE meta_key='customerEmail' AND  meta_value = '$customer_email' LIMIT 1");
						$id = $record[0]->user_id;
						if($id){
							
							// Check if variable is empty or not
							if(!empty($accountNumber)) {
							// Update Record
							//update_user_meta( $id, 'bankName', $accountNumber );
							update_user_meta( $id, 'accountNumber', $accountNumber );
							}

						}
$totalInserted++;
						}
						echo "<h3 style='color: green;'>Total record Inserted : ".$totalInserted."</h3>";
  
  }else{
    echo "<h3 style='color: red;'>Invalid Extension</h3>";
  }

}

?>
<h2>All Entries</h2>

<!-- Form -->
<form method='post' action='<?= $_SERVER['REQUEST_URI']; ?>' enctype='multipart/form-data'>
  <input type="file" name="import_file" >
  <input type="submit" name="butimport" value="Import">
</form>

  </tbody>
</table>
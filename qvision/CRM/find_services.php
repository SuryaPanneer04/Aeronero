<?php
require '../../connect.php';
include("../../user.php");
$Product = $_REQUEST["Product"];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Service Table</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%; /* Adjusted width to fit the screen */
    }
    th, td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
    th {
      background-color: #f2f2f2;
    }
    select, input[type="text"] {
      width: 80%;
      padding: 5px;
    }
  </style>
</head>
<body>

<input type="button" class="delete-row btn btn-danger" value="Delete" style="float:right;" onclick="deleteservice('new_servicetab')"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" class="add-row btn btn-success" value="Add " onclick="addRow()" style="float:right;"><br/><br/>
<div class="card-body">
 <table class="table table-striped table-bordered table-hover display nowrap"  id="new_servicetab" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered">
  <thead>
    <tr>
      <th>Select</th> <!-- New column for checkboxes -->
      <th>Service</th>
      <th>Manday</th>
      <th>No of days</th>
      <th>HR cost</th>
      <th>Admin Charges</th>
      <th>Total</th>
      <th>Gst</th>
      <th>Gst amt</th>
      <th>Net total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><input type="checkbox" name="chk[]"></td> <!-- Checkbox for deletion -->
      <td>
        <select name="service[]">
          <option value="nd">--Choose Service--</option>
          <?php
            $sql = $con->query("SELECT * FROM `service_master` order by service_id asc");
            while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
          ?>
            <option value="<?php echo $row['service_id'];?>"><?php echo $row['service_name'];?></option>
          <?php
            }
          ?>
        </select>
      </td>
      <td><input type="text" name="manday[]"></td>
      <td><input type="text" name="no_of_days[]"></td>
      <td><input type="text" name="hr_cost[]"></td>
      <td><input type="text" name="admin_charges[]"></td>
      <td><input type="text" name="total[]"></td>
      <td><input type="text" name="gst[]"></td>
      <td><input type="text" name="gst_amt[]"></td>
      <td><input type="text" name="net_total[]"></td>
    </tr>
  </tbody>
</table>
</div>

<script>
function addRow() {
  var table = document.getElementById("new_servicetab").getElementsByTagName('tbody')[0];
  var newRow = table.insertRow(-1); // Inserting at -1 will append the new row at the end
  var cell1 = newRow.insertCell(0);
  var cell2 = newRow.insertCell(1);
  var cell3 = newRow.insertCell(2);
  var cell4 = newRow.insertCell(3);
  var cell5 = newRow.insertCell(4);
  var cell6 = newRow.insertCell(5);
  var cell7 = newRow.insertCell(6);
  var cell8 = newRow.insertCell(7);
  var cell9 = newRow.insertCell(8);
  var cell10 = newRow.insertCell(9); // Add a new cell for the "Net total"
  cell1.innerHTML = '<input type="checkbox" name="chk[]">'; // Checkbox
  cell2.innerHTML = '<select name="service[]"><option value="nd">--Choose Service--</option><?php $sql = $con->query("SELECT * FROM `service_master` order by service_id asc");while($row = $sql->fetch(PDO::FETCH_ASSOC)) {?><option value="<?php echo $row['service_id'];?>"><?php echo $row['service_name'];?></option><?php }?></select>';
  cell3.innerHTML = '<input type="text" name="manday[]">';
  cell4.innerHTML = '<input type="text" name="no_of_days[]">';
  cell5.innerHTML = '<input type="text" name="hr_cost[]">';
  cell6.innerHTML = '<input type="text" name="admin_charges[]">';
  cell7.innerHTML = '<input type="text" name="total[]">';
  cell8.innerHTML = '<input type="text" name="gst[]">';
  cell9.innerHTML = '<input type="text" name="gst_amt[]">';
  cell10.innerHTML = '<input type="text" name="net_total[]">'; // Added input for "Net total"
}


function deleteservice(tableID) {
  var table = document.getElementById(tableID);
  var rowCount = table.rows.length;
  for (var i = rowCount - 1; i > 0; i--) {
    var row = table.rows[i];
    var chkbox = row.cells[0].getElementsByTagName('input')[0];
    if (chkbox && chkbox.type === 'checkbox' && chkbox.checked) {
      table.deleteRow(i);
    }
  }
}
</script>

</body>
</html>
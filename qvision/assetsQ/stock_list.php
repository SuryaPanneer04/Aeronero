<?php
require '../../connect.php';
include("../../user.php");
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
?>
<div  class="card card-primary">
              <div class="card-header" style="background-color:#ff8b3d;">
                <h3 class="card-title"><font size="5"> Stock List</font></h3>
			
		
			  
		    <a onclick="add_asset()"  style="float: right;padding: 4px 6px 7px 5px;position: relative;left: -21px;" data-toggle="modal" class="btn btn-dark btn"><i class="fa fa-plus"></i> ADD Stock</a> &nbsp;&nbsp;&nbsp;&nbsp;
			
              </div>
             
  
              <div class="card-body">

       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
		 
   
    <thead>
	<th>S.NO</th>
     
	      
				        <th>Stock </th>
				        <th>Stock Type</th>
						 <th>Stock Number</th>
				        <th>Stock Name</th>
						<th>Brand Name</th>
						<th>Purchase Date</th>
						<th>Serial Number</th>
						<th>Configuration</th>
						<th>Warranty</th>
						<th>Status</th>
<!--th>Action</th-->
 
     
      <!--th>Tools</th-->
      </thead>
      <tbody>
      <?php
	  
      $assets_sql=$con->query("SELECT a.*,m.*,a.id as aid FROM `assets_form_detail` a INNER JOIN assets_master m ON (a.asset_name = m.name) where a.asset not in ('Internal Asset')");
	   $i=1;
      while($assets_res = $assets_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
	
      <td><?php echo $assets_res['asset']; ?></td>
      <td><?php echo $assets_res['asset_type']; ?></td>
      <td><?php echo $assets_res['prefix_code']."-".$assets_res['asset_no']; ?></td>
      <td><?php echo $assets_res['name']; ?></td>
	       <td><?php echo $assets_res['brand_name']; ?></td>
		   <td><?php echo $assets_res['p_date']; ?></td>
		   <td><?php echo $assets_res['Serial_no']; ?></td>
		   <td><?php echo $assets_res['config']; ?></td>
		   <td><?php echo $assets_res['warranty']; ?></td>
			 <td>
<?php if(($assets_res['status']==1))  
{

echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
}
if(($assets_res['status']==2))  
{
echo '<span style="color:red;text-align:center;"><b>Pending</b></span>';

}

?></td>
<td><button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $assets_res['aid']; ?>" onclick="stock_edit(<?php echo $assets_res['aid']; ?>)"><i class="fa fa-edit"></i> Edit</button></td>
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      </table>
	 
      </div>
<!-- /.card -->
      </div>
      
<script>
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>

<script>

function client_excel(v)
    {
    $.ajax({
    type:"POST",
    url:"qvision/assetsQ/excels.php?",
    success:function(data){
   $("#main_content").html(data);
    }
    })
    }



   	function add_asset()
    {
		//alert("hii");
     $.ajax({
    type:"POST",
	url:"qvision/assetsQ/stock_form.php",
    success:function(data){
    $("#main_content").html(data);
    }
    }) 
  }
  
  	function stock_edit(v)
    {
		//alert("hii");
     $.ajax({
    type:"POST",
	url:"qvision/assetsQ/stock_form_edit.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    }) 
  }
</script>
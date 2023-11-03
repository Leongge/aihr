<?php
//include header
include('hr_header.php');

//SQL statement
$sql="SELECT * FROM job ORDER BY j_id ASC";

//Query
$query=$conn->query($sql);
?>
<!-- nav -->
<nav class="nav nav-tabs">
    <a class="nav-link" aria-current="page" href="index.php">Dashboard</a>
    <a class="nav-link" href="record_list.php">Records</a>
    <a class="nav-link active" href="job.php">Job</a>
    <a class="nav-link" href="logout.php">Logout</a>
</nav>


<br>
<div class="container">
  <h2>Job List <a href="job_add.php" class="btn btn-primary btn-sm">Add</a></h2>
  <br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th width="10%">No</th>
        <th width="70%">Name</th>
        <th width="20%">#</th>
      </tr>
    </thead>
    <tbody>
    <?php
    //Initial no
    $no=1;

    //Looping while and get result
    while($row=mysqli_fetch_assoc($query)):
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo ucwords($row['j_name']); ?></td>
      <td>
        <a href="job_edit.php?id=<?php echo $row['j_id']; ?>">Edit</a>
        <a href="javascript:void(0)" onclick="delete_data('job_delete.php?id=<?php echo $row['j_id']?>')">Delete</a>
      </td>
      </tr>
    <?php 
    //Increment no
    $no++;

    //End looping while
    endwhile;
    ?>
    </tbody>
  </table>
</div>

<?php
//include footer
include('hr_footer.php');
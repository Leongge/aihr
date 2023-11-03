<?php
//Import header file
include('hr_header.php');

include('download_file.php');

if (isset($_GET['page_no']) && $_GET['page_no']!="") 
{
    $page_no = $_GET['page_no'];
} 
else 
{
    $page_no = 1;
}

//total record per page
$total_records_per_page=10;

//Calculate offset value and set other variables
$offset = ($page_no-1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";

//Get total number of pages of pagination
$result_count = mysqli_query(
    $conn,
    "SELECT COUNT(*) As total_records FROM form"
    );
    $total_records = mysqli_fetch_array($result_count);
    $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1; // total pages minus 1

//SQL statement
$sql="SELECT *
        FROM form
        ORDER BY f_id DESC
        LIMIT $offset, $total_records_per_page";

$p=$_POST;
//if button search clicked
if(isset($_POST['search']))
{
  $job=$p['job'];
  //set page to 1
  $page_no = 1;
  //Calculate offset value and set other variables
  $offset = ($page_no-1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "2"; 
  //Receive data from search
  $input_search=$p['input_search'];

  //Edit sql on search
  $result_count = mysqli_query(
    $conn,
    "SELECT COUNT(*) As total_records FROM form WHERE f_job LIKE '%$job%' AND (f_name LIKE '%$input_search%' OR f_job LIKE '%$input_search%')"
    );
    $total_records = mysqli_fetch_array($result_count);
    $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1; // total pages minus 1

    $sql="SELECT *
    FROM form
    WHERE  f_job LIKE '%$job%' AND (f_name LIKE '%$input_search%' OR f_job LIKE '%$input_search%')
    ORDER BY f_id DESC
    LIMIT $offset, $total_records_per_page";
}

if(isset($_POST['clear']))
{
  //set page to 1 
  $page_no = 1;
  //Calculate offset value and set other variables
  $offset = ($page_no-1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "2"; 
  //After user search and wish to clear, sql edit to default
  //Get total number of pages of pagination
  $result_count = mysqli_query(
    $conn,
    "SELECT COUNT(*) As total_records FROM form"
    );
    $total_records = mysqli_fetch_array($result_count);
    $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1; // total pages minus 1

    $sql="SELECT*
    FROM form
    ORDER BY f_id DESC
    LIMIT $offset, $total_records_per_page";
}

//Run query
$query=$conn->query($sql);
?>

<!-- nav -->
<nav class="nav nav-tabs">
    <a class="nav-link" aria-current="page" href="index.php">Dashboard</a>
    <a class="nav-link active" href="record_list.php">Records</a>
    <a class="nav-link" href="job.php">Job</a>
    <a class="nav-link" href="logout.php">Logout</a>
</nav>

<div class="container">
    <div class="mb-3 mt-5">
    <form action="" method="post" class="row">
        <div class="col-2">
            <h5 style="text-align:right; padding-top:5px;">Search :</h5>
        </div>
        <div class="col-6">
            <input type="text" class="form-control" id="input_search" name="input_search" placeholder="Type job or position to search...">
        </div>
        <div class="col-2">
        <select name="job" class="form-select">
            <option value="">Select Job</option>
            <?php 
            $query2 ="SELECT * FROM job";
            $result2 = $conn->query($query2);
            if($result2->num_rows> 0){
                while($optionData=$result2->fetch_assoc()){
                $option =ucwords(strtolower($optionData['j_name']));
                $id =$optionData['j_id'];
            ?>
            <option value="<?php echo $option; ?>" ><?php echo $option; ?> </option>
        <?php
            }}
            ?>
        </select>
        </div>
        <div class="col-2">
            <input type="submit" name="search" value="Search" class="btn btn-primary btn-group me-2">
            <input type="submit" name="clear" value="Clear" class="btn btn-primary btn-group me-2">
        </div>
    </form>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th width="5%" style="text-align:center">No</th>
                <th width="40%" style="text-align:center">Name</th>
                <th width="20%" style="text-align:center">Job</th>
                <th width="15%" style="text-align:center">Compatibility</th>
                <th width="10%" style="text-align:center">View</th>
                <th width="10%" style="text-align:center">Download</th>
            </tr>
        </thead>
        <tbody>
        <?php
        //initiate no
        $no=1;
        //for while looping
        while($row=mysqli_fetch_assoc($query)):
        ?>
            <tr>
                <td width="5%"><?php echo $no?></td>
                <td width="40%" style="text-align:center"><?php echo $row['f_name'] ?></td>
                <td width="20%" style="text-align:center"><?php echo $row['f_job'] ?></td>
                <td width="15%" style="text-align:center"><?php echo $row['compatibility']?></td>
                <td width="10%" style="text-align:center">
                    <a href="record_detail.php?id=<?php echo $row['f_id'] ?>" target="blank">Detail</a>
                </td>
                <td width="10%" style="text-align:center">
                    <a href="record_list.php?f_id=<?php echo $row['f_id'] ?>">Download</a>
                </td>
                
            </tr>
        <?php
        $no++;
        //endwhile looping
        endwhile;
        ?>
        </tbody>
    </table>

    <!-- pagination -->
    <div style="position:fixed; bottom:0px; height:93px; width:84%;">
        <!-- current page / total page -->
        <div style='padding: 10px 20px 0px;'>
        <strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
        </div>
        <!-- nav bar for pagination -->
        <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            
        <!-- previous page -->
            <?php if($page_no<=1)
            {?>
            <li class="page-item disabled"><a class="page-link" href=<?php echo"'?page_no=$previous_page'";?>>Previous</a></li>
            <?php
            }
            else
            {?>
            <li class="page-item"><a class="page-link" href=<?php echo"'?page_no=$previous_page'";?>>Previous</a></li>
            <?php
            }?>

        <!-- number page-->
        <?php
        //if item are only less than or equal to 10
        if ($total_no_of_pages <= 10)
        {  	 
            for ($counter = 1; $counter <= $total_no_of_pages; $counter++)
            {
            if ($counter == $page_no)
            {
                echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
            }
            else
            {
                echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
            }
            }
        }
        //if item are more than 10
        else if ($total_no_of_pages > 10)
        {
            //if current page is below or equal to 4 
            if($page_no <= 4) {			
            for ($counter = 1; $counter < 8; $counter++)
            {		 
                if ($counter == $page_no)
                {
                echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
                }
                else
                {
                echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                }
            }
            echo "<li class='page-item'><a class='page-link'>...</a></li>";
            echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
            echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
            }
        }
        //if current page is more than 4
        elseif($page_no > 4 && $page_no < $total_no_of_pages - 4)
        {		 
            echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
            echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
            echo "<li class='page-item'><a class='page-link'>...</a></li>";
            for (
                $counter = $page_no - $adjacents;
                $counter <= $page_no + $adjacents;
                $counter++
                )
                {		
                if ($counter == $page_no) 
                {
                    echo "<li class='page-item'><a class='page-link active'>$counter</a></li>";	
                }else{
                    echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                }                  
                }
                echo "<li class='page-item'><a class='page-link'>...</a></li>";
                echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
        }
        //current page are nearly end of page
        else 
        {
            echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
            echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
            echo "<li class='page-item'><a class='page-link'>...</a></li>";
            for (
                $counter = $total_no_of_pages - 6;
                $counter <= $total_no_of_pages;
                $counter++
                )
                {
                if ($counter == $page_no)
                {
                    echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
                }else{
                    echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                }                   
                }
            }?>

        <!-- next page -->
            <?php if($page_no >= $total_no_of_pages)
            {?>
            <li class="page-item disabled"><a class="page-link" href=<?php echo"'?page_no=$next_page'";?>>Next</a></li>
            <?php
            }
            else
            {?>
            <li class="page-item"><a class="page-link" href=<?php echo"'?page_no=$next_page'";?>>Next</a></li>
            <?php
            }?>

        <!-- last page -->

            <?php if($page_no < $total_no_of_pages)
            {?>
            <li class="page-item"><a class="page-link" href=<?php echo"'?page_no=$total_no_of_pages'"?>>Last &rsaquo;&rsaquo;</a></li>
            <?php 
            }?>
        </ul>
        </nav>
    </div>
</div>
<?php
//Import header file
include('hr_footer.php');
?>

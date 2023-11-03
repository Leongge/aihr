<?php
//include header
include('applicant_header.php');


include('download_file.php');

//Pagination
//Get current page number
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
    "SELECT COUNT(*) As total_records FROM form WHERE a_id=$user_id"
    );
    $total_records = mysqli_fetch_array($result_count);
    $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1; // total pages minus 1

//SQL statement
$sql="SELECT * FROM form WHERE a_id=$user_id ORDER BY f_id DESC LIMIT $offset, $total_records_per_page";
$query=$conn->query($sql);
?>

<!-- nav -->
<nav class="nav nav-tabs">
    <a class="nav-link" aria-current="page" href="index.php">Dashboard</a>
    <a class="nav-link active" href="record.php">Record</a>
    <a class="nav-link" href="logout.php">Logout</a>
</nav>
<br>
<div class="container">
    <h2>Record List</h2>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th width="60%">Job</th>
                <th width="10%">Attachment</th>
                <th width="20%">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no=1; //initiate no.
             //for while looping
            while($row=mysqli_fetch_assoc($query)):

                if(empty($row['f_status']))
                {
                    $status="Waiting";
                }
                else
                {
                    $status=$row['f_status'];
                }
            ?>
                <tr>
                    <td width="10%"><?php echo $no?></td>
                    <td width="60%"><?php echo $row['f_job']?></td>
                    <td width="10%">
                        <a href="record.php?f_id=<?php echo $row['f_id']?>">Download</a>
                    </td>
                    <td width="20%"><?php echo $row['f_status']?></td>
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
</div>
<?php
//include footer
include('applicant_footer.php');
?>
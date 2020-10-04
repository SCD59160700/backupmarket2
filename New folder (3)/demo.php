<?php 
include('code/connect.php');
$sql = "SELECT DISTINCT s.shop_id,s.shop_img,s.shop_name,CONCAT(u.user_fname, ' ', u.user_lname) AS FullName,m.mk_name,m.mk_type,m.mk_date
       FROM market m,shop s,product p,user u
       WHERE m.mk_id=s.mk_id AND p.shop_id=s.shop_id AND s.user_id=u.user_id AND s.shop_status='active' AND m.mk_status='active' AND mk_type LIKE '%nan%' ";
 echo $sql;
            // if (isset($search) && $selected == 1) {
            //   $sql .= "AND shop_name LIKE '%$search%'";
            // } elseif (isset($search) && $selected == 2) {
            //   $sql .= "AND prd_name LIKE '%$search%'";
            // } elseif (isset($search) && $selected == 3) {
            //   $sql .= "AND mk_name LIKE '%$search%'";
            // } elseif (isset($search) && $selected == 4) {

            //   $sql .= "AND mk_type LIKE '%$search%'";
            // } elseif (isset($calen) && $selected == 5) {
            //   $sql .= "AND mk_date LIKE '%$nameOfDay%' ";
            // } elseif (isset($search) && $selected != 2) {
            //   echo "<script type='text/javascript'>";
            //   echo "alert('ระบุคำค้นไม่ตรงกับเงื่อนไขที่เลือก');";
            //   echo "</script>";
            // }
           
            $result = mysqli_query($conn, $sql);
            $rowcount = mysqli_num_rows($result);
            echo $rowcount;
            $row = mysqli_fetch_array($result);
            // echo $row;
            // echo $rowcount;
            $shop_id = $row["shop_id"];
            // echo $result;
            if ($rowcount == 0){
                echo "Description is empty";
           }else{
               echo $row['describe'];
           }
           
        //   } 
        // }

        ?>
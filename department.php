<?php
        $query = "SELECT Dname FROM department WHERE `Dname`!='Admin' " ;
            $res1 = mysqli_query($conn,$query);

            while ($row1 = $res1->fetch_row()) {
                echo "<option ";
                echo 'value = "'.$row1[0].'">'.$row1[0].'</option>';
            }
            echo '</select><br><br><br>';
          
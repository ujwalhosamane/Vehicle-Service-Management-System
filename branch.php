<?php
            $query = "SELECT Branch_name FROM branch " ;
            $res = mysqli_query($conn,$query);

            while ($row = $res->fetch_row()) {
                echo "<option ";
                echo 'value = "'. $row[0] .'">'.$row[0].'</option>';
              
            }
            echo '</select><br><br><br>';

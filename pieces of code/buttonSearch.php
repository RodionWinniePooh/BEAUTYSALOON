//if(isset($_POST['search_service']))
            //{
            //    $search = mysqli_real_escape_string($dbc, trim($_POST['input_search_service']));
            //    $query = "SELECT `name_service`, `price`, `description_service`, `category`, `duration_service` FROM `service` WHERE `name_service` LIKE '%$search%' OR `price` LIKE '%$search%' OR `category` LIKE '%$search%' OR `duration_service` LIKE '%$search%'";
            //} else {
            //    $query = "SELECT `name_service`, `price`, `description_service`, `category`, `duration_service` FROM `service`";
            //}
            //    $result = mysqli_query($dbc, $query);
            //    
            //    if($result) {
            //        $array = array(
            //            0  => "Название услуги",
            //            1  => "Цена",
            //            2  => "Описание услуги",
            //            3  => "Категория",
            //            4  => "Длительность услуги",
            //        );
            //        
            //        tableBuilding ($array);
            //        $rows    = mysqli_num_rows($result);   // количество полученных строк
            //        $columns = mysqli_num_fields($result); // количество полученных столбцов
            //        //$row     = mysqli_fetch_row($result);  // получаем ряд с инфомрацией
            //        tableData($rows,$columns,$result);
            //        mysqli_free_result($result);// очищаем результат
            //    }
            //    else{
            //        echo 'Услуг нет';
            //    }
            //        //mysqli_close($dbc);




            <?php
            function tableBuilding($array){
                
                echo '
                <div class="container">
                    <table>
                        <thead>     
                            <tr>
                        
                            ';                              
                                for ($i = 0; $i < count($array); ++$i)
                                {
                                    echo "<th>$array[$i]</th>";
                                }   
                echo '        
                            </tr>
                        </thead>';                    
            }

            function tableData($rows,$columns,$result){
                echo '
                        <tbody>';
                for ($i = 0 ; $i < $rows ; ++$i)
                {
                    $row = mysqli_fetch_row($result);  // получаем ряд с информацией
                    echo '  <tr>';
                    for ($j = 0 ; $j < $columns ; ++$j)
                        echo "     <td>$row[$j]</td>";
                    echo '  </tr>';
                }
                echo ' 
                        </tbody>
                    </table>
                </div>';
            }

            
            ?>
<?php require_once "../block/head.php"; ?>


<body>
    <div class="grid">

        <?php 
            require_once "../block/asidepanel.php";
            require_once "../block/header.php";
        ?>
        
        <article class="article_search_table">            
            <table>
                <tr>
                    <td>Поиск по материалам:</td>
                    <td>
                        <input type="text" name="search_text" id="search_text" placeholder=" Поиск" class="input_min">
                    </td>
                </tr>
            </table>
            <?php
                if(isset($_SESSION['success']) && $_SESSION['success'] != '')
                {
                    echo '<h2 class="success">'.$_SESSION['success'].'</h2>';
                    unset($_SESSION['success']);
                }
                if(isset($_SESSION['error']) && $_SESSION['error'] != '')
                {
                    echo '<h2 class="error">'.$_SESSION['error'].'</h2>';
                    unset($_SESSION['error']);
                }
                if(isset($_SESSION['warning']) && $_SESSION['warning'] != '')
                {
                    echo '<h2 class="warning">'.$_SESSION['warning'].'</h2>';
                    unset($_SESSION['warning']);
                }
            ?>
        </article>


        

        <article class="article_view_table container_table_view" id="result">

        </article>
            
        <article class="article_add_table">
            <form method="post" action="/admin/query_add.php">
                    <div>
                        <div>
                            <h2>Добавление материала</h2>
                        </div>

                        <br>
                        <div>
                            <label>Название материала:</label>
                        </div>
                        <br>
                        <div>
                            <input type="text" name="name_material" placeholder="Введите название" class="input_min" required size="35">
                        </div>
                        <br>

                        <div>
                            <label>Единицы измерения:</label>
                        </div>
                        <br>
                        <div>
                            <select name="unit" required class="input_min">
                                <option value="мл."> мл.</option>
                                <option value="шт."> шт.</option>
                                <option value="рул.">рул.</option>
                            </select>
                        </div>
                        <br>

                        <div>
                            <label>Количество материала:</label>
                        </div>
                        <br>
                        <div>
                            <input type="number" name="quantity" placeholder="Введите количество" required class="input_min" min="1" max="10000">
                        </div>
                        <br>

                        <div>
                            <label>Производитель:</label>
                        </div>
                        <br>
                        <div>
                            <input list="list_manufacturer" name="manufacturer" placeholder="Введите производителя" required class="input_min">
                                <datalist id="list_manufacturer">
                                    <?php 
                                        $query = "SELECT `manufacturer` FROM `material` GROUP BY `manufacturer`";
                                        $result = mysqli_query($connect, $query); 
                                        while ($row = mysqli_fetch_row($result)) {
                                            echo "<option>$row[0]</option>";
                                        }
                                        mysqli_free_result($result);
                                    ?>
                                </datalist>
                        </div>
                        <br>
                        <div>
                            <input type="submit" value="Добавить" name="add_material" class="rectangle_btn btn_green">
                        </div>
                    </div>
                </form>
        </article>

        <article class="article_delete_table">
            <form method="post" action="/admin/query_delete.php">
                <div>
                    <div>
                        <h2>Удаление материала</h2>
                    </div>
                    <br>
                    <div>
                        <label>Название материала:</label>
                    </div>
                    <br>
                    <div>
                        <select name="delete_name_material" id="name_material" class="input_min" required>
                                <?php 
                                    $query = "SELECT `name_material` FROM `material`";
                                    $result = mysqli_query($connect, $query); 
                                    
                                    while ($row = mysqli_fetch_row($result)) {
                                        echo "<option>$row[0]</option>";
                                    }
                                    mysqli_free_result($result);
                                ?>
                        </select>
                    </div>
                    <br>
                    <div>
                        <label>Производитель</label>
                    </div>
                    <br>
                    <div>
                        <select name="delete_material_manufacturer" id="material_manufacturer" required class="input_min">
                                    
                        </select>
                    </div>
                    <br>
                    <div>
                        <input type="submit" name="delete_material" value="Удалить" class="rectangle_btn btn_red">
                    </div>
                </div>
            </form>                         
        </article>


        <style>
            .material_table{
                width:100%;
            }
            .material_table>tbody>tr>td:nth-child(1) {
                text-align:  center;
            }
            .material_table>tbody>tr>td:nth-child(2) {
                text-align:  center;
            }
            .material_table>tbody>tr>td:nth-child(3) {
                text-align:  center;
            }
            .material_table>tbody>tr>td:nth-child(4) {
                text-align:  center;
            }
            .material_table>tbody>tr:last-child td:nth-child(1){
                border-bottom: none;
            }
            .material_table>tbody>tr:last-child td:nth-child(3){
                border-bottom: none;
            }

            .container_table_view {
                height: 500px;
                padding: 0px;
                overflow: auto;
            }

            .material_table>tbody>tr>td:nth-child(3) {
                border-bottom: 2px solid white; /* Горизонтальные линии в таблице */
            }
            .material_table>tbody>tr>td:nth-child(1) {
                border-bottom: 2px solid white; /* Горизонтальные линии в таблице */
            }
        </style>

        <aside class="aside_table">
            <form>
                <ol class="widget-list">
                    <li><a href="/admin/service/service.php">     Услуги          </a></li>
                    <li><a href="/admin/employee/employee.php">            Сотрудники      </a></li>
                    <li><a href="/admin/customer/customer.php">            Клиенты         </a></li>
                    <li><a href="/admin/visit/visit.php">               Посещения       </a></li>
                    <li><a href="/admin/material/material.php" id="this_page">            Материалы       </a></li>
                    <li><a href="/admin/consumptionmaterial/consumptionmaterial.php"> Расход материла </a></li>
                    <li><a href="/admin/freeorder/freeorder.php"> Свободные посещения </a></li>
                    <hr>
                    <li>
                        <table>
                        <tr>
                          <td style="vertical-align: middle"><img src="../wallpaper/icon_setting.png" style="max-width:35px; min-width:10px;"></td>
                          <td style="vertical-align: middle"> <a href="/admin/setting.php">Настройки</a></td>
                        </tr>
                        </table>
                    </li>
                </ol>
            </form>  
        </aside>

        <?php 
            require_once "../block/footer.php";
        ?>





    </div>
    <script src="/script/consumptionmaterial_material_manufacturer.js"></script>
    <script src="/script/material_search_view.js"></script>

</body>
</html>
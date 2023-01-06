<?php
    session_start();
    require_once "../start.php";
    if(isset($_POST["button_exit"])){
        session_destroy();
        header('Location: /admin/auth.php');
        exit;
    }

    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $database   = "beautysaloon";

    $connect = mysqli_connect($servername, $username, $password, $database)  OR DIE('Ошибка подключения к базе данных');

?>

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
                    <td>Поиск по расходам материалов:</td>
                    <td>
                        <input type="text" name="search_text" id="search_text" placeholder=" Поиск" class="input_min">
                    </td>
                </tr>
            </table>
            <?php
                if(isset($_SESSION['success']) && $_SESSION['success'] != '')
                {
                    echo '<h2>'.$_SESSION['success'].'</h2>';
                    unset($_SESSION['success']);
                }
                if(isset($_SESSION['status']) && $_SESSION['status'] != '')
                {
                    echo '<h2>'.$_SESSION['status'].'</h2>';
                    unset($_SESSION['status']);
                }
            ?>
        </article>


        

        <article class="article_view_table container_table_view" id="result">

        </article>
            
        <article class="article_add_table">
            <form method="post" action="/admin/query_add.php">
                    <div>
                        <div>
                            <h2>Добавление расходуемых материалов</h2>
                        </div>

                        <br>
                        <div>
                            <label>Название материала:</label>
                        </div>
                        <br>
                        <div>
                            <select name="name_material" id="name_material" required class="input_min">
                                <?php 
                                    $query = "SELECT `name_material` FROM `material` GROUP BY `name_material`";
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
                                    <label>Название фирмы</label>
                        </div>
                        <br>
                        <div>
                            <select name="material_manufacturer" id="material_manufacturer" required class="input_min">
                                    
                            </select>
                        </div>
                        <br>
                        <div>
                            <label>Количество требуемого материала:</label>
                        </div>
                        <br>
                        <div>
                            <input type="number" name="consumed_quantity" placeholder="Введите количество" required class="input_min" min="1" max="10000">
                        </div>
                        <br>

                        <div>
                            <input type="submit" value="Добавить" name="add_consumptionmaterial" class="rectangle_btn btn_green">
                        </div>
                    </div>
                </form>
        </article>

        <article class="article_delete_table">
                            
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
                    <li><a href="/admin/material/material.php">            Материалы       </a></li>
                    <li><a href="/admin/consumptionmaterial/consumptionmaterial.php" id="this_page"> Расход материла </a></li>
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
    <script src="/script/consumptionmaterial_search_view.js"></script>
    <script src="/script/consumptionmaterial_material_manufacturer.js"></script>

</body>
</html>
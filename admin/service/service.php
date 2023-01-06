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
                    <td>Поиск по услугам:</td>
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
                            <h2>Добавление услуги</h2>
                        </div>
                        <br>
                        <div>
                            <label>Название услуги:</label>
                        </div>
                        <br>
                        <div>
                            <input type="text" name="name_service" placeholder="Введите Название услуги" class="input_min" required size="35">
                        </div>
                        <br>
                        <div>
                            <label>Цена:</label>
                        </div>
                        <br>
                        <div>
                            <input type="number" name="price" placeholder="Введите цену услуги" class="input_min" required>
                        </div>
                        <br>
                        <div>
                            <label>Описание услуги:</label>
                        </div>
                        <br>
                        <div>
                            <textarea name="description_service" cols="30" rows="8" maxlength="1000" placeholder="Введите Описание услуги" required class="input_min"></textarea>
                        </div>
                        <br>

                        <div>
                            <label>Категория:</label>
                        </div>
                        <br>
                        <div>
                            <input list="list_duration_service" name="category" placeholder="Введите Категорию" required class="input_min">
                                <datalist id="list_duration_service">
                                    <?php 
                                        $query = "SELECT `category` FROM `service` GROUP BY `category`";
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
                            <label>Длительность услуги:</label>
                        </div>
                        <br>
                        <div>
                            <select name="duration_service" required class="input_min">
                                <option value="00:30:00">30м</option>
                                <option value="01:00:00">1ч:00м</option>
                                <option value="01:30:00">1ч:30м</option>
                                <option value="02:00:00">2ч:00м</option>
                                <option value="02:30:00">2ч:30м</option>
                                <option value="03:00:00">3ч:00м</option>
                                <option value="03:30:00">3ч:30м</option>
                                <option value="04:00:00">4ч:00м</option>
                                <option value="04:30:00">4ч:30м</option>
                                <option value="05:00:00">5ч:00м</option>
                            </select>
                        </div>
                        <br>
                        <div>
                            <input type="submit" value="Добавить" name="add_service" class="rectangle_btn btn_green">
                        </div>
                    </div>
                </form>
        </article>

        <article class="article_delete_table">
            <form method="post" action="/admin/query_delete.php">
                <div>
                    <div>
                        <h2>Удаление услуги</h2>
                    </div>
                    <br>
                    <div>
                        <label>Название услуги:</label>
                    </div>
                    <br>
                    <div>
                        <select name="delete_name_service" class="input_min" required>
                                <?php 
                                    $query = "SELECT `name_service` FROM `service` GROUP BY `name_service`";
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
                        <input type="submit" name="delete_service" value="Удалить" class="rectangle_btn btn_red">
                    </div>
                </div>
            </form>                         
        </article>


        <style>
            .service_table{
                width:100%;
            }
            .service_table>tbody>tr>td:nth-child(1) {
                text-align:  center;
            }
            .service_table>tbody>tr>td:nth-child(2) {
                text-align:  center;
            }
            .service_table>tbody>tr>td:nth-child(4) {
                text-align:  center;
            }
            .service_table>tbody>tr>td:nth-child(5) {
                text-align:  center;
            }
            .service_table>tbody>tr>td:nth-child(6) {
                text-align:  center;
            }
            .service_table>tbody>tr>td:nth-child(7) {
                text-align:  center;
            }
            .service_table>tbody>tr:last-child td:nth-child(3){
                border-bottom: none;
            }

            .container_table_view {
                height: 500px;
                padding: 0px;
                overflow: auto;
            }

            .service_table>tbody>tr>td:nth-child(3) {
                border-bottom: 2px solid white; /* Горизонтальные линии в таблице */
            }
        </style>

        <aside class="aside_table">
            <form>
                <ol class="widget-list">
                    <li><a href="/admin/service/service.php" id="this_page">     Услуги          </a></li>
                    <li><a href="/admin/employee/employee.php">            Сотрудники      </a></li>
                    <li><a href="/admin/customer/customer.php">            Клиенты         </a></li>
                    <li><a href="/admin/visit/visit.php">               Посещения       </a></li>
                    <li><a href="/admin/material/material.php">            Материалы       </a></li>
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
    <script src="/script/service_search_view.js"></script>

</body>
</html>
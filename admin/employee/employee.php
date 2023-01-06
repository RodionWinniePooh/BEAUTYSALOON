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
                    <td>Поиск по сотрудникам:</td>
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
                <select name="state" id="maxRows" class="form-control">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>

                <nav>
                    <ul class="pagination"></ul>
                </nav>
        </article>
            
        <article class="article_add_table">
            <form method="post" action="/admin/query_add.php">
                    <div>
                        <div>
                            <h2>Добавление сотрудника</h2>
                        </div>

                        <br>
                        <div>
                            <label>ФИО:</label>
                        </div>
                        <br>
                        <div>
                            <input type="text" name="full_name" placeholder="Введите ФИО" class="input_min" required size="35">

                        </div>
                        <br>

                        <div>
                            <label>Адрес:</label>
                        </div>
                        <br>
                        <div>
                            <input type="text" name="address" placeholder="Введите адрес" required class="input_min" size="35">
                        </div>
                        <br>

                        <div>
                            <label>Телефон:</label>
                        </div>
                        <br>
                        <div>
                            <input type="text" id="phone" name="phone_number" title="Используйте числовой формат 29*******(5)" placeholder="Введите номер сотрудника" required class="input_min">
                        </div>
                        <script>
                        $(function(){
                            //2. Получить элемент, к которому необходимо добавить маску маска подключается через jquery
                            $("#phone").mask("+375(99)999-99-99");
                        });
                        </script>
                        <br>
                        <div>
                            <label>Стаж работы:</label>
                        </div>
                        <br>
                        <div>
                            <input type="number" name="length_of_work" placeholder="Введите стаж работы" required class="input_min" min="0">
                        </div>
                        <br>
                        <div>
                            <label>Разряд сотрудника:</label>
                        </div>
                        <br>
                        <div>
                            <select name="rank_of_master" required class="input_min">
                                <option value="1">1 разряд</option>
                                <option value="2">2 разряд</option>
                                <option value="3">3 разряд</option>
                                <option value="4">4 разряд</option>
                                <option value="5">5 разряд</option>
                            </select>
                        </div>
                        <br>
                        <div>
                            <label>Дата приёма на работу:</label>
                        </div>
                        <br>
                        <div>
                            <input type="date" name="date_of_employment" placeholder="Введите дату приёма на рабобу" required class="input_min">
                        </div>
                    
                        <br>
                        <div>
                            <input type="submit" value="Добавить" name="add_employee" class="rectangle_btn btn_green">
                        </div>
                    </div>
                </form>
        </article>

        <article class="article_delete_table">
            <form method="post" action="/admin/query_delete.php">
                <div>
                    <div>
                        <h2>Удаление сотрудника</h2>
                    </div>
                    <br>
                    <div>
                        <label>ФИО сотрудника:</label>
                    </div>
                    <br>
                    <div>
                        <select name="delete_full_name_employee" class="input_min" required>
                                <?php 
                                    $query = "SELECT `full_name` FROM `employee`";
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
                        <input type="submit" name="delete_employee" value="Удалить" class="rectangle_btn btn_red">
                    </div>
                </div>
            </form>                         
        </article>


        <style>
            .employee_table{
                width:100%;
            }
            .employee_table>tbody>tr>td:nth-child(1) {
                text-align:  center;
            }
            .employee_table>tbody>tr>td:nth-child(2) {
                text-align:  center;
            }
            .employee_table>tbody>tr>td:nth-child(4) {
                text-align:  center;
            }
            .employee_table>tbody>tr>td:nth-child(5) {
                text-align:  center;
            }
            .employee_table>tbody>tr>td:nth-child(6) {
                text-align:  center;
            }
            .employee_table>tbody>tr>td:nth-child(7) {
                text-align:  center;
            }
            .employee_table>tbody>tr>td:nth-child(8) {
                text-align:  center;
            }
            .employee_table>tbody>tr:last-child td:nth-child(3){
                border-bottom: none;
            }
            .employee_table>tbody>tr:last-child td:nth-child(1){
                border-bottom: none;
            }

            .container_table_view {
                height: 500px;
                padding: 0px;
                overflow: auto;
            }

            .employee_table>tbody>tr>td:nth-child(3) {
                border-bottom: 2px solid white; /* Горизонтальные линии в таблице */
            }
            .employee_table>tbody>tr>td:nth-child(1) {
                border-bottom: 2px solid white; /* Горизонтальные линии в таблице */
            }
        </style>

        <aside class="aside_table">
            <form>
                <ol class="widget-list">
                    <li><a href="/admin/service/service.php">     Услуги          </a></li>
                    <li><a href="/admin/employee/employee.php" id="this_page">            Сотрудники      </a></li>
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
    <script src="/script/employee_search_view.js"></script>
    <script>
        //var table ="#myTable";
        //$('#maxRows').on('change', function(){
        //    $('.pagination').html()
        //    var trnum = 0
        //    var maxRows = parseInt($(this).val())
        //    var totalRows = $(table+' tbody tr').length
        //    $(table+' tr:gt(0)').each(function(){
        //        trnum++
        //        if(trnum > maxRows){
        //            $(this).hide()
        //        }
        //        if(trnum <= maxRows){
        //            $(this).show()
        //        }
        //    })
        //    if(totalRows > maxRows){
        //        var pagenum = Math.ceil(totalRows/maxRows)
        //        for(var i=1; i <= pagenum;){
        //            $('.pagination').append('<li data-page="'+i+'">\<span>'+ i++ +'<span class="sr-only">(current)</span></span>\</li>').show()
        //        }
        //    }
        //    $('.pagination li:first-child').addClass('active')
        //    $('.pagination li').on('click',function(){
        //        var pageNum = $(this).attr('data-page')
        //        var trIndex = 0;
        //        $('.pagination li').removeClass('active')
        //        $(table+' tr:gt(0)').each(function(){
        //            trIndex++
        //            if(trIndex > (maxRows+pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
        //                $(this).hide()
        //            } else{
        //                $(this).show()
        //            }
        //        })
        //    })
        //})
    </script>

</body>
</html>
<?php require_once "../block/head.php"; ?>

<body>
    <div class="grid_edit">

    <article class="article_edit_table">

    <?php 

    if(isset($_POST['edit_btn']))
    {
        $id = $_POST['edit_id'];
        //echo $id;


        $query = "SELECT Consumptionmaterial.id_consumption, Material.name_material, Consumptionmaterial.consumed_quantity FROM Material
            INNER JOIN Consumptionmaterial ON Material.id_material = Consumptionmaterial.id_material WHERE id_consumption = '$id'";


        $result = mysqli_query($connect, $query);
        if(!$result){ echo 'Ошибка в подключении или в запросе'; }

        $query_material = "SELECT `name_material` FROM `material` GROUP BY `name_material`";
        $result_material = mysqli_query($connect, $query_material); 
        $material = '';
        while ($row = mysqli_fetch_row($result_material)) {
            $material .="<option>$row[0]</option>";
        }





        foreach($result as $row)
        {
            ?>

            <form method="post" action="/admin/query_update.php">
                <div>
                    <input type="hidden" name="edit_id" value="<?php echo $row['id_consumption'] ?>">
                    <input type="hidden" name="name_material" value="<? echo $row['name_material'] ?>">
                    <input type="hidden" name="consumed_quantity" value="<? echo $row['consumed_quantity'] ?>">


                    <div>
                        <h2>Редактирование расходуемых материалов</h2>
                    </div>
                    <br>
                    
                    <br>
                    <div>
                        <label>Название материала:</label>
                    </div>
                    <br>
                    <div>
                        <select name="edit_name_material" id="name_material" required class="input_min">
                            <?php 
                                echo $material;
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
                                <?php
                                    echo $manufacturer;
                                ?>
                        </select>
                    </div>
                    <br>

                    <div>
                        <label>Количество требуемого материала:</label>
                    </div>
                    <br>
                    <div>
                        <input type="number" name="edit_consumed_quantity" placeholder="Введите количество" required class="input_min" min="1" max="10000" value="<?php echo $row['consumed_quantity'] ?>">
                    </div>
                    <br>
                    <br>
                    <div id="div_edit">
                        <div style="display:inline;">
                           
                                <a href="consumptionmaterial.php" class="input_min btn_gray">Назад</a>
                        
                        </div>
                        <div style="display:inline;">
                            <input type="submit" name="update_btn_consumption" value="Обновить" class="rectangle_btn btn_green">
                        </div>
                    </div>
                </div>
            </form>

            <style>
                #div_edit{
                    display:block;
                }
            </style>
            
            <?php
        }
    }
?>


        <script>
            let option = "<? echo $row['name_material'] ?>"; //Получаем переменную из phpmyadmin
            const select = document.querySelector('#name_material').getElementsByTagName('option');
            for (let i = 0; i < select.length; i++) {
                if (select[i].value === option) select[i].selected = true;
            }

        </script>

    </article>





    <?php 
        require_once "../block/footer.php";
        require_once "../block/asidepanel.php";
        require_once "../block/header.php";
        require_once "../block/asidetable.php";
    ?>

    </div>

    <script src="/script/consumptionmaterial_material_manufacturer.js"></script> 
</body>
</html>
<?php
    session_start();

    require_once "start.php";

    if(isset($_POST["button_exit"])){
        session_destroy();
        header('Location: /admin/auth.php');
        exit;
    }

    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $database   = "beautysaloon";

    $connect = mysqli_connect($servername, $username, $password, $database);

    $output = '';
    $query = '';
?>

<?php require_once "block/head.php"; ?>

<body>

    <div class="grid_setting">
        
        <?php 
            require_once "block/asidepanel.php";
            require_once "block/header.php";
        ?>

 
        <article class="text_for_theme">
            <h2 style="margin:10px;">Стилизация:</h2>
        </article>

        <article class="setting_theme_color container_table_view">
            <table style="width:100%; margin:10px;">
                <tr>
                    <td>Изменение размера шрифта:</td>
                    <td>Ползунок</td>
                </tr>

                <tr>
                    <td>&nbsp</td>
                    <td>&nbsp</td>  
                </tr>

                <tr>
                    <td>
                        <input type="range" min="16" max="20" step="1" value="16" id="font-size">
                    </td>
                    <td class="result_font_size">

                    </td>
                </tr>

                <tr>
                    <td>&nbsp</td>
                    <td>&nbsp</td>  
                </tr>

                <tr>
                    <td>
                        <input type="button" id="apply_font" value="Применить" class="rectangle_btn btn_green">
                    </td>
                </tr>

            </table>
            
        </article>
            
        <article class="setting_theme_font container_table_view">
            <table style="width:100%; margin:10px;">
                <tr>
                    <td>Изменение цветовой гаммы:</td>
                </tr>
                <tr>
                    <td>&nbsp</td>
                    <td>&nbsp</td>  
                </tr>
                <tr>
                    <td>
                        <label for="color_1">Цветовая гамма 1</label>
                    </td>
                    
                    
                    <td>
                        <input type="radio" colorOne=#AE5174 colorTwo=#51AE8B class="radio" name="color" id="color_1" value="1">
                    </td>

                    <td>
                        <svg width="40" height="40" >
                            <circle fill="#AE5174" cx="20" cy="20" r="20"/>
                        </svg>

                    </td>
                    <td>
                        <svg width="40" height="40">
                            <circle fill="#51AE8B" cx="20" cy="20" r="20"/>
                        </svg>
                    </td>
                </tr>

                <!-- Первая цветовая палитра -->

                <tr>
                    <td>
                        <label for="color_2">Цветовая гамма 2</label>
                    </td>
                    <td>
                        <input type="radio" class="radio" colorOne="#BED02F" colorTwo="#412FD0" name="color" id="color_2" value="2">
                    </td>

                    <td>
                        <svg width="40" height="40">
                          <circle fill="#BED02F" cx="20" cy="20" r="20"/>
                        </svg>

                    </td>
                    <td>
                    <svg width="40" height="40">
                          <circle fill="#412FD0" cx="20" cy="20" r="20"/>
                        </svg>
                    </td>
                </tr>


                <tr>
                    <td>
                        <label for="color_3">Цветовая гамма 3</label>
                    </td>
                    <td>
                        <input type="radio" colorOne=#65929A colorTwo=#9A6D65 class="radio" name="color" id="color_3" value="3">
                    </td>

                    <td>
                        <svg width="40" height="40">
                          <circle fill="#65929A" cx="20" cy="20" r="20"/>
                        </svg>

                    </td>
                    <td>
                    <svg width="40" height="40">
                          <circle fill="#9A6D65" cx="20" cy="20" r="20"/>
                        </svg>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="color_4">Цветовая гамма 4</label>
                    </td>
                    <td>
                        <input type="radio" colorOne=#475477 colorTwo=#28314E class="radio" name="color" id="color_4" value="4">
                    </td>

                    <td>
                        <svg width="40" height="40">
                          <circle fill="#475477" cx="20" cy="20" r="20"/>
                        </svg>

                    </td>
                    <td>
                    <svg width="40" height="40">
                          <circle fill="#28314E" cx="20" cy="20" r="20"/>
                        </svg>
                    </td>
                </tr>

                <tr>
                    <td>&nbsp</td>
                    <td>&nbsp</td>  
                </tr>

                <script>
 

                $(document).ready(function()
                {
                    $("#apply").click(function () {
                        event.preventDefault();

                        let values = document.querySelectorAll(".radio");

                        console.log(values);

                        for(let i=0;i<values.length;i++){
                            console.log(values[i]);
                            if(values[i].checked){
                                let attr = values[i].attributes;
                                console.log(attr["colorone"]);
                                let color_first = attr["colorone"].value;
                                let color_second = attr["colortwo"].value;
                               
                                localStorage.setItem("color_first", color_first);
                                localStorage.setItem("color_second", color_second);
                                $(":root").css("--bg-color-first", color_first);
                                $(":root").css("--bg-color-second", color_second);
                            }
                        }
                        
                    });

                });
	        
            </script>
                <tr>
                    <td>
                        <input type="button" id="apply" value="Применить" class="rectangle_btn btn_green">
                    </td>
                </tr>
            </table>



            
        </article>



        <aside class="aside_table">
            <form>
                <ol class="widget-list">
                    <li><a href="/admin/service/service.php">     Услуги          </a></li>
                    <li><a href="/admin/employee/employee.php">            Сотрудники      </a></li>
                    <li><a href="/admin/customer/customer.php">            Клиенты         </a></li>
                    <li><a href="/admin/visit/visit.php" >               Посещения       </a></li>
                    <li><a href="/admin/material/material.php">            Материалы       </a></li>
                    <li><a href="/admin/consumptionmaterial/consumptionmaterial.php"> Расход материла </a></li>
                    <li><a href="/admin/freeorder/freeorder.php"> Свободные посещения </a></li>
                    <hr>
                    <li>
                        <table>
                        <tr>
                          <td style="vertical-align: middle"><img src="wallpaper/icon_setting.png" style="max-width:35px; min-width:10px;"></td>
                          <td style="vertical-align: middle"> <a href="/admin/setting.php" id="this_page">Настройки</a></td>
                        </tr>
                        </table>
                    </li>
                </ol>
            </form>  
        </aside>
         

            


        <?php 
            require_once "block/footer.php";
        ?>



        <script>
            
            $('.result_font_size').html($('input[type="range"]').val());

            $(document).on('input change', 'input[type="range"]', function() {
                $('.result_font_size').html($('input[type="range"]').val());
            });


            $("#apply_font").click(function () {
               
                
           
                let component = document.querySelector('#font-size');
                let fontSizeMain = component.value;
              
                localStorage.setItem("font-size-main", fontSizeMain);
                $(":root").css("--font-size-main", fontSizeMain + 'px');

         
            });


        </script>


    </div>



</body>
</html>
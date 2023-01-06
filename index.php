<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "beautysaloon");
    $output = '';
    $query = '';

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">

        <?php 
            require_once "block/head.php";
        ?>

<body>


    <div class="grid">


        <?php 
            require_once "block/header.php";
        ?>

        <?php
            if(isset($_SESSION['success']) && $_SESSION['success'] != '')
            {
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            }
            //На данной форме реализует alert который подсказывает клиенту прошла ли его заявка на запись услуги успешно или нет
            //Как оказалось я его буду использовать для других проверок при входе пользователя
        ?>


        <div class="div_front_side">

       

           <div class="grid_main_photo">
               <div class="div_main_photo_null_1"></div>
               <div class="div_main_photo_null_2"></div>
               <div class="div_main_photo_null_3"></div>
               <div class="div_main_photo_null_4"></div>
               <div class="div_main_photo_null_5"></div>
               
               <div class="div_main_photo_full">
                    <h1>С апреля 2008 года на службе красоты!</h1>
                    <span> За эти годы десятки тысяч  клиентов отдали предпочтение нашим салонам. Будем рады видеть Вас в числе наших клиентов!</span>
                    <input type="submit" value="Подробнее" class="rectangle_btn btn_gray" style="margin-top: 12px;">
               </div>
           </div>

        </div>


        <div class="div_we_provide" style="background-color:#433228; color:#454447">
            <div class="grid_div_we_provide">





                <div class="we_provide_first" style="padding:5px; ">
                    <div class="card_provide" >
                        <ul class="we_provide_ul">

                            <li>
                                <img src="/library/hairstyle/1.jpg">
                            </li>
                            <li style="padding:0.4em;">
                                <span>Топ-стилист или парикмахер-стилист. Это мастер причесок. Он умеет подобрать длину волос.</span>
                            </li>
                            <li>
                                <input type="submit" value="Подробнее" class="rectangle_btn btn_black" style="margin-top: 12px;">
                            </li>
                        </ul>

                    </div>
                </div>

                <div class="we_provide_second" style="padding:5px; ">
                    <div class="card_provide" >
                        <ul class="we_provide_ul">

                            <li>
                                <img src="/library/hairstyle/2.jpg">
                            </li>
                            <li style="padding:0.4em;">
                                <span>Стилист-визажист. Данный специалист точно знает, как должна краситься девушка. Он научит.</span>
                            </li>
                            <li>
                                <input type="submit" value="Подробнее" class="rectangle_btn btn_black" style="margin-top: 12px;">
                            </li>
                        </ul>

                    </div>
                </div>

                <div class="we_provide_third" style="padding:5px; ">
                    <div class="card_provide" >
                        <ul class="we_provide_ul">

                            <li>
                                <img src="/library/hairstyle/3.jpg">
                            </li>
                            <li style="padding:0.4em;">
                                <span>Стилист-имиджмейкер. Это специалист в области модной одежды. Он точно знает, какой крой.</span>
                            </li>
                            <li>
                                <input type="submit" value="Подробнее" class="rectangle_btn btn_black" style="margin-top: 12px;">
                            </li>
                        </ul>

                    </div>
                </div>



            </div>
        </div>

        <?php 
            require_once "block/customer_record_modal.php";
            require_once "block/authorization_and_registration_popup.php";
        ?>
         
        <!-- Наше модальное всплывающее окно -->




        

        <?php 
            require_once "block/footer.php";
        ?>



           
    </div>


    <script src="/script/animation_sing_up_in.js"></script>
    <script src="/script/customer_is_free_for_user.js"></script>




<!--<script src="header_scroll.js"></script> -->

</body>

</html>
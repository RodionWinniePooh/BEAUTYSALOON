<header class="header_main">
            <div class="grid_main_header">
                <div class="header_logo" style="margin-top: 0.5em;">
                    <a href="/">
                        <img src="/library/logo_svg.svg" alt="" style="max-height:60px;">
                    </a>
                    
                </div>

                

                <div class="header_li"> 

                        <ul class="li_header">
                            <li><a href="/" class="underline">Главная</a></li>
                            <li><a href="/about_us.php">О нас</a></li>
                            <li><a href="mailto:rodion.vinnichuk@gmail.com?subject=Вопрос по Beautysaloon">Контакты</a></li>
                            
                            <li><a href="/service.php">Каталог услуг</a></li>
                            <li><a href="javascript://" onclick="showModalWin();return false;">Запись</a></li>

                        </ul>


                </div>

                <div class="header_dropdown_menu">
                    <?php
                        if(!empty($_SESSION["login_user"]) && !empty($_SESSION["pass_user"])){
                            echo '  
                            <a href="/myprofile.php">                  
                            <span>
                                <img src="/library/woman.svg" alt="" style="max-height:35px; margin-top: 1.0em; cursor: pointer">
                            </span></a>
                            
                            ';
                            //echo $_SESSION["login_user"];
                            //header($admin_location);
                            //exit;
                        }
                        else{
                            echo '                    
                            <span>
                                <img src="/library/woman.svg" alt="" style="max-height:35px; margin-top: 1.0em; cursor: pointer" onclick="showModalWinRecord();return false;">
                            </span>';
                        }
                    ?>

                    <!-- <div class="dropdown" style="transform: translate(0, 45%);">
                      <span><img src="/library/woman.svg" alt="" style="max-height:35px;"></span>
                      <div class="dropdown-content">
                        <p style="font-weight:400; cursor: pointer;" onclick="showModalWinRecord();return false;">Войти или зарегистрироваться</p>
                      </div>
                    </div> -->
                </div>

                <style>
                    .dropdown {
                      
                      display: inline-block;
                    }

                    .dropdown-content {
                      display: none;
                      position: absolute;
                      background-color: #f9f9f9;
                      min-width: 120px;
                      color: white;
                      background-color: #2c5750;
                      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                      border-radius: 7px;
                      padding: 5px;
                      
                      z-index: 1;
                    }

                    .dropdown:hover .dropdown-content {
                      display: block;
                    }
                </style>

        

                <div class="header_telephone">

                        <div class="div_tel_main">
                            <div class="div_tel_child">
                                <img src="/library/logo_a1_svg.svg">
                                <a href="tel:+375293088086" >+375 29 308-80-86</a>
                            </div>

                            <div class="div_tel_child">
                                <img src="/library/logo_mts_svg.svg">
                                <a href="tel:+375293107047">+375 29 310-70-47</a>
                            </div>
                        </div>

                </div>
            </div>
</header>
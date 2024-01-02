



<!DOCTYPE html>
<html lang="ru">
    <?php 
        require_once "block/head.php";
    ?>
<body>

    <div class="grid_service">

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


        <div class="div_main_service">
            <div class="grid_service_price">
                <div class="div_list_of_services">  
                    <section class="todo-cmp" style="margin-top: 1.5rem">
                    	<header class="todo-cmp__header">
                    		<h2>Услуги</h2>
                    		<p><a href="#manicure" style="color:#497081">Услуги маникюра</a></p>
                        </header>
                    		<ul class="todo-cmp__list">
                                <?php 
                                    $query = "SELECT `name_service` FROM `service` WHERE `category` = 'Маникюр'";
                                    $result = mysqli_query($connect, $query); 

                                    while ($row = mysqli_fetch_row($result)) {
                                        echo "<li>
                                                <label>
                                                    <span>$row[0]</span>
                                                </label>
                                                
                                            
                                                </li>";
                                    }
                                    mysqli_free_result($result);
                                    
                                ?>
                            </ul>

                        <header class="todo-cmp__header">
                    		<p><a href="#pedikure" style="color:#497081">Услуги педикюра</a></p>
                        </header>
                            <ul class="todo-cmp__list">
                                    <?php 
                                        $query = "SELECT `name_service` FROM `service` WHERE `category` = 'Педикюр'";
                                        $result = mysqli_query($connect, $query); 

                                        while ($row = mysqli_fetch_row($result)) {
                                            echo "<li>
                                                    <label>
                                                        <span>$row[0]</span>
                                                    </label>


                                                    </li>";
                                        }
                                        mysqli_free_result($result);

                                    ?>
                            </ul>
                            
                    </section>
                   
                </div>

                <div class="div_service_prices" style="display:flex; flex-wrap: wrap;">
              
                          
                    <?php 
                        $query = "SELECT `id_service`, `name_service`, `price`, `description_service`, `category`, `duration_service`, `photo` 
                        FROM `service` WHERE `category` = 'Маникюр'";

                        $result = mysqli_query($connect, $query);

                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_array($result))
                            {
                                $output .= '
                                <div class="card green" style="display:block" id="manicure">
                                    <div class="additional">
                                    <div class="user-card">
                                        <img src="library/service/manicure/'.$row["photo"].'.jpg">
                                    </div>
                                    <div class="more-info">
                                            <h1>'.$row["name_service"].'</h1>
                                            <div class="coords">
                                                <span>Имя Группы</span>
                                                <span>'.$row["category"].'</span>
                                            </div>
                                            <div class="stats">
                                                <div>
                                                    <div class="title">Цена</div>
                                                        <i class="fa fa-trophy"></i>
                                                        <div class="value">'.$row["price"].' руб</div>
                                                </div>
                                            <div>
                                        </div>
                                            <div>
                                                <div class="title">Длительность услуги</div>
                                                <i class="fa fa-group"></i>
                                                <div class="value">'.$row["duration_service"].'</div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="general">
                                        <h1 style="color:#325C46">'.$row["name_service"].'</h1>
                                        <span style="color:#325C46; font-size:15px">'.$row["description_service"].'</span>
                                    </div>
                                </div>           
                            
                                ';
                            }
                            $output .= '';
                        
                            
                            
                        } ?>
                   
                        <?php
                        $query = "SELECT `id_service`, `name_service`, `price`, `description_service`, `category`, `duration_service`, `photo`
                        FROM `service` WHERE `category` = 'Педикюр'";

                  

                        $result = mysqli_query($connect, $query);

                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_array($result))
                            {
                                $output .= '
                                <div class="card green" style="display:block" id="pedikure">
                                    <div class="additional">
                                    <div class="user-card">
                                        <img src="library/service/pedicure/'.$row["photo"].'.jpg">
                                    </div>
                                    <div class="more-info">
                                            <h1>'.$row["name_service"].'</h1>
                                            <div class="coords">
                                                <span>Имя Группы</span>
                                                <span>'.$row["category"].'</span>
                                            </div>
                                            <div class="stats">
                                                <div>
                                                    <div class="title">Цена</div>
                                                        <i class="fa fa-trophy"></i>
                                                        <div class="value">'.$row["price"].' руб</div>
                                                </div>
                                            <div>
                                        </div>
                                            <div>
                                                <div class="title">Длительность услуги</div>
                                                <i class="fa fa-group"></i>
                                                <div class="value">'.$row["duration_service"].'</div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="general">
                                        <h1 style="color:#325C46">'.$row["name_service"].'</h1>
                                        <span style="color:#325C46; font-size:15px">'.$row["description_service"].'</span>
                                    </div>
                                </div>           
                            
                                ';
                            }
                            $output .= '';
                        
                            echo $output;
                            mysqli_close($connect);
                        }

                    ?>
                    


             

                     


                </div>
            </div>
        </div>


        <?php 
            require_once "block/customer_record_modal.php";
            require_once "block/authorization_and_registration_popup.php";
        ?>


<script src="/script/animation_sing_up_in.js"></script>
<script src="/script/customer_is_free_for_user.js"></script>

<script>
    $("body").on('click', '[href*="#"]', function(e){
        var fixed_offset = 100;
        $('html,body').stop().animate({ scrollTop: $(this.hash).offset().top - fixed_offset }, 1000);
        e.preventDefault();
    });


</script>

        <?php
            require_once "block/footer.php";
        ?>

    </div>
    
</body>
</html>
<?php
    $connect = mysqli_connect("localhost", "root", "", "beautysaloon");
    $output = '';
    $query = '';
?>

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

      <style>



            .card {
            
              width: 450px;
              height: 250px;
              background-color: #fff;
              background: linear-gradient(#f8f8f8, #fff);
              box-shadow: 0 8px 16px -8px rgba(0,0,0,0.4);
              border-radius: 6px;
              overflow: hidden;
              position: relative;
              margin: 1.5rem;
            }

            .card h1 {
              text-align: center;
            }

            .card .additional {
              position: absolute;
              width: 150px;
              height: 100%;
              background: linear-gradient(#dE685E, #EE786E);
              transition: width 0.4s;
              overflow: hidden;
              z-index: 2;
            }

            .card.green .additional {
              background: linear-gradient(#92bCa6, #A2CCB6);
            }


            .card:hover .additional {
              width: 100%;
              border-radius: 0 5px 5px 0;
            }

            .card .additional .user-card {
              width: 150px;
              height: 100%;
              position: relative;
              float: left;
            }

            .card .additional .user-card::after {
              content: "";
              display: block;
              position: absolute;
              top: 10%;
              right: -2px;
              height: 80%;
              border-left: 2px solid rgba(0,0,0,0.025);*/
            }

            .card .additional .user-card .level,
            .card .additional .user-card .points {
              top: 15%;
              color: #fff;
              text-transform: uppercase;
              font-size: 0.75em;
              font-weight: bold;
              background: rgba(0,0,0,0.15);
              padding: 0.125rem 0.75rem;
              border-radius: 100px;
              white-space: nowrap;
            }

            .card .additional .user-card .points {
              top: 85%;
            }

            .user-card>img{
                max-width:140px; 
                border-radius:50%; 
                padding:4.8px; 
                margin-top:3em;
            }



            .card .additional .more-info {
              width: 300px;
              float: left;
              position: absolute;
              left: 150px;
              height: 100%;
            }

            .card .additional .more-info h1 {
              color: #fff;
              margin-bottom: 0;
            }

            .card.green .additional .more-info h1 {
              color: #224C36;
            }

            .card .additional .coords {
              margin: 0 1rem;
              color: #fff;
              font-size: 1rem;
            }

            .card.green .additional .coords {
              color: #325C46;
            }

            .card .additional .coords span + span {
              float: right;
            }

            .coords{
                padding: 5px; 
            }

            .card .additional .stats {
              font-size: 2rem;
              display: flex;
              position: absolute;
              bottom: 1rem;
              left: 1rem;
              right: 1rem;
              top: auto;
              color: #fff;
            }

            .card.green .additional .stats {
              color: #325C46;
            }

            .card .additional .stats > div {
              flex: 1;
              text-align: center;
            }

            .card .additional .stats i {
              display: block;
            }

            .card .additional .stats div.title {
              font-size: 0.75rem;
              font-weight: bold;
              text-transform: uppercase;
            }

            .card .additional .stats div.value {
              font-size: 1.5rem;
              font-weight: bold;
              line-height: 1.5rem;
            }

            .card .additional .stats div.value.infinity {
              font-size: 2.5rem;
            }

            .card .general {
              width: 300px;
              height: 100%;
              position: absolute;
              top: 0;
              right: 0;
              z-index: 1;
              box-sizing: border-box;
              padding: 1rem;
              padding-top: 0;
            }

            .card .general .more {
              position: absolute;
              bottom: 1rem;
              right: 1rem;
              font-size: 0.9em;
            }
      </style>

        <style>

            .todo-cmp {
                margin: auto;
            	background: #ffffff;
            	color: #497081;
            	padding: 10px 30px;
            	border-radius: 5px;
            	box-shadow: 2px 2px 14px rgba(0,0,0,0.15);
            	width: 180px;
            
            	&__header {
            		text-align: center;
            		padding: 10px 0;
            		border-bottom: 1px solid #ddd;
                 
                
            		h2 {
            			font-weight: 600;
            			font-size: 1.2rem;
            			margin: 4px auto;
            			padding: 0;
            		}
            		p {
            			padding: 0 0 5px;
            			margin: 4px auto;
            			font-size: 0.8rem;
            		}
            	}
            
            	&__list {
            		list-style: none;
            		padding: 0;
                
            		li {
            			padding: 10px 0 15px;
            			margin: 0;
            			text-align: left;
            			width: 100%;
                    
            			label {
            				cursor: pointer;
            				font-size: 0.82rem;
            				width: 100%;
            				display: block;
                        
                        
            				input {
            					float: right;
            					opacity: 0;
            				}
                        
            				span {
            					position: relative;
            					display:block;
            					transition: all 550ms ease-in-out;
            				}
            			}
            		}
            	}
            }
        </style>

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
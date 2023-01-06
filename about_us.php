<?php
    session_start();
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

        <?php
            if(isset($_SESSION['success']) && $_SESSION['success'] != '')
            {
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            }
            //На данной форме реализует alert который подсказывает клиенту прошла ли его заявка на запись услуги успешно или нет
            //Как оказалось я его буду использовать для других проверок при входе пользователя
        ?>

    <div class="grid_about_us">

        <?php 
            require_once "block/header.php";
        ?>

        <div class="div_about_us">
            <!-- in a wrapping section include different containers for each step of the flow: data sources, build, deploy -->
            <section class="container">

            	<!-- in the sources container show three cards, side by side, or one atop the other on smaller viewports -->
            	<div class="container__sources">

            		<div class="sources--cms">
                        
            			<h3>Адрес</h3>
                        <p>ул.Леонида Беды 33</p>
                        <p>ул.Белинского 54</p>
                      
            		</div>

            		<div class="sources--markdown">
            			<h3>Время работы</h3>
            			<p>С 9:00 до 21:30</p>
            		</div>

            		<div class="sources--data">
            			<h3>Номера телефонов</h3>
                        <p>+375(29)308-80-86</p>
                        <p>+375(29)310-70-47</p>
            		</div>

            	</div>

            	<!-- include a simple line to divide the container, and animate it to show a connection between the different containers  -->
            	<svg viewbox="0 0 10 100">
            		<line x1="5" x2="5" y1="0" y2="100" />
            	</svg>

            	<!-- in the build container show two cards, atop of one another and the first of one showing an SVG icon -->
            	<div class="container__build">

            		<div class="build--powered" style="background-color: white">
                        <img src="/library/myata_brows.jpg" style="max-height:80px; border-radius:50px;" alt="">
            			<!-- <svg viewbox="0 0 100 100">
            				<circle cx="50" cy="50" r="50" />
            			</svg> -->
            			<p>БРОВИ|ЛАМИНИРОВАНИЕ</p>
            			<h3>Myata_brows</h3>
            		</div>

            	</div>

            	<!-- repeat the svg line to connect the second and third containers as well -->
            	<svg viewbox="0 0 10 100">
            		<line x1="5" x2="5" y1="0" y2="100" />
            	</svg>

            	<!-- in the deploy container show simply text, without a wrapping card -->
            	<div class="container__deploy" style="max-width:700px;">
            		<h3>Beautysaloon</h3>
            		<p>Beautysaloon в Минске – это место, где каждый клиент является VIP-персоной. Приезжайте к нам всей семьей – мы будем вам рады всегда и окажем услуги на высшем уровне!</p>
            	</div>

            </section>
            
        </div>

        <div class="div_about_us_map">
            <div>
            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Aaecb94c14787247c2a1b0b942538fb6724be108e9eb01bf4ba7c8cb2004b2110&amp;source=constructor" width="100%" height="425" frameborder="0"></iframe>                </div>
        </div>

        <?php 
            require_once "block/customer_record_modal.php";
            require_once "block/authorization_and_registration_popup.php";
        ?>


        <?php 
            require_once "block/footer.php";
        ?>

<style>
        @import url("https://fonts.googleapis.com/css?family=Mukta:300,400,700");
    .tooltip,
    .container__sources:before,
    .container__build:before,
    .container__deploy:before {
      position: absolute;
      right: 0;
      bottom: 100%;
      color: #454447;
      background: #ffb238;
      text-transform: uppercase;
      font-size: 0.9rem;
      padding: 0.25rem 0.75rem;
      border-radius: 2.5px;
    }
    .card,
    .container__sources div,
    .container__build div {
      line-height: 2;
    
      background: white;
      padding: 1.2rem 1rem;
      border-radius: 4px;
      /* box-shadow: 0 2px 10px #e6e6e6; */
    }


    .container {
      /* margin: 5vh 2.5vw; */
      padding: 15vh 0;
      background-image: url(library/back_about_us.jpg);
    
      border-radius: 5px;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
    .container svg {
      height: 5rem;
    }
    .container svg line {
      stroke: white;
      stroke-width: 3px;
      stroke-linecap: round;
      stroke-dasharray: 2px 20px;
      animation: animateline 5s linear both infinite;
    }
    h3 {
      font-size: 1.1rem;
      color: #454447;
    }
    p {
      font-size: 0.95rem;
      font-weight: 300;
      color:#454447;
    }
    .container__sources {
      display: flex;
      border-radius: 8px;
      padding: 1.5rem;
      background: white;
      position: relative;
    }
    .container__sources:before {
      content: 'О нас';
    }
    .container__sources div {
      text-align: left;
      margin: 0 1rem;
    }
    .container__build {
      padding: 10vh 10vw;
      border-radius: 8px;
      background-image:url(/library/myata_brows_3.jpg);
      /* background: #f9f9f9; */
      position: relative;
    }
    .container__build:before {
      content: 'Наши партнёры';
    }
    .container__build div {
      margin: 2rem 0;
    }
    .container__build div svg {
      width: 4rem;
      height: auto;
      fill: #5f39dd;
    }
    .container__deploy {
      background: #f9f9f9;
      padding: 1.5rem;
      border-radius: 8px;
      position: relative;
    }
    .container__deploy:before {
      content: 'VIP';
    }
    @media (max-width: 700px) {
      .container__sources {
        flex-direction: column;
      }
      .container__sources div {
        margin: 1rem 0;
      }
    }
    @-moz-keyframes animateline {
      from {
        stroke-dashoffset: 0;
      }
      to {
        stroke-dashoffset: -5rem;
      }
    }
    @-webkit-keyframes animateline {
      from {
        stroke-dashoffset: 0;
      }
      to {
        stroke-dashoffset: -5rem;
      }
    }
    @-o-keyframes animateline {
      from {
        stroke-dashoffset: 0;
      }
      to {
        stroke-dashoffset: -5rem;
      }
    }
    @keyframes animateline {
      from {
        stroke-dashoffset: 0;
      }
      to {
        stroke-dashoffset: -5rem;
      }
    }

</style>



    </div>

    <script src="/script/animation_sing_up_in.js"></script>
    <script src="/script/customer_is_free_for_user.js"></script>
    
</body>
</html>
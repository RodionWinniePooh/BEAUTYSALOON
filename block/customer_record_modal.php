<?php
// Подключение к базе данных
$connect = mysqli_connect("localhost", "root", "", "beautysaloon");

// Проверка соединения
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}


?>

<div id="popupWin" class="modalwin">
            <form class="form_record" method="post" action="/admin/query_add.php">



                <h3 class="h3-form_record">Запись</h3>

                <div>
                    <label class="clr_gray">Введите номер телефона:</label>
                </div>
                <br>

                <div>
	        	    <input class="input_min" type="text" id="phone" name="phone_number" required/>
                </div>

                <script>
                    $(function(){
                        //2. Получить элемент, к которому необходимо добавить маску маска подключается через jquery
                        $("#phone").mask("+375(99)999-99-99");
                    });
                </script>

                <br>
                <div>
                    <label class="clr_gray">Выберите услугу:</label>
                </div>
                
                <br>

                <div>
                    <select name="name_service" required class="input_min" style="max-width:200px;">
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
                    <label class="clr_gray">Дата посещения:</label>
                </div>
                    <br>
                <div>
                    <input type="date" id="DateNow" name="date_of_visit" placeholder="Введите дату" class="input_min" required>
                </div>

                <script>
                    function SetMinDate() 
                    {
                        var now = new Date();
                        var day = ("0" + now.getDate()).slice(-2);
                        var month = ("0" + (now.getMonth() + 1)).slice(-2);
                        var today = now.getFullYear() + "-" + (month) + "-" + (day);
                        $('#DateNow').val(today);
                        $('#DateNow').attr('min', today); 
                    }
                    SetMinDate();
                </script>

                <br>
                <div>
                    <label class="clr_gray">Время посещения:</label>
                </div>
                <br>

                <div>
                    <label class="clr_gray">С 9:00 &nbsp</label>
                    <input type="text" size="6" id="visit" name="time_of_visit" required pattern="(09|10|11|12|13|14|15|16|17|18|19|20|21):([3]{1}|[0]{1})[0]{1}" class="input_min" title="Минуты указывать в формате **:00 или **:30">
                    <label class="clr_gray">До 21:30 &nbsp</label>
                    <script>
                        $("#visit").inputmask({"mask": "99:99"});
                    </script>                        
                </div>

                <br>
                    <div>
                        <label class="clr_gray">ФИО сотрудника:</label>
                    </div>
                    <br>
                    <div >
                        <select name="full_name_employee" required class="input_min" id="customer_is_free" style="max-width:200px;">
                                
                        </select>
                    </div>

	        	<button class="form_record-btn log-in" type="submit" name="add_visit_user">
		    		Подтвердить
                </button>
                

	        </form>
        </div>
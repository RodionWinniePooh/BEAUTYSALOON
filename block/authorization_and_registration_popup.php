<div id="popupWinRecord" class="modalwin">
            <form class="signUp" method="post" action="/admin/query_add.php">
                <h3 class="h3-sign_form">Создать аккаунт</h3>

                <div>
                    <label class="clr_gray">Email:</label>
                </div>

                <br>   
                <div>             
                    <input class="input_min" name="email" type="email" required autocomplete='off' />
                </div>
                <br>
                
                <div>
                    <label class="clr_gray" type="text">Введите номер телефона:</label>
                </div>
                <br>

                <div>
	        	    <input class="input_min" type="text" id="phone_signUp" name="phone_number" required/>
                </div>
                <script>
                    $(function(){
                        //2. Получить элемент, к которому необходимо добавить маску маска подключается через jquery
                        $("#phone_signUp").mask("+375(99)999-99-99");
                    });
                </script>
                <br>
                <div>
                    <label class="clr_gray">Фамилия и Имя:</label>
                </div>
                <br>
                <div>
                    <input type="text" name="first_and_last_name" required class="input_min" size="25">
                </div>
                <br>
                <div>
                    <label class="clr_gray">Введите пароль:</label>
                </div>
                <br>

                <div>
                    <input class="input_min" name="pass_up" type="password" id="password1" minlength="5" maxlength="40" required />
                </div>
                <br>
                <div>
                    <label class="clr_gray">Подтвердтие пароль:</label>
                </div>
                <br>
                <div>
                    <input class="input_min" type="password" id="password2" minlength="5" maxlength="40" required />
                </div>

                <button class="form-btn sx log-in" type="button">Вход</button>
                <button class="form-btn dx" name="add_customer_user" type="submit" onclick="return validateForm()">Регист.</button>

                <script>
                    function validateForm () {
                        // проверяем пароли
                        // выбираем элементы
                        var password1 = document.getElementById('password1');
                        var password2 = document.getElementById('password2');
                        // сравниваем написанное, если не равно, то:
                        if (password1.value !== password2.value) {
                            // сообщаем пользователю, можно сделать как угодно
                            alert('Пароли не совпадают!');
                            // сообщаем браузеру, что не надо обрабатывать нажатие кнопки
                            // как обычно, т. е. не надо отправлять форму
                            return false; 
                        }
                    }

                </script>

            </form>
            <form class="signIn" method="post" action="/admin/query_add.php">
                <h3 class="h3-sign_form">Вход!</h3>
                <!-- Авторизация -->

                <div>
                    <label class="clr_gray">Введите номер телефона:</label>
                </div>
                <br>

                <div>
	        	    <input class="input_min" type="text" id="phone_signIn" name="phone_number_user" required/>
                </div>
                <br>

                <script>
                    $(function(){
                        //2. Получить элемент, к которому необходимо добавить маску маска подключается через jquery
                        $("#phone_signIn").mask("+375(99)999-99-99");
                    });
                </script>

                <div>
                    <label class="clr_gray">Введите пароль:</label>
                </div>
                <br>

                
                <input class="input_min" type="password" name="pass_user" minlength="5" maxlength="40" reqired />

                <button class="form-btn sx back" type="button">Назад</button>
                <button class="form-btn dx" type="submit" name="button_auth">Вход</button>
            </form>
        </div>
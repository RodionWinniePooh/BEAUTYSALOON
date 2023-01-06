        <header class="header_logo">
            <a href="../index.php">Beautysaloon</a>
            <style>
                a{
                    font-size:18px;
                    text-decoration: none;
                    color: inherit;
                }

                a:hover 
                {
                    cursor:pointer;  
                }


            </style>
        </header>
        <header class="header_li">  
            <a href="/admin/index.php">Главная Администратора</a>
        </header>

        <header class="exit_account">
            <form action="" method="post">
                <table>
                        <tr>
                            <td style="vertical-align: middle"><label>Логин: <u><?php echo $_SESSION["login_admin"]; ?></u></label></td>
                            <td style="vertical-align: middle">
                                <input type="submit" name="button_exit" value="Выйти" class="rectangle_btn btn_gray" style="">
                            </td>
                        </tr>
                </table>

            </form>

        </header>
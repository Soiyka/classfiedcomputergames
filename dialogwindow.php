        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom"> <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"> <svg class="bi me-2" width="40" height="32" aria-hidden="true"><usexl:href="#bootstrap"></use></svg> <span class="fs-4">Классификация компьютерных игр</span> </a> <ul class="nav nav-pills"> <li class="nav-item"><a href="index.php" class="nav-link" aria-current="page">Home</a></li><li class="nav-item">
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
        <script>
        $( function() {
          $( "#dialog" ).dialog({
            autoOpen: false,

          });
        $("#button_reg").on( "click", function() {
            $( "#login" ).hide();
            $( "#reg" ).show();
          });
         $("#button_login").on( "click", function() {
            $( "#login" ).show();
            $( "#reg" ).hide();
          });
        $( "#opener" ).on( "click", function() {
            $( "#dialog" ).dialog( "open" );
          });
        } );
        </script>
          <div id="dialog" title="Basic dialog">
                    <div class="container">
                <div class="form-container">
                    <div id="login">
                        <h2>Вход</h2>
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" placeholder="Введите ваш email">
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Пароль:</label>
                                <input type="password" id="password" name="password" placeholder="Введите ваш пароль">
                            </div>
                            
                            <button type="submit" class="btn">Войти</button>
                        </form>
                            <div class="text-center">
                                <p>Нет аккаунта? <button id="button_reg" class="link">Зарегистрируйтесь</button></p>
                             </div>
                    </div>
                    <div style="display:none" id="reg">
                        <h2>Регистрация</h2>
                        <form action="register.php" method="POST">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="username" id="username" name="username" placeholder="Введите ваше имя">
                            </div>
                                
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" placeholder="Введите ваш email">
                            </div>
                                
                            <div class="form-group">
                                <label for="password">Пароль:</label>
                                <input type="password" id="password" name="password" placeholder="Введите пароль">
                            </div>
                            
                            <button type="submit" class="btn">Зарегистрироваться</button>
                            
                        </form>
                            <div class="text-center">
                                <p>Есть аккаунт? <button id="button_login" class="link">Войдите</button></p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="nav-link active" aria-current="page" id="opener">Log/Reg</button>
        </div></li> </ul>
    </header>
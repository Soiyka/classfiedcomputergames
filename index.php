<?php
session_start();

$username = $_SESSION['username'] ?? '';
$email = $_SESSION['email'] ?? '';


?>
<?php
 // Кол-во элементов
include('config.php');
$limit = 12; 
 // Получение записей для первой страницы
$sth = $pdo->prepare("SELECT * FROM `Game` LIMIT {$limit}");
$sth->execute();    
$items = $sth->fetchAll(PDO::FETCH_ASSOC);    
        
// Кол-во страниц 
$sth = $pdo->prepare("SELECT COUNT(`id_game`) FROM `Game`");
$sth->execute();
$total = $sth->fetch(PDO::FETCH_COLUMN);
$amt = ceil($total / $limit);
?>
    <script src="/jquery/2.1.1/jquery.min.js"></script>
        <script>
        var block_show = false;
        
        function scrollMore(){
            var $target = $('#showmore-triger');
            
            if (block_show) {
                return false;
            }
        
            var wt = $(window).scrollTop();
            var wh = $(window).height();
            var et = $target.offset().top;
            var eh = $target.outerHeight();
            var dh = $(document).height();   
         
            if (wt + wh >= et || wh + wt == dh || eh + et < wh){
                var page = $target.attr('data-page');    
                page++;
                block_show = true;
        
                $.ajax({ 
                    url: '/ajax.php?page=' + page,  
                    dataType: 'html',
                    success: function(data){
                        $('#showmore-list .game-list').append(data);
                        block_show = false;
                    }
                });
        
                $target.attr('data-page', page);
                if (page ==  $target.attr('data-max')) {
                    $target.remove();
                }
            }
        }
         
        $(window).scroll(function(){
            scrollMore();
        });
            
        $(document).ready(function(){ 
            scrollMore();
        });
        </script>
        
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="styles.css">
    <title>Классификация компьтерных игр</title>
</head>
<body>
    <style>
        .footer {  
            position: fixed;  
            bottom: 0;  
            left: 0;  
            right: 0;  
            height: 50px;
            background-color: black;
            }  
        
        .header{  
            position: fixed;  
            top: 0;  
            left: 0;  
            right: 0;  
            height: 50px;
            background-color: black;
        }
        
        .headerh1{
            text-align: left;
            color: grey;
            font-size: 20px;
        }
        
        .footerh1{
            text-align: center;
            color: grey;
            font-size: 20px;
        }
        
        .footer{  
            position: fixed;  
            bottom: 0;  
            left: 0;  
            right: 0;  
            height: 50px;
            background-color: black;
        }
    </style>
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom"> <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"> <svg class="bi me-2" width="40" height="32" aria-hidden="true"><usexl:href="#bootstrap"></use></svg> <span class="fs-4">Классификация компьютерных игр</span> </a> <ul class="nav nav-pills"> <li class="nav-item"><a href="index.php" class="nav-link" aria-current="page">Home</a></li><li class="nav-item"><a href="register.php" class="nav-link active" aria-current="page">Log/Reg</a></li>
        </div></li> </ul>
    </header>
    <main>
        <container id="showmore">
         <div id="showmore-list">
            <div class="game-list">
                <?php foreach ($items as $row): ?>
                <div class="game-item">
                    <div class="game-item-img">
                        <img src="/images/<?php echo $row['img']; ?>" alt="">    
                    </div>
                    <div class="game-item-name">
                        <?php echo $row['name']; ?>        
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <style type="text/css">
            #showmore-triger {
            	text-align: center;
            	padding: 10px;
            	background: #ffdfdf;
            }
            
            /* Вывод товаров */
            .game-list {
            	overflow: hidden;
            	margin: 0 auto 20px;
            	width: 692px;
            }
            .game-item {
            	width: 174px;
            	height: 230px;
            	float: left;
            	border: 1px solid #ddd;
            	padding: 20px;
            	margin: 0 20px 20px 0;
            	text-align: center;
            	border-radius: 6px;
            }
            .game-item-img {
            	width: 100%;
            }
            .game-item-name {
            	font-size: 13px;
            	line-height: 16px;
            }
            
            .game-list .game-item:nth-child(3n) {
            	margin-right: 0
            }
            .showmore{
                border-color: red;
                width: 500px;
                height: 500px;
                display: flex;
                align-items: right;
                justify-content: center;
                height: 100%;
            }
        </style>
        </container>
        <div id="showmore-triger" data-page="1" data-max="<?php echo $amt; ?>">
            <img src="ajax-loader.gif" alt="">
        </div>
    </main>
<footer class="py-3 my-4"> 
<ul class="nav justify-content-center border-bottom pb-3 mb-3"> <a href='https://www.anekdot.ru/'><img src='pic.jpg'/></a></ul> <p class="text-center text-body-secondary">© 2025 XDD, Inc</p> 
</footer>
</body>
</html>


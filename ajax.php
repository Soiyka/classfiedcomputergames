<?php
// Кол-во элементов
$limit = 12; 

// Подключение к БД
$dbh = new PDO('mysql:dbname=sazanov.s.r;host=infrastructure.mariadb', 'sazanov.s.r', '4412');

// Получение записей для текущей страницы
$page = intval(@$_GET['page']);
$page = (empty($page)) ? 1 : $page;				
$start = ($page != 1) ? $page * $limit - $limit : 0;
$sth = $dbh->prepare("SELECT * FROM `Game` LIMIT {$start}, {$limit}");
$sth->execute();	
$items = $sth->fetchAll(PDO::FETCH_ASSOC);				

foreach ($items as $row) {
	?>
	<div class="game-item">
		<div class="game-item-img">
			<img src="/images/<?php echo $row['img']; ?>" alt="">	
		</div>
		<div class="game-item-name">
			<?php echo $row['name']; ?>		
		</div>
	</div>
	<?php
}
<h2>Главная страница</h2>

<?php foreach($news as $val): ?>
    <h4><?php echo $val['title']; ?></h4>
    <p><?php echo $val['descrip']; ?></p>
    <hr>
<?php endforeach; ?>
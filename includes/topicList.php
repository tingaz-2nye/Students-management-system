<?php 
    require_once ('../config/database.php');
    require_once ('functions.php');


	
    $posts = get_posts($db);

         while ($row = $posts->fetch()) { ?>
            <li  class="list-group-item">
                <a href="?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
            </li>
<?php } ?>
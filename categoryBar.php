

<div id="left-column">
    <nav>
<!-- can add new category this way, the type must be exactly same as category in database table -->
    <ul>
    <a href="index.php" class=<?php if(!$_GET['type']){echo 'selected-nav';} ?>><li class="li-category">All</li></a>
    <a href="index.php?type=audio accessory"><li class="li-category <?php if($_GET['type'] == 'audio accessory'){echo 'selected-nav';}?>">Audio Accessory</li></a>
    <a href="index.php?type=gaming device"><li class="li-category <?php if($_GET['type'] == 'gaming device'){echo 'selected-nav';}?>">Gaming Devices</li></a>
    <a href="index.php?type=GPU"><li class="li-category <?php if($_GET['type'] == 'GPU'){echo 'selected-nav';}?>">GPU</li></a>
    <a href="index.php?type=Laptop"><li class="li-category <?php if($_GET['type'] == 'Laptop'){echo 'selected-nav';}?>">Laptops</li></a>
    <li>Brands:</li>
    <form action="index.php" method="GET">
    <li><input type="radio" name="brand" value="sony" id="price" onclick="this.form.submit()" <?php if($_GET['brand'] == 'sony'){echo 'checked';} ?>>Sony</li>
    <li><input type="radio" name="brand" value="apple" id="price" onclick="this.form.submit()" <?php if($_GET['brand'] == 'apple'){echo 'checked';} ?>>Apple</li>
</ul>    
</form>
    </nav>
</div>
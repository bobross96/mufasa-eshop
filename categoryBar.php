

<div id="left-column">
    <nav>
<!-- can add new category this way, the type must be exactly same as category in database table -->
    <ul><a href="member.php" class=<?php if(!$_GET['type']){echo 'selected-nav';} ?>>All</a> </ul>
    <ul><a href="member.php?type=audio accessory" class=<?php if($_GET['type'] == 'audio accessory'){echo 'selected-nav';} ?>>Audio Accessory</a> </ul>
    <ul><a href="member.php?type=gaming device" class=<?php if($_GET['type'] == 'gaming device'){echo 'selected-nav';} ?>>Gaming Devices</a></ul>
    <ul><a href="member.php?type=GPU" class=<?php if($_GET['type'] == 'GPU'){echo 'selected-nav';} ?>>GPU</a></ul>
    <ul><a href="member.php?type=Laptop" class=<?php if($_GET['type'] == 'Laptop'){echo 'selected-nav';} ?>>Laptops</a></ul>
    <ul>Brands:</ul>
    <form action="member.php" method="GET">
    <ul><input type="radio" name="brand" value="sony" id="price" onclick="this.form.submit()" <?php if($_GET['brand'] == 'sony'){echo 'checked';} ?>>Sony</ul>
    <ul><input type="radio" name="brand" value="apple" id="price" onclick="this.form.submit()" <?php if($_GET['brand'] == 'apple'){echo 'checked';} ?>>Apple</ul>
    </form>
    </nav>
</div>
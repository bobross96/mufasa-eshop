






<div>
    <nav>
<!-- can add new category this way, the type must be exactly same as category in database table -->
    <ul><a href="member.php">All</a> </ul>
    <ul><a href="member.php?type=audio accessory">Audio Accessory</a> </ul>
    <ul><a href="member.php?type=gaming device">Gaming Devices</a></ul>
    <ul><a href="member.php?type=GPU">GPU</a></ul>
    <ul><a href="member.php?type=Laptop">Laptops</a></ul>
    <ul>Brands:</ul>
    <form action="" method="GET">
    <ul><input type="radio" name="brand" value="sony" id="price" onclick="this.form.submit()" <?php if($_GET['brand'] == 'sony'){echo 'checked';} ?>>Sony</ul>
    <ul><input type="radio" name="brand" value="apple" id="price" onclick="this.form.submit()" <?php if($_GET['brand'] == 'apple'){echo 'checked';} ?>>Apple</ul>
    </form>
    </nav>
</div>
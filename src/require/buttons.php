<?php
// Initialize $activePage if it's not already set
if (!isset($activePage)) {
    $activePage = ''; // Default value or '' if no page is active
}
?>

<div class="buttons">
    <?php
    $buttons = [
        ['url' => '/index.php', 'name' => 'Home', 'active' => $activePage == "index"],
        ['url' => '/page/wallet.php', 'name' => 'Wallet', 'active' => $activePage == "wallet"],
        ['url' => '/page/character.php', 'name' => 'Characters', 'active' => $activePage == "character"],
        ['url' => '/page/hoverboard.php', 'name' => 'Hoverboards', 'active' => $activePage == "hoverboard"],
        ['url' => '/page/portraits.php', 'name' => 'Portraits', 'active' => $activePage == "portraits"],
        ['url' => '/page/frames.php', 'name' => 'Frames', 'active' => $activePage == "frames"],
        ['url' => '/page/badges.php', 'name' => 'Badges', 'active' => $activePage == "badges"],
        ['url' => '/page/upgrades.php', 'name' => 'Upgrades', 'active' => $activePage == "upgrades"],
        ['url' => '/page/toprun.php', 'name' => 'Top Run', 'active' => $activePage == "toprun"]
    ];

    foreach ($buttons as $index => $button) {
        if ($index == 6) {
            echo '</div><div class="buttons">'; // Close the first row and start a new one
        }
        ?>
        <a href="<?php echo $button['url']; ?>"
            class="btn <?php echo $button['active'] ? 'btn-primary' : 'btn-secondary'; ?>">
            <?php echo $button['name']; ?>
        </a>
    <?php } ?>
</div>
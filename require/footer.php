<footer>
  <p style="color: #aaa; font-size: 17px">
    <i class="fab fa-github"></i>
    <a
      href="https://github.com/HerrErde/subway_gen"
      >github.com/HerrErde/subway_gen</a
    >
    <?php
    // Execute the Git command to retrieve the hash of the current commit
    $hash = shell_exec("git rev-parse HEAD");

    // Extract the first 7 characters of the hash
    $short_hash = substr($hash, 0, 7);

    // Construct the URL to the commit on GitHub
    $commit_url = "https://github.com/HerrErde/subway_gen/commit/$hash";

    // Output a link to the commit with the short hash
    echo "<a class='link' href=\"$commit_url\">$short_hash</a>";
    ?>
  <hr />
  <p style="font-size: 15px">
    ©
    <?php echo date("Y"); ?>
    <a href="https://dev.herrerde.xyz" class="rainbow">HerrErde</a>, all rights
    reserved
  </p>
</footer>

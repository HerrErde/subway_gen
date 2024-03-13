<footer>
    <p>
        <?php
        // Calculate the page loading time in milliseconds
        $endTime = microtime(true);
        $pageLoadTime = ($endTime - $_SERVER["REQUEST_TIME_FLOAT"]) * 1000;

        // Display the page loading time
        echo "Page loaded in " . round($pageLoadTime, 2) . " ms";
        ?>
    </p>

    <p>
        <i class="fab fa-github"></i>
        <a href="https://github.com/HerrErde/subway_gen" style="color: darkgray;" target='_blank'>
            github.com/HerrErde/subway_gen
        </a>

        <?php
        // Execute the Git command to retrieve the hash of the current commit
        $hash = trim(shell_exec("git rev-parse HEAD"));

        // Extract the first 7 characters of the hash
        $short_hash = substr($hash, 0, 7);

        // Construct the URL to the commit on GitHub
        $commit_url = "https://github.com/HerrErde/subway_gen/commit/$hash";

        // Output a link to the commit with the short hash
        echo "<a class='link' style='color: white;' href='$commit_url' target='_blank'>$short_hash</a>";
        ?>
    </p>
    <hr>

    <p style="font-size: 15px">
        &copy;
        <?php echo date("Y"); ?>
        <a class="rainbow" href="https://dev.herrerde.xyz" target='_blank'>HerrErde</a>, all rights reserved
    </p>
</footer>
```php
<?php
// post_fetcher.php for WordPress AI Content Enhancer

require_once('config.php');
require_once('browser.php');

function fetch_posts($html_content) {
    // Create a new DOMDocument instance
    $dom = new DOMDocument;

    // Suppress errors due to malformed HTML
    libxml_use_internal_errors(true);

    // Load the HTML content
    $dom->loadHTML($html_content);

    // Clear the errors
    libxml_clear_errors();

    // Create a new DOMXPath instance
    $xpath = new DOMXPath($dom);

    // Query all post links
    $post_links = $xpath->query("//a[contains(@class, 'row-title')]");

    // Create an array to store the post URLs
    $post_urls = array();

    // Iterate over each post link
    foreach ($post_links as $link) {
        // Get the href attribute
        $href = $link->getAttribute('href');

        // Append the post URL to the array
        $post_urls[] = WORDPRESS_SITE_URL . '/wp-admin/' . $href;
    }

    // Return the post URLs
    return $post_urls;
}

// Call the function to fetch WordPress posts
$post_urls = fetch_posts($posts_page);

// Check if fetching was successful
if (count($post_urls) > 0) {
    echo "Successfully fetched " . count($post_urls) . " posts.\n";
} else {
    echo "Failed to fetch any posts. Please check your WordPress site URL and login details.\n";
}
?>
```

```php
<?php
// login.php for WordPress AI Content Enhancer

require_once('config.php');

function login_to_wordpress($url, $username, $password) {
    // Create a new cURL resource
    $ch = curl_init();

    // Set the URL
    curl_setopt($ch, CURLOPT_URL, $url . '/wp-login.php');

    // Enable the POST method
    curl_setopt($ch, CURLOPT_POST, 1);

    // Set the POST data
    $post_data = 'log=' . urlencode($username) . '&pwd=' . urlencode($password);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

    // Follow redirects, if any
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // Receive server response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Maintain session
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');

    // Execute the request
    $result = curl_exec($ch);

    // Close cURL resource
    curl_close($ch);

    // Check if login was successful
    if (strpos($result, 'Dashboard') !== false) {
        return true;
    } else {
        return false;
    }
}

// Call the function to log in to WordPress
if (login_to_wordpress(WORDPRESS_SITE_URL, WORDPRESS_USERNAME, WORDPRESS_PASSWORD)) {
    echo "Successfully logged in to WordPress.\n";
} else {
    echo "Failed to log in to WordPress. Please check your username and password.\n";
}
?>
```

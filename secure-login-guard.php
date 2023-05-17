<?php
/*
  Plugin Name:       Secure Login Guard
  Plugin URI:        
  Description:       Limits the number of login attempts both through normal login and using auth cookies.
  Version:           1.0
  Requires at least: 5.2
  Requires PHP:      7.2
  Author:            Khondakar Moksud Ahmed
  Author URI:        
  License:           GPL v2 or later

                    Secure Login Guard is free software: you can redistribute it and/or modify
                    it under the terms of the GNU General Public License as published by
                    the Free Software Foundation, either version 2 of the License, or
                    any later version.

                    Secure Login Guard is distributed in the hope that it will be useful,
                    but WITHOUT ANY WARRANTY; without even the implied warranty of
                    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
                    GNU General Public License for more details.

                    You should have received a copy of the GNU General Public License
                    along with Secure Login Guard. If not, see {URI to Plugin License}.

  License URI:       https://www.gnu.org/licenses/gpl-2.0.html
  Update URI:        
  Text Domain:       secure-login-guard
  Domain Path:       /languages
 */
// Add hooks for secure login guard
add_filter('authenticate', 'secure_login_guard', 30, 3);
add_action('wp_login_failed', 'log_secure_login_guard');

// Limit the number of retry attempts when logging in (for each IP)
function secure_login_guard($user, $username, $password) {
    // Maximum number of login attempts allowed
    $max_attempts = 3;

    // Get the user's IP address
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Check if the user has reached the maximum number of attempts
    $secure_login_guard = get_option('secure_login_guard_' . $ip_address, 0);
    if ($secure_login_guard >= $max_attempts) {
        // User has reached the maximum number of attempts, block login
        $time_remaining = (int) get_option('secure_login_guard_time_' . $ip_address);
        if ($time_remaining > 0 && $time_remaining < time()) {
            // Reset the login attempts count and time
            update_option('secure_login_guard_' . $ip_address, 0);
            update_option('secure_login_guard_time_' . $ip_address, 0);
        } else {
            // Calculate the lockout time
            $lockout_time = time() + 5 * 60; // 5 minutes

            // Store the lockout time
            update_option('secure_login_guard_time_' . $ip_address, $lockout_time);

            // Redirect the user to a custom lockout page or display a message
            wp_redirect('/lockout-page/');
            exit;
        }
    } else {
        // Increment the login attempts count
        update_option('secure_login_guard_' . $ip_address, $secure_login_guard + 1);
    }

    return $user;
}

// Log failed login attempts
function log_secure_login_guard($username) {
    // Get the user's IP address
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Log the failed login attempt
    $log_entry = sprintf(
        "[%s] Failed login attempt for username '%s' from IP '%s'.",
        current_time('mysql'),
        $username,
        $ip_address
    );

    // Append the log entry to the log file
    error_log($log_entry, 0);
}

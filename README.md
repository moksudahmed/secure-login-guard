=== SecureLoginGuard ===

Contributors: Khondakar Moksud Ahmed
Tags: security, login, brute-force, authentication, protection
Requires at least: WordPress 4.0
Tested up to: WordPress 5.8
Stable tag: 1.0

== Description ==

SecureLoginGuard is a powerful WordPress plugin that enhances the security of your website by limiting the number of login attempts and protecting against brute-force attacks. By default, WordPress allows unlimited login attempts, making your site vulnerable to malicious login attempts. SecureLoginGuard puts an end to this security loophole by monitoring login attempts, tracking IP addresses, and blocking further login attempts after a specified limit is reached.

Key features of SecureLoginGuard include:

Customizable retry limits: Set the maximum number of retry attempts allowed per IP address during login.
Auth cookie protection: Limit the number of attempts to log in using authentication cookies.
User notifications: Inform users about remaining retries or lockout time on the login page.
Optional logging and email notifications: Enable logging and receive email notifications for login attempts, providing you with valuable insights and proactive security measures.
Compatibility with reverse proxies: Seamless integration with server configurations behind reverse proxies.
Translation support: Available in multiple languages, including Bulgarian, Brazilian Portuguese, Catalan, Chinese (Traditional), Czech, Dutch, Finnish, French, German, Hungarian, Norwegian, Persian, Romanian, Russian, Spanish, Swedish, and Turkish.
SecureLoginGuard utilizes standard WordPress actions and filters, ensuring easy integration into your existing WordPress setup.

== Installation ==

Upload the secureloginguard folder to the /wp-content/plugins/ directory.
Activate the plugin through the 'Plugins' menu in WordPress.
Configure the plugin settings from the 'SecureLoginGuard' section in the WordPress admin dashboard.
== Frequently Asked Questions ==

Q: Can I whitelist specific IP addresses?
A: While it is technically possible to whitelist IP addresses using a filter, it is generally not recommended for security reasons.

Q: How can I customize the maximum number of retry attempts?
A: You can set the maximum number of retry attempts per IP address through the plugin settings in the WordPress admin dashboard.
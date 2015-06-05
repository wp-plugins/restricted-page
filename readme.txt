=== Plugin Name ===
Description: Plugin hides page content from not logged-in users
Version: 1.0.0
Author: Leonid N. Malyshev
Author URI: http://mln.sk
Contributors: mln141
Tags: access, capability, cms, editor, parents, permission, restrictions, role, security, user, protection
Requires at least: 4.1
Tested up to: 4.2
Stable tag: 4.3
*/

== Description ==
"Restricted Page" plugin was created to prevent unauthorized users from viewing particular pages. The plugin must be placed on the destination page.
 For logged-in users the plugin can show (in addition to the content of the page) predefined text and “Log out” button.
For not logged in users plugin shows a predefined texts, login form and sign in button instead the page content.

== Settings ==
In plugin settings (Admins menu “Settings”->”Restricted Page Options”) you can set:
For not logged in users:
•	Text to publish before login form
•	Text to publish after login form
•	Show "Sign In" button?
•	Sign In Button text
•	Text to publish before Sign in form
•	Text to publish after Sign in form
For logged in users:
•	Show "Disconnect" button?
•	Disconnect Button text
All options allow to enter text with html tags (eg <h1>, <div>…)

== Usage ==
You can insert plugin’s shortcode in any place of you page. You can place:
•	[RP_registered_only]
•	[RP_registered_only]Text to show[/RP_registered_only] – For registered users “Text to show” would be printed in the place of the shortcode before “Sign out” button (if shown).
•	You can place shortcodes more than 1 time. WARNING. In this case all "[RP_registered_only]" must be closed bu "[/RP_registered_only]"
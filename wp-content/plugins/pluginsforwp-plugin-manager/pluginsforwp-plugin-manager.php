<?php
/**
 * PluginsForWP Plugin Manager
 *
 * @package           PluginsForWP
 * @author            PluginsForWP
 * @copyright         2025 Incodepany LLC
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       PluginsForWP Plugin Manager
 * Plugin URI:        https://pluginsforwp.com/
 * Description:       An app store that installs and manages plugins and themes.
 * Version:           7.0.1
 * Requires at least: 5.0
 * Requires PHP:      5.6
 * Author:            PluginsForWP
 * Author URI:        https://pluginsforwp.com/
 * Text Domain:       pluginsforwp-plugin-manager
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.txt | https://www.gnu.org/licenses/gpl-3.0.en.html
 * Update URI:        https://pluginsforwp.com/
 */

namespace P4W\Plugin_Manager;

require_once 'Api.php';
require_once 'Plugin_Manager.php';

Plugin_Manager_PluginsForWP::run(); // Init
Api_PluginsForWP::run(); // Register API routes for AJAX callbacks

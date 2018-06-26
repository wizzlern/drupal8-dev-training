# Configuration Management

--vv--

# Configuration Management
- Replacing Features as OTAP tool.
- Terminology: Export & Import
- Note: Destination MUST be a clone of the source database (same UUID's).
- CM is site-based, not module based. e.g. OTAP is supported, distributions are limited.
- Configuration is exported/imported using Yaml-formatted files.

--vv--

# Configuration Management

![Configuration deployment schema](assets/images/configuration-deployment-diagram.png) <!-- .element: style="width: 80%;" -->

--vv--

# Demo
- Clone website
- Make changes on Development
- Export configuration
- Import configuration

--vv--

# Exercise
As a developer I want to export the configuration of my development website.

- Export configuration using drush config-export
- Export a few individual configurations via the web interface at admin/config/development/configuration.
- Study the content of configuration files (e.g. system.performance, front page view, search block).

--vv--

# CM related modules
- Configuration Split
- Config Filter
- Configuration Read-only mode
- Configuration Update Manager
- Configuration log
- Configuration Tools
- Configuration Inspector
- Configuration development (Drush)
- Configuration Synchronizer
- Nimbus
- Features

--vv--

# Other CM use cases
- **Initial configuration**: Configuration is applied when a module or profile is enabled.
  - Update of initial configuration is not yet fully supported. See _Configuration Synchronizer_ (config_sync) module.
- **Features**: Configuration as part of bundled functionality. See Features module.

--vv--

# Tips
- When you create a new configuration form, exported the module's configuration to create the /config/install/*.yml file with default values.

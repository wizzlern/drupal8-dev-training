<?php

/**
 * Contains exercises for a custom configuration entity.
 */

// ==== Step 1 ====
// Create a new module for an HTML webservice client.
// - Module name ‘wizzlern_webservice’.

// ==== Step 2 ====
// Create a configuration entity that will contain the configuration of
// webservice client.
// - Use the Console module (https://www.drupal.org/project/console) to create a
//   configuration entity.
//   - console generate:entity:config
//   - Class name: HtmlClient
//   - Entity name: html_client
//   Alternatively copy the files from wizzlern_webservice/* in this directory.
// - Study the files that were generated. Start with src/Entity/HtmlClient.php.

// ==== Step 3 ====
// Complete the configuration data.
// - An HTML client consists of a name (label), machine name (id) and a URL. Add
//   a protected property $endpoint_url and accompanying getter method to
//   \Drupal\wizzlern_webservice\Entity\HtmlClient.
// - Update the HtmlClientInterface with the new method.
// - Add a field to the entity form for the endpoint_url in
//   \Drupal\wizzlern_webservice\Form\HtmlClientForm.
// - Update the data schema in config/schema/html_client.schema.yml.
// - Create an HTML client to test the entity.
// - Export the site configuration and check the data structure.

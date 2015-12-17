<?php

/**
 * Contains exercises for a custom configuration entity.
 * Estimated time: 75 min.
 */

// ==== Step 1 ====
// Create a new module for an HTML webservice client.
// - Module name ‘wizzlern_webservice’.

// ==== Step 2 ====
// Create a configuration entity that will contain the configuration of
// webservice client.
// - Use the Console module (http://drupalconsole.com/) to create a
//   configuration entity:
//   - $ console list
//   - $ console generate:entity:config
//   - Class name: HtmlClient
//   - Entity name: html_client
//   Alternatively copy the files from wizzlern_webservice/* in this directory.
// - Read the generated code in src/Entity/HtmlClient.php
// - Study the other generated files.

// ==== Step 3 ====
// Complete the configuration data.
// - An HTML client consists of a name (label), machine name (id) and an
//   endpoint URL. Add a protected property $endpoint_url and a getter method to
//   \Drupal\wizzlern_webservice\Entity\HtmlClient.
// - Update the HtmlClientInterface with the new method.
// - Add a field to the entity form for the endpoint_url in
//   \Drupal\wizzlern_webservice\Form\HtmlClientForm.
// - Update the data schema in config/schema/html_client.schema.yml.
// - Create an HTML client to test the entity.
// - Export the site configuration and check the data structure.

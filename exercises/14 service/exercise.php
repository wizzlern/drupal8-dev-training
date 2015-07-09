<?php

/**
 * Contains exercises to create a service.
 * Estimated time: 30 minutes.
 */

// ==== Step 1 ====
// Define a webservice that fetches html data.
// - Determine how Drupal fetches html data.
// - Use the wizzlern_webservice.services.yml file provided in this exercise.
// - Define a html_client service in the wizzlern_webservice.services.yml file
//   that loads and processes html data using Drupal core's html service. Use
//   the HtmlClientApi class for this service.
// - Note that this service requires the core html client.

// ==== Step 2 ====
// Get the DOM of the html data.
// - Use the files in the src/ClientApi folder provided in this exercise.
// - Add a constructor to load the service(s) this class requires.
// - Implement HtmlClientApi::load(). Note that the interface provides the
//   essential details for the method.

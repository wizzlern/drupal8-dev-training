<?php

/**
 * Contains exercises to create a service.
 * Estimated time: 15 minutes.
 */

// ==== Step 1 ====
// Define a service that fetches html data.
// - Determine how Drupal performs an html get request.
// - Use the wizzlern_crawler.services.yml file provided in this exercise, and
//   the fragments below.
// - Define a service in the wizzlern_crawler.services.yml file that loads and
//   processes html data using Drupal core's http client. Use the HtmlLoader
//   class that is provided in this exercise.
// - Note that this service requires the core http client.

// --- Fragments for step 1 ---
// - arguments
// - class
// - Drupal\wizzlern_crawler\HtmlLoader\HtmlLoader
// - http_client
// - services
// - wizzlern_crawler.html_loader

// ==== Step 2 ====
// Create a test page that will show the fetched data.
// - Create a controller class and router. Choose your own URL and title.
// - The controller uses the webservice to fetch html data
// - Display some results from a webservice.

// ==== Step 3 ====
// Get the DOM of the html data.
// - Use the DOM parser from the previous exercise.
// - Add a constructor to load the parser.
// - Implement HtmlLoader::loadDom(). Note that the interface already contains
//   the defintion of this method.

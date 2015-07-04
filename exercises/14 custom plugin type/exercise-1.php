<?php

/**
 * Contains exercises to create a custom plugin type.
 * Estimated time: 30 minutes.
 */

// ==== Step 1 ====
// Create a custom plugin type for processing html data.
// Each processor will fetch some content from the HTML that is returned by a
// webservice client. The input is the full HTML response, the returned value
// is a string.
// - Create an annotation type plugin with:
//   - Plugin class: HtmlProcessor
//   - Plugin name: html_processor
//   Find a good example or copy the files from wizzlern_webservice/* in this
//   folder.

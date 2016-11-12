*Wizzlern Module Development excercises and examples.*

This is part of the Wizzlern Drupal 8 module development training.
  See wizzlern.nl/training/drupal-8-module-development

  This module assumes the following:
  1. A field added to User
    - Name: field_user_age
    - Type: Number (integer)
  1. Content to test PEGI restriction.
    - Content type "game". This content type must have a field:
      - Name: field_allowed_age
      - Type: List (integer)
      - Allowed values: 3, 7, 12, 16, 18

  Block
  This module provides a "New games" block listing content of type "game". Only
  games that match the users age will be listed. For example the user's age is
  8. This user will only see games with PEGI allowed age 3 and 7 in the block.

  Nodes
  Game nodes are access controlled. If the user does not have the right age,
  the user will not receive view access to it. This will result in a 403 error.

  For PEGI age labels, see http://www.pegi.info/en/index/id/33/

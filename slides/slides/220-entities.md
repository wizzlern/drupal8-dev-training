# Entities

--vv--

# Entities
- Content Entities
  - Comment, Node, User, (Taxonomy) Term
  - CustomBlock, Feed, File, (Aggregator) Item, Shortcut
- Configuration Entities
  - Block (type), NodeType, Breakpoint, ImageStyle, Language, Role, Tour, View, Vocabulary

--vv--

# Content Entities
- Typically used for editorial content.
- 2 types of fields:
  - Configurable Fields (field_*)
  - Base Fields (title, author, state, ...)
- Entity translation is included.
- Revisions included.
- Database schema is automatically generated.

--vv--

# Configuration Entities
- Used for complex configuration data. Use configuration factory for simple data.
- Exported/imported using Configuration Management.
- Config entity API not the same as content entity API.

--vv--

# User story
As a logged in user I want to see a list of most recent reviews of games that match my age.

![Screenshot List of games](assets/images/pegi-new-games-list.png)

--vv--

# Loading Entities

```php
$this->entityTypeManager = $container->get('entity_type.manager');
$entity = $this->entityTypeManager->getStorage('entity_type')->load($entity_id);
```

![Node UML diagram](assets/images/node-uml.png)

- EntityTypeManager: 'entity_type.manager' service
- Manages entity type plugin definitions
- NodeStorage:
- Node storage handler class
- Node
- The node entity class.

--vv--

# Entity fields

```php
$field_value = $node->field_name->value;
$field_value = $node->get('field_name')->value;
$field_value = $node->get('field_name')->get(0)->get('value')->getValue();
```

![Typed Data UML diagram](assets/images/typed-data-uml.png)

- FieldItemListInterface:
- List of van field items (may have only one list element).
- FieldItemInterface:
- Field value item. Can have multiple properties.
- TypedDataInterface:
- TypedData class contains the property values.

--vv--

# Entity Queries

```php
$query = $container->get('entity_type.manager')
  ->getStorage('entity_type')
  ->getQuery();
$entity_ids = $query->condition('type', 'bundle_type')
  ->execute();
```

![Entity Query UML diagram](assets/images/entity-query-uml.png)

- Query object:
  - Queries entities.
  - execute() returns an array of entity IDs.

--vv--

# Exercise
Display a list of links to game reviews inside the block.

- Query and load the most recent reviews.
- Format the output as links to the nodes.
- (Optionally) make the maximum number of links configurable.
- More exercise details in: _/04 content entity/exercise.php_.

--vv--

# Entity data model

![Entity data model](assets/images/entity-data-model.png)

```php
$foo = $node->get('field_foo')->value;
$translation = $node->getTranslation($langcode);
$translation->get('field_foo')->value;
```

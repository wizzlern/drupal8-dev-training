# Menus

--vv--

# Menu's
- Menu link types:
  - Menu links
  - Local tasks (tabs)
  - Action links ('+' button)
  - Contextual links

--vv--

# Menu links
- Static links in the menu tree.
- Yaml file: *.links.menu.yml
- Alter:  hook_menu_links_discovered_alter()
- Dynamic: use 'deriver'. Optionally use: 'class' and 'class_form'.

```yaml
# example.links.menu.yml

example.info:
  title: My Info
  description: 'My example information'
  route_name: example.info
  menu_name: main
```

--vv--

# Local tasks
- 'Tab' links.
- Yaml file: *.links.task.yml
- Alter:  hook_menu_local_tasks_alter()
- Dynamic: use 'deriver' class that extends DeriverBase

```yaml
# example.links.task.yml

example.info:
  title: 'Overview'
  route_name: example.info
  base_route: example.info

example.one:
  title: 'One'
  route_name: example.one
  base_route: example.info
```

--vv--

# Local action
- Example: 'Add content' links
- Yaml file: *.links.action.yml
- Alter: hook_menu_local_actions_alter().
- Dynamic: use 'deriver' class that extends DeriverBase

```yaml
# example.links.action.yml

example.add:
  route_name: example.one
  title: 'Add One'
  appears_on:
    - example.two
```

--vv--

# Exercise
As a vistor I want a 'Games' item in the main menu that links to the Games Review overview page.

![Screenshot List of games](assets/images/pegi-new-games-list.png)

- Add a menu link to the main menu.
- More exercise details in: _/07 menu/wizzlern_pegi.links.menu.yml_.

--vv--

# Exercise (optional)
As an editor I want to have a 'Add Game Review' button on the games overview page. This makes it easy to add new reviews.

- Create an 'Add Game Review' action link.
- More exercise details in: _/07 menu/exercise.php_.

--vv--

# Documentation
- Menu API in Drupal 8 https://drupal.org/node/2122231
- Contextual links https://drupal.org/node/2165243
- Action links https://drupal.org/node/2133247
- Local tasks https://drupal.org/node/2044515

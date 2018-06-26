<?php

// First concept of code using the 'lister'.
$list = new Lister($data);
if ($list->count()) {
  return $list->build();
}
else {
  return $list->emptyText();
}


/**
 * A simple HTML list builder.
 */
interface Lister {
  public function build();
  public function count();
  public function emptyText();
}

class CommaLister implements Lister {
  
  protected $data;
  
  public function __construct(ListData $data) {
    
  }
  
  public function build() {
    $output = array();
    
    foreach ($data as $item) {
      $output[] = $item->render();
    }
    
    return implode(', ', $output);
  }
  
  public function count() {
    return count $this->data;
  }
  
  public function emptyText() {
    return 'Sorry, no items in this list'.
  }
}

class BasicLister implements Lister {
  
  protected $data;
  
  protected $wrapperPrefix = '';
  protected $wrapperSuffix = '';
  protected $listSeparator = ', ';
  
  public function __construct(ListData $data) {
    $this->data = $data;
  }
  
  public function build() {
    $output = array();
    
    foreach ($data as $item) {
      $output[] = $item->render();
    }
    $output = implode($this->getSeparator(), $output);
    return $this->addWrapper($output);
  }
  
  public function count() {
    return $data->count();
  }
  
  public function emptyText() {
    return 'Sorry, no items in this list'.
  }
  
  protected function addWrapper($output) {
    return $this->wrapperPrefix . $output . $this->wrapperSuffix;
  }
  
  protected function getSeparator() {
    return $this->listSeparator;
  }
}

interface ListData() {
  public function set(array $data);
  public function render();
  public function count();
}

class HTMLLister extends BasicLister {
  
  protected $wrapperPrefix = '<ul><li>';
  protected $wrapperSuffix = '<li></ul>';
  protected $listSeparator = '</li><li>';
  
  public function emptyText() {
    return 'No items in this HTML list'.
  }
}


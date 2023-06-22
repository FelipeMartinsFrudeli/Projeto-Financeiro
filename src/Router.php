<?php

namespace app;

class Router
{
  public array $getList = [];
  public array $postList = [];
  public Database $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function get($path, $page)
  {
    $this->getList[$path] = $page;
  }

  public function post($path, $page)
  {
    $this->postList[$path] = $page;
  }

  public function resolve()
  {
    $current_url = $_SERVER['REQUEST_URI'] ?? '/';

    if (strpos($current_url, '?') !== false) {
      $current_url = substr($current_url, 0, strpos($current_url, "?"));
    }

    //var_dump($_SERVER);

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
      $page = $this->getList[$current_url] ?? null;
    } else {
      $page = $this->postList[$current_url] ?? null;
    }

    if($page) {
      // function, parameter
      call_user_func($page, $this);
    } else {
      echo "not found";
    }
  }

  public function renderView($page, $_layoutPath, $params=[])
  {
    if(!empty($params)) {
      foreach ($params as $key => $value) {
        $$key = $value;
      }
    }

    ob_start();
    include_once __DIR__."/views/$page.php";
    $content = ob_get_clean();
    include_once __DIR__."/views/$_layoutPath/_layout.php";
  }
}
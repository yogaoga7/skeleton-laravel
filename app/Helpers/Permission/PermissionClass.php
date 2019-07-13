<?php 

  namespace App\Helpers\Permission;

  class PermissionClass {

    protected $base;

    public function __construct() {
      $this->base = require_once(__DIR__ . '/permissions.php');
    }
    /**
     * Getting original permissin array
     *
     * @return Array
     */
    public function original(): Array {
      return $this->base;
    }

    /**
     * Get permission woth description
     *
     * @return Array
     */
    public function all() : Array {
      $return = [];
      foreach($this->base as $bases) {
        foreach($bases as $base) {
          $return[] = $base;
        }
      }

      return $return;
    }

    /**
     * Get permission slug
     *
     * @return Array
     */
    public function slugs() : Array {
      $return = [];
      if(is_array($this->base)) {
        foreach($this->base as $bases) {
          foreach($bases as $base) {
            $return[] = $base['slug'];
          }
        }
      }
      
      return $return;
    }

  }
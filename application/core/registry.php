<?php

    class Registry implements ArrayAccess{

        protected static $registry = null;
        private          $vars     = [];

        protected function __construct(){
        }

        protected function __clone(){
        }

        public static function get_set_Registry(){
            if(!isset(static::$registry)){
                self::$registry = new Registry();
            }

            return static::$registry;
        }

        /**
         * Whether a offset exists
         * @link  http://php.net/manual/en/arrayaccess.offsetexists.php
         *
         * @param mixed $offset <p>
         *                      An offset to check for.
         *                      </p>
         *
         * @return boolean true on success or false on failure.
         * </p>
         * <p>
         * The return value will be casted to boolean if non-boolean was returned.
         * @since 5.0.0
         */
        public function offsetExists($offset){
            if(isset($this->vars[$offset]) == false){
                return false;
            }

            return true;
        }

        /**
         * Offset to retrieve
         * @link  http://php.net/manual/en/arrayaccess.offsetget.php
         *
         * @param mixed $offset <p>
         *                      The offset to retrieve.
         *                      </p>
         *
         * @return mixed Can return all value types.
         * @since 5.0.0
         */
        public function offsetGet($offset){
            if(isset($this->vars[$offset]) == false){
                return null;
            }

            return $this->vars[$offset];
        }

        /**
         * Offset to set
         * @link  http://php.net/manual/en/arrayaccess.offsetset.php
         *
         * @param mixed $offset <p>
         *                      The offset to assign the value to.
         *                      </p>
         * @param mixed $value  <p>
         *                      The value to set.
         *                      </p>
         *
         * @return void
         * @since 5.0.0
         */
        public function offsetSet($offset, $value){
            /*if(isset($this->vars[$offset]) == true){
                throw new Exception('Unable to set var `'.$offset.'`. Already set.');
            }*/
            $this->vars[$offset] = $value;

            return true;
        }

        /**
         * Offset to unset
         * @link  http://php.net/manual/en/arrayaccess.offsetunset.php
         *
         * @param mixed $offset <p>
         *                      The offset to unset.
         *                      </p>
         *
         * @return void
         * @since 5.0.0
         */
        public function offsetUnset($offset){
            unset($this->vars[$offset]);
        }
    }

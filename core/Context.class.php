<?php
/*---------------------------------------------------------------------------
  Context										2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: /
  Class		  : Context
---------------------------------------------------------------------------*/

final class Context extends \Classes\Singleton
  {
    private $_data          = array();
    private $_value         = '';

    protected function __construct($value = '')
    {
      $this->_value = $value;
    }

    protected function __init()
    {
      include './Config/Context.config.php';
    }

    public function HasChildren()
    {
      foreach($this->_data as $item)
        if($this->isChild($item))
          return true;
      return false;
    }

    protected function isChild($var)
    {
      if(is_object($var))
        if(get_class($var) === __CLASS__)
          return true;
      return false;
    }

    public final function __set($index, $value)
    {
      switch(gettype($value))
      {
      case 'array':
      case 'object':
        $this->_data[$index] = $value;
        break;
      default:
        $this->_data[$index] = new Context($value);
        break;
      }
    }

    public final function __get($index)
    {
      if(array_key_exists($index, $this->_data))
      {
        if($this->isChild($this->_data[$index]))
        {
          if(!$this->_data[$index]->HasChildren())
          {
            return $this->_data[$index]->_value;
          }
        }
        return $this->_data[$index];
      }
      return $this->_data[$index] = new Context();
    }

    public final function __toString()
    {
      return $this->_value;
    }

    public final function ToObject($object = null)
    {
      if($object === null)
        $object = new StdClass();

      if($this->_value !== '')
      {
        $object = $this->_value;
      }
      else
      {
        foreach($this->_data AS $key=>&$value)
        {
          if($this->isChild($value))
          {
            $object->{$key} = new StdClass();
            $object->{$key} = $value->ToObject($object->{$key});
            if(!(array)$object->{$key})
              unset($object->{$key});

          }
          else
          {
            $object->{$key} = $value;
          }
        }
      }
      return $object;
    }
  }
?>

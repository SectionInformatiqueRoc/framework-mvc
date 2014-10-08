<?php

namespace MVC;

class Session
{
    const SESSION_STARTED = TRUE; //session open=true
    const SESSION_NOT_STARTED = FALSE; //session closed=false
   
   
    private $sessionState = self::SESSION_NOT_STARTED;
   
    
    private static $instance;
    
   
    private function __construct() {}
        
    /**
    *    return the instance session
    *    the session automatically automate .
    *   
    *    @return    the object
    **/
   
    public static function getInstance()
    {
        if ( !isset(self::$instance))
        {
            self::$instance = new self;
        }
        self::$instance->startSession();
        
        return self::$instance;
    }
   /**
    * Self = Be used for getting a variable of the parent's class
    * 
    * (Caution ! , The variable have to be static).
    */
   
    /**
    *    Session start.
    *   
    *    @return    bool    TRUE if the session is initialisate, else FALSE.
    **/
   
    private function startSession()
    {
        if ( $this->sessionState == self::SESSION_NOT_STARTED )
        {
            $this->sessionState = session_start();
        }
       
        return $this->sessionState;
    }
   
   
    /**
    *    Saving of the session.
    *    Example: $instance->foo = 'bar';
    *   
    *    @param    name   Data name.
    *    @param    value    Data values.
    *    @return    void
    **/
   
    public function __set( $name , $value )
    {
        return  $_SESSION[$name] = $value;
    }
   
   
    /**
    *    Take data session's.
    *    Example: echo $instance->foo;
    *   
    *    @param    name    name of the getting data.
    *    @return    mixed    Saving session of the session.
    **/
   
    public function __get( $name )
    {
        if ( isset($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }else{
            throw new \Exception('$_SESSION['.$name.'] undefined.' );
        }
    }
   
   
    public function __isset( $name )
    {
        return isset($_SESSION[$name]);
    }
   
   
    public function __unset( $name )
    {
        unset( $_SESSION[$name] );
    }
   
   
    /**
    *    Destroy the current session.
    *   
    *    @return    bool    TRUE if the session if delete, else FALSE.
    **/
   
    public function destroy()
    {
        if ( $this->sessionState == self::SESSION_STARTED )
        {
            $this->sessionState = !session_destroy();
            unset( $_SESSION );
           
            return !$this->sessionState;
        }
       
        return FALSE;
    }
}

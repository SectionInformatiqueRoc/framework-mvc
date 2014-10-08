<?php

namespace MVC;

class Session
{
    const SESSION_STARTED = TRUE; //session ouverte = vraie
    const SESSION_NOT_STARTED = FALSE; //session fermée = faux
   
   
    private $sessionState = self::SESSION_NOT_STARTED;
   
    
    private static $instance;
    
   
    private function __construct() {}
        
    /**
    *    Retourne l'instance de Session
    *    Session est automatiquement automatiser.
    *   
    *    @return    l'object
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
    * Self = Celà s'utilise pour accéder à une variable de la classe parente 
    * (attention, les variables doivent être statiques).
    * A noter que pour utiliser les :: il faut que la fonction et la variable 
    * soient statiques.
    * $this" fait référence à l'instance courante de l'objet
    */
   
    /**
    *    Start de la sessionn.
    *   
    *    @return    bool    TRUE si la session est initialiser, else FALSE.
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
    *    Enregistrer de la session.
    *    Example: $instance->foo = 'bar';
    *   
    *    @param    name    Nom des données.
    *    @param    value    valeur données.
    *    @return    void
    **/
   
    public function __set( $name , $value )
    {
        return  $_SESSION[$name] = $value;
    }
   
   
    /**
    *    Prendre les données de la session.
    *    Example: echo $instance->foo;
    *   
    *    @param    name    nom des données a recup.
    *    @return    mixed    session d'enregistrement de la session.
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
    *    Detruit la session courante.
    *   
    *    @return    bool    TRUE si la session est delete, else FALSE.
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

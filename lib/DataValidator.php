<?php

/**
* Classe designada a validação de formato de dados
*/
class DataValidator
{
    /**
    * Verifica se o dado passado está vazio
    * @param mixed $mx_value
    * @return boolean
    */
    static function isEmpty( $mx_value )
    {
        #return (!(strlen($mx_value)>0)) ? true : false;

        if (!(strlen($mx_value)>0))
            return true;
        return false;
    }
    /**
    * Verifica se o dado passado é um número
    * @param mixed $mx_value
    * @return boolean
    */
    static function isNumeric( $mx_value )
    {
        $mx_value = str_replace(',', '.', $mx_value);
        if ((!is_numeric($mx_value)))
            return false;
        return true;
    }

    /**
    * Verifica se o dado passado é um Inteiro
    * @param mixed $mx_value
    * @return boolean
    */
    static function isInteger($mx_value)
    {
        if (!DataValidator::isNumeric($mx_value)) {
            return false;
        }
        if (preg_match('/[[:punct:]&^-]/', $mx_value)>0) 
            return false;
        return true;
    }

}
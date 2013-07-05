<?php

class chaine {
	/**
	 * Méthode pour detecter les méthodes non déclaré
	 * 
	 */
	function __call($methode, $arguments) {
		$message = "Vous avez appelez la methode {$methode}(); (qui nexiste pas) <br/>";
		count($arguments)==0 ? $message .= "sans argument!" : print_r($arguments);
		echo $message;
	}
	
	/**
	 * Méthode d'assignation de variable non déclarée
	 * 
	 */
	function __set($propriete, $valeur) {
		$this->$propriete = $valeur;
	}
	
	/**
	 * Method to get an array as an exported string.
	 *
	 * @param   array  $a  The array to get as a string.
	 *
	 * @return  array
	 *
	 * @since   11.1
	 */
	protected function getArrayString($a)
	{
		$s = 'array(';
		$i = 0;
		foreach ($a as $k => $v)
		{
			$s .= ($i) ? ', ' : '';
			$s .= '"' . $k . '" => ';
			if (is_array($v) || is_object($v))
			{
				$s .= $this->getArrayString((array) $v);
			}
			else
			{
				$s .= '"' . addslashes($v) . '"';
			}
			$i++;
		}
		$s .= ')';
		return $s;
	}
	
}

?>
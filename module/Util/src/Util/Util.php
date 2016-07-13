<?php

namespace Util;

use Zend\Http\PhpEnvironment\RemoteAddress;
use Zend\Crypt\Key\Derivation\Scrypt;

/**
 * Classe Util$Util
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 17/03/2014 23:12:17
 */
class Util {
	
	const MYSQL_DATETIME = 'YYYY-MM-dd HH:mm:ss';
	const LIMITE_REGISTROS_AUTOCOMPLETE = 200;
	
	/**
	 * Método getLastDayMonth - Obtém o último dia do mês informado
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 07/12/2012 15:30:51
	 * @param int $month
	 * @param int $year
	 * @return date
	 */
	public static function getLastDayMonth($month, $year) {
		return date('Y-m-t', mktime(0, 0, 0, $month, 1, $year));
	}
	
	/**
	 * Método getFirstDayMonth
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 20/11/2015 18:43:01
	 * @param int $month
	 * @param int $year
	 */
	public static function getFirstDayMonth($month, $year) {
		return date('Y-m-d', mktime(0, 0, 0, $month, 1, $year));
	}
	
	/**
	 * Método getMonthName
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 20/11/2015 18:13:45
	 * @param int $month
	 * @return string
	 */
	public static function getMonthName($month) {
		$dt = \DateTime::createFromFormat('Y-m-d H:i:s', date("Y-") . self::lpad($month, 2, '0') . "-01 00:00:00");
		
		$df = new \IntlDateFormatter(
			str_replace('-', '_', \Locale::getDefault()), // string locale
			\IntlDateFormatter::NONE, // int date type
			\IntlDateFormatter::NONE, // int time type
			$dt->getTimezone(), // string timezone
			\IntlDateFormatter::GREGORIAN, // int cal type
			'MMMM' // string pattern
		);
		
		return $df->format($dt);
	}
	
	/**
	 * Método str2num - Transforma uma string em float
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 07/12/2012 15:30:54
	 * @param string $str
	 * @return number
	 */
	public static function str2num($str) {
		if(strpos($str, '.') < strpos($str,',')) {
			$str = str_replace('.','',$str);
			$str = strtr($str,',','.');
		} else {
			$str = str_replace(',','',$str);
		}
		return (float)$str;
	}
	
	/**
	 * Método formataNumero - Formata o número para exibição
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 27/12/2012 13:33:27
	 * @param number $number
	 * @return string
	 */
	public static function formataNumero($number) {
		if($number === null) {
			return null;
		}
		return number_format($number, 2, ',', '.');
	}
	
	/**
	 * Método removeZerosDecimal - Remove os zeros à direita da parte fracionária
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 13/12/2015 11:11:01
	 * @param string $number
	 * @return string
	 */
	public static function removeZerosDecimal($numberFormatted, $separadorDecimal = ',') {
		$f = explode($separadorDecimal, $numberFormatted);
		$dec = rtrim($f[1], '0');

		return $f[0] . (strlen($dec) > 0 ? $separadorDecimal . $dec : '');
	}
	
	/**
	 * Método compareFloat - Compara se o float $n1 é igual à $n2
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 13/12/2015 11:25:57
	 * @param number $n1
	 * @param number $n2
	 * @return bool
	 */
	public static function compareFloat($n1, $n2) {
		return abs(($n1 - $n2) / $n2) < 0.0000001;
	}
	
	/**
	 * Método formataMoedaReal - Formata $number para exibição em moedal Real
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 25/05/2014 17:50:44
	 * @param number $number
	 * @return string
	 */
	public static function formataMoedaReal($number) {
		if($number === null) {
			return null;
		}
		return 'R$ ' . number_format($number, 2, ',', '.');
	}
	
	/**
	 * Método nvl - Retorna o primeiro parametro não nulo
	 *              Apesar de não ter definido parametros, a função aceita como por exemplo: nvl($a, $b, $c)
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 22/11/2011 00:32:08
	 * @param mixed ...
	 * @return mixed
	 */
	public static function nvl() {
		$numargs = func_num_args();
		for($x = 0; $x < $numargs; $x++) {
			if(func_get_arg($x) !== null) {
				return func_get_arg($x);
			}
		}
		return null;
	}
	
	/**
	 * Método removeCaraceteresCPF - Remove os caracteres '.' e '-' de $cpf
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 01/04/2014 00:02:24
	 * @param string $cpf
	 * @return string
	 */
	public static function removeCaraceteresCPF($cpf) {
		return preg_replace('/[.,-\/]/', '', $cpf);
	}
	
	/**
	 * Método validaCPF - Verifica se o $cpf informado é válido.
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 22/11/2011 00:32:08
	 * @param string $cpf
	 * @return boolean
	 */
	public static function validaCPF($cpf) {
		// Verifiva se o número digitado contém todos os digitos
		$cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
	
		// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
		if(strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' ||$cpf == '22222222222' ||
		$cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' ||
		$cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
			return false;
		} else {
			// Calcula os números para verificar se o CPF é verdadeiro
			for($t = 9; $t < 11; $t++) {
				for($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}
	
				$d = ((10 * $d) % 11) % 10;
	
				if($cpf{$c} != $d) {
					return false;
				}
			}
	
			return true;
		}
	}
	
	/**
	 * Método formataCPF - Formata CPF para exibição
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 02/04/2014 10:57:40
	 * @param string $cpf
	 * @return string
	 */
	public static function formataCPF($cpf) {
		return self::mask($cpf,'###.###.###-##');
	}
	
	/**
	 * Método formataCNPJ - Formata CNPJ para exibição
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 19/05/2014 11:26:03
	 * @param string $cnpj
	 * @return string
	 */
	public static function formataCNPJ($cnpj) {
		return self::mask($cnpj,'##.###.###/####-##');
	}
	
	/**
	 * Método mask - Aplica a máscara $mask à string $val
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 02/04/2014 10:57:19
	 * @param string $val
	 * @param string $mask
	 * @return string
	 */
	public static function mask($val, $mask) {
		$maskared = '';
		$k = 0;
		for($i = 0; $i <= strlen($mask) - 1; $i++) {
			if($mask[$i] == '#') {
				if(isset($val[$k])) {
					$maskared .= $val[$k++];
				}
			} else {
				if(isset($mask[$i])) {
					$maskared .= $mask[$i];
				}
			}
		}
		
		return $maskared;
	}
	
	
	/**
	 * Método agora - Retorna a data/hora atual
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 13/09/2013 11:54:55
	 * @return timestamp
	 */
	public static function agora() {
		$agora = new \DateTime();
		return $agora->getTimestamp();
	}
	
	/**
	 * Método hoje - Retorna a data de hoje
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 16/04/2016 09:08:42
	 * @return \DateTime
	 */
	public static function hoje() {
		return new \DateTime('today');
	}
	
	/**
	 * Método ontem - Retorna a data de ontem
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 16/04/2016 09:09:33
	 * @return \DateTime
	 */
	public static function ontem() {
		return new \DateTime('yesterday');
	}
	
	/**
	 * Método getDatetimeFromWSDate - Retorna um Datetime de uma data vinda de integração
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 22/03/2016 10:46:07
	 * @param string $date
	 * @return \DateTime
	 */
	public static function getDatetimeFromWSDate($date) {
		return \DateTime::createFromFormat('Y-m-d', $date);
	}
	
	/**
	 * Método truncate - Trunca a string na quantidade de caracteres informado, sem quebrar a palavra ao meio.
	                     Adiciona reticências ao final caso a $string tenha sido truncada.
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 01/12/2013 09:42:51
	 * @param string $string
	 * @param int $maxChars
	 * @return string
	 */
	public static function truncate($string, $maxChars = 40) {
		$words = preg_split('/\s+/', $string);
	
		$chars = 0;
		$truncated = array();
		while(count($words) > 0) {
			$fragment = trim(array_pop($words));
			$chars += strlen($fragment);
	
			if($chars > $maxChars) break;
	
			$truncated[] = $fragment;
		}
	
		$result = implode($truncated, ' ');
	
		return $result . ($string == $result ? '' : '...');
	}
	
	/**
	 * Método IsNullOrEmptyString - Verifica se a variável é nula ou vazia
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 31/03/2014 23:59:09
	 * @param string $question
	 * @return boolean
	 */
	public static function IsNullOrEmptyString($question) {
		return (!isset($question) || trim($question) === '');
	}
	
	/**
	 * Método lpad - Adiciona $char à esquerda de $string até a quantidade de $length
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 20/05/2014 16:11:27
	 * @param string $string
	 * @param int $length
	 * @param string $char
	 * @return string
	 */
	public static function lpad($string, $length, $char) {
		return str_pad($string, $length, $char, STR_PAD_LEFT);
	}
	
	/**
	 * Método getClientIp - Obtém o IP do cliente
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 15/12/2014 14:47:46
	 * @return Ambigous <string, unknown, \Zend\Http\PhpEnvironment\false, boolean, mixed>
	 */
	public static function getClientIp() {
		$remote = new RemoteAddress();
		return $remote->getIpAddress();
	}
	
	/**
	 * Método getIpGeoLocation
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 15/12/2014 14:49:22
	 * @param string $ip
	 * @return mixed
	 */
	public static function getIpGeoLocation($ip) {
		$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
		return $details;
	}
	
	/**
	 * http://php.net/manual/pt_BR/function.get-browser.php#101125
	 * @return multitype:string unknown
	 */
	public static function getBrowser()
	{
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";
	
		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}
	
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Internet Explorer';
			$ub = "MSIE";
		}
		elseif(preg_match('/Firefox/i',$u_agent))
		{
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";
		}
		elseif(preg_match('/Chrome/i',$u_agent))
		{
			$bname = 'Google Chrome';
			$ub = "Chrome";
		}
		elseif(preg_match('/Safari/i',$u_agent))
		{
			$bname = 'Apple Safari';
			$ub = "Safari";
		}
		elseif(preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Opera';
			$ub = "Opera";
		}
		elseif(preg_match('/Netscape/i',$u_agent))
		{
			$bname = 'Netscape';
			$ub = "Netscape";
		}
	
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}
	
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}
	
		// check if we have a number
		if ($version==null || $version=="") {$version="?";}
	
		return array(
				'userAgent' => $u_agent,
				'name'      => $bname,
				'version'   => $version,
				'platform'  => $platform,
				'pattern'    => $pattern
		);
	}
	
	/**
	 * Método crypt - Criptografa a string utilizando o $salt
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 05/02/2015 17:31:19
	 * @param string $password
	 * @param string $salt
	 * @return string
	 */
	public static function crypt($password, $salt) {
		return bin2hex(Scrypt::calc($password, $salt, 2048, 2, 1, 32));
	}
	
	/**
	 * Método generateCodigo - Gera um código (deprecated)
	 *                         Usar método generateUUID no lugar.
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 25/02/2015 14:58:41
	 * @param number $length
	 * return string
	 */
	public static function generateCodigo($length = 250) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
	
	/**
	 * Método startsWith - Verifica se a string $haystack começa com $needle
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 09/06/2015 15:48:09
	 * @param string $haystack
	 * @param string $needle
	 * @return boolean
	 */
	public static function startsWith($haystack, $needle) {
		// search backwards starting from haystack length characters from the end
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
	}
	
	/**
	 * Método endsWith - Verifica se a string $haystack termina com $needle
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 09/06/2015 15:48:12
	 * @param string $haystack
	 * @param string $needle
	 * @return boolean
	 */
	public static function endsWith($haystack, $needle) {
		// search forward starting from end minus needle length characters
		return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
	}
	
	/**
	 * Método isInteger - Verfica se o número é um inteiro
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 09/06/2015 16:27:07
	 * @param string $input
	 * @return boolean
	 */
	public static function isInteger($input) {
		return ctype_digit(strval($input));
	}
	
	/**
	 * Método varDump - Escreve a variável na tela
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 03/03/2015 09:10:31
	 * @param mixed $var
	 */
	public static function varDump($var) {
		echo "<pre>";
		var_dump($var);
		echo "</pre>";
	}
	
	/**
	 * Método varDumpExit - Escreve a variável na tela e termina a execução
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 03/03/2015 09:10:52
	 * @param mixed $var
	 */
	public static function varDumpExit($var) {
		self::varDump($var);
		exit;
	}
	
	/**
	 * Método generateUUID - Gera um UUID (Identificador Único Universal)
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 01/02/2016 16:32:00
	 * @param int $length
	 * @return string
	 */
	public static function generateUUID($length = 20) {
		return bin2hex(openssl_random_pseudo_bytes($length));
	}
	
	/**
	 * Método generateUUIDPy - Gera um UUID (Identificador Único Universal)
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 01/02/2016 16:57:54
	 * @param int $length
	 * @return string
	 */
	public static function generateUUIDPy() {
		return trim(shell_exec('python3 -c \'import uuid; print(uuid.uuid1())\''));
	}
	
	/**
	 * Método fibonacci - Obtém o número da sequência Fibonacci na posição solicitada
	 *                    Essa função não considera que existem dois números 1 na sequência.
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 03/02/2016 13:15:30
	 * @param int $n posição da sequência
	 * @return number
	 */
	public static function fibonacci($n) {
		if($n < 2) {
			return $n;
		}
		
		$int1 = 1;
		$int2 = 1;
		
		$fib = 0;
		
		for($i = 1; $i <= $n - 1; $i++) {
			$fib = $int1 + $int2;
			$int2 = $int1;
			$int1 = $fib;
		}
		
		return $fib;
	}
	
	/**
	 * Método getPorcentagem - Obtém a porcentagem do número $num sobre $total
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 03/02/2016 15:06:48
	 * @param number $num
	 * @param number $total
	 * @param $func opcional (Default round)
	 * @return number
	 */
	public static function getPorcentagem($num, $total, $func = 'round') {
		if($func == 'floor') {
			return floor($num * 100 / $total, 2);
		}
		
		return round($num * 100 / $total, 2);
	}
}

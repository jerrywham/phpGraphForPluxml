<?php
/**
 * Plugin phpGraphForPluxml
 *
 * @package	PLX
 * @version	1.1
 * @date	11/02/2015
 * @author	Cyril MAGUIRE
 **/

class phpGraphForPluxml extends plxPlugin {

	public static $aGraphiques;

	/**
	 * Constructeur de la classe phpGraphForPluxml
	 *
	 * @param	default_lang	langue par défaut utilisée par PluXml
	 * @return	null
	 *
	 * @author	Cyril MAGUIRE
	 **/
	public function __construct($default_lang) {

		# Appel du constructeur de la classe plxPlugin (obligatoire)
		parent::__construct($default_lang);

		if (!defined('PLX_PHPGRAPH')) {
        	define('PLX_PHPGRAPH',PLX_ROOT.'data/phpGraphForPluxml');
        	define('PLX_PHPGRAPH_IMG',PLX_ROOT.'data/images/phpGraphForPluxml');
		}
		
		# Déclarations des hooks
		if(!defined('PLX_ADMIN')) {		
			$this->addHook('Index', 'Index');
			$this->addHook('plxMotorParseArticle', 'parseDataOfArticles');
			$this->addHook('plxShowStaticContent', 'parseDataOfStatics');
			$this->addHook('ThemeEndBody', 'ThemeEndBody');
		}
	}

	/**
	 * Méthode permettant de déterminer si le navigateur utilisé est IE et de dire si la version passée en paramètre correspond
	 * à celle recherchée
	 *
	 * @param version string or array condition permettant de savoir si la version courante correspond à celle recherchée
	 * @return bool or string
	 *
	 * @author Cyril MAGUIRE
	 */
	public static function isBrowserIE($version=false) {
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')!==FALSE) {
			if ($version) {
				$s = explode(';', $_SERVER['HTTP_USER_AGENT']);
				$v = intval(str_replace('MSIE ','',$s[1]));
				if (is_array($version) && count($version) == 2) {
					switch ($version[0]) {
						case '<':
							if ($v < $version[1]) {
								return true;
							}
							break;
						case '<=':
							if ($v <= $version[1]) {
								return true;
							}
							break;
						case '>':
							if ($v > $version[1]) {
								return true;
							}
							break;
						case '>=':
							if ($v >= $version[1]) {
								return true;
							}
							break;
						case '==':
							if ($v == $version[1]) {
								return true;
							}
							break;
						case '!=':
							if ($v != $version[1]) {
								return true;
							}
							break;
						
						default:
							return false;
							break;
					}
				} else {
					return $v;
				}
			} else {
				return true;
			}
		} else {
			return false;
		}
	}

	/**
	 * Méthode permettant de télécharger une image png constituée à partir des données du svg
	 *
	 * @param null
	 * @return file
	 *
	 * @author Cyril MAGUIRE
	 */
	public function Index() {
		
		$plxMotor = plxMotor::getInstance();
		$get = (!empty($plxMotor->path_url) ? $plxMotor->path_url : $plxMotor->get);
		if (strpos($get, 'downloadSvg') !== false) {
			$svg = strip_tags(basename($get));
			if (!is_dir(PLX_PHPGRAPH_IMG.DIRECTORY_SEPARATOR.$svg)) {
				mkdir(PLX_PHPGRAPH_IMG.DIRECTORY_SEPARATOR.$svg);
			}
			$png = PLX_PHPGRAPH_IMG.DIRECTORY_SEPARATOR.$svg.DIRECTORY_SEPARATOR.$svg.'.png';
			file_put_contents($png, base64_decode(str_replace('data:image/png;base64,','',$_POST['svgToDownload'])));
			header('Content-Description: File Transfer');
			header('Content-Type: application/png');
			header("Content-Disposition: attachment; filename=\"".$svg.".png\"");
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: no-cache');
			header('Content-Length: '.filesize($png));
			readfile($png);
			exit();
		}
	}

	/**
	 * Méthode qui parse les données issues d'un article
	 *
	 * @param null
	 * @return	string
	 *
	 * @author	Cyril MAGUIRE
	 **/	
	public function parseDataOfArticles() {

		echo '<?php
		$art[\'chapo\'] = phpGraphForPluxml::parseData($art[\'chapo\'],$art[\'numero\'],\'chapo\');
		$art[\'content\'] =  phpGraphForPluxml::parseData($art[\'content\'],$art[\'numero\'],\'content\');
		?>';

	}

	/**
	 * Méthode qui parse les données issues d'une page statique
	 *
	 * @param null
	 * @return	string
	 *
	 * @author	Cyril MAGUIRE
	 **/
	public function parseDataOfStatics() {

		echo '<?php
			$output = phpGraphForPluxml::parseData($output,$this->plxMotor->cible,\'static\');
		?>';

	}

	/**
	 * Méthode qui parse une chaîne de caractères pour en faire un svg
	 *
	 * @param	txt		chaine de caractères à parser
	 * @param	id		page d'origine
	 * @param	type	type de contenu d'origine (chapo, content ou static)
	 * @return	string	chaine de caractères parsée
	 *
	 * @author	Cyril MAGUIRE
	 **/
	public static function parseData($txt,$id,$type) {
		if (strpos($txt, '[graph]') !== false) {

			if (!is_dir(PLX_PHPGRAPH)) {
	            mkdir(PLX_PHPGRAPH,0705);
	            //file_put_contents(PLX_PHPGRAPH.'/.htaccess',"Allow from none\nDeny from all\n", LOCK_EX);
	        }
	        if (!is_dir(PLX_PHPGRAPH_IMG)) {
	            mkdir(PLX_PHPGRAPH_IMG,0705);
	        }

			preg_match_all('/(<pre>.*<\/pre>)/Usi', $txt,$pre);

			if (!empty($pre[0])) {
				foreach ($pre[0] as $preKey => $preValue) {
					$code = str_replace(array('[',']'), array('//-','-//'), $preValue);
					$txt = str_replace($preValue,$code,$txt);
				}
			}

			# On supprime les espaces et les sauts de ligne
			$t = preg_replace("/(\r\n|\n|\r)/s", " ", $txt);
			$t = str_replace(array(' ',"\t","\r\n","\n","\r",CHR(10),CHR(13)), '', trim($t));
			$t = str_replace('[/graph][graph]', "[/graph]\n[graph]", $t);

			preg_match_all('/\(tooltipLegend,(.*)\)/i', $txt, $tooltipLegendSpaces);
			preg_match_all('/\(tooltipLegend,((?:array\()?.*)\){2,3}/U', $t, $tooltipLegendNoSpace);
			foreach ($tooltipLegendNoSpace as $tooltips => $arrayOfTooltips) {
				$t = str_replace($tooltipLegendNoSpace[$tooltips], $tooltipLegendSpaces[$tooltips], $t);
			}
			
			if(preg_match_all('/\[graph\]\[data\](.*)\[\/data\](\[options\](.*)\[\/options\])?\[\/graph\]/Ui', $t, $matches)) {
				foreach ($matches[0] as $key => $m) {
					$id = md5($m.$id.$type);
					preg_match_all('/\(title,(.*)\)/', $txt, $title);
					# (array())


					if (!is_dir(PLX_PHPGRAPH.DIRECTORY_SEPARATOR.$id)) {
						if (isset($matches[1][$key])) {
							$data = $options = array();
							if (strpos($matches[1][$key],'array') === false) {
								$a = str_replace(array('),(',');('), ')(', $matches[1][$key]);
								$a = str_replace(array(',',')(','(',')'), array('=>',',','','') , $a);
								$a = substr($a,0,-1).'"';
								$b = explode(',', $a);
								foreach ($b as $k => $v) {
									$array = explode('=>',$v);
									$data[$array[0]] = (int)$array[1];
								}
							} else {
								$data = array();
								preg_match_all('/([0-9a-zA-Z]*),\(?array(.*\))\)?\)/Ui', $matches[1][$key], $datas);

								foreach ($datas[2] as $K => $V) {
									$a = str_replace(array('),(',');('), ')(', $V);
									$a = str_replace(array(',',')(','(',')'), array('=>',',','','') , $a);
									$b = explode(',', $a);
									foreach ($b as $k => $v) {
										$array = explode('=>',$v);
										$d[$array[0]] = $array[1];
									}
									$data[$datas[1][$K]] = $d;
								}
							}
							$op = str_replace(array('),(',');('), ')(', $matches[2][$key]);
							$op = str_replace(array(',',')(','(',')'), array('=>',',','','') , $op);
							$op = str_replace(array('[options]','[/options]'), '', $op);
							$opt = explode(',', $op);
							foreach ($opt as $k => $v) {
								$array = explode('=>',$v);
								$options[$array[0]] = $array[1];
							}
							if (isset($title[1][0])) {
								$options['title'] = $title[1][0];
							}
							preg_match_all('/([0-9a-z]*),\(?array(.*\))\)?\)/Ui', $matches[3][$key], $op);
							foreach ($op[2] as $cle => $value) {
								$a = str_replace(array('),(',');('), ')(', $value);
								$a = str_replace(array(',',')(','(',')'), array('=>',',','','') , $a);
								$b = explode(',', $a);
								foreach ($b as $k => $v) {
									$array = explode('=>',$v);
									$o[$array[0]] = $array[1];
								}
								$options[$op[1][$cle]] = $o;
							}
							if (isset($title[1][0])) {
								$options['title'] = $title[1][0];
							}
							
							include_once PLX_PLUGINS.'phpGraphForPluxml/phpGraph.php';
							$Graph = phpGraph::getInstance();
							$G = $Graph->draw($data,$options,PLX_PHPGRAPH.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR,$id,false);
						}
					} else {
						if (is_file(PLX_PHPGRAPH.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.$id.'.svg')) {
							$G = file_get_contents(PLX_PHPGRAPH.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.$id.'.svg');
						} else {
							$f = glob(PLX_PHPGRAPH.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.'*.svg');
							$G = file_get_contents(PLX_PHPGRAPH.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.$f.'.svg');
						}
					}
					if (self::isBrowserIE(array('<',10))){
						include_once PLX_PLUGINS.'phpGraphForPluxml/phpGraph.php';
						$Graph = phpGraph::getInstance();
						$G = $Graph->svg2vml($G,$id.'.html',PLX_PHPGRAPH.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR,PLX_PLUGINS.'phpGraphForPluxml/svg2vml/svg2vml.xsl',PLX_ROOT.PLX_PLUGINS.'phpGraphForPluxml/svg2vml/');
					} 
					preg_match_all('/(\[graph\].*\[\/graph\])/sUi', $txt, $rep);
					$txt = str_replace($rep[0][0], $G, $txt);
				}
			}
		}
		if (!empty($pre[0])) {
			foreach ($pre[0] as $preKey => $preValue) {
				$code = str_replace(array('[',']'), array('//-','-//'), $preValue);
				$txt = str_replace($code,$preValue,$txt);
			}
		}
		return $txt;
	}

	/**
	 * Méthode qui inclue le javascript nécessaire à l'export d'un svg en png
	 *
	 * @param null
	 * @return string
	 *
	 * @author Cyril MAGUIRE
	 */
	public function ThemeEndBody() {
		echo "\t".'<script type="text/javascript" src="'.PLX_PLUGINS.'phpGraphForPluxml/svgToCanvasToPng/addLinkToDownload.js"></script>'."\n";
		echo "\t".'<script type="text/javascript" src="'.PLX_PLUGINS.'phpGraphForPluxml/svgToCanvasToPng/rgbcolor.js"></script>'."\n";
		echo "\t".'<script type="text/javascript" src="'.PLX_PLUGINS.'phpGraphForPluxml/svgToCanvasToPng/canvg.js"></script>'."\n";
		echo "\t".'<script type="text/javascript" src="'.PLX_PLUGINS.'phpGraphForPluxml/svgToCanvasToPng/svg_to_canvas.js"></script>'."\n";
		echo "\t".'<script type="text/javascript" src="'.PLX_PLUGINS.'phpGraphForPluxml/svgToCanvasToPng/svg_todataurl.js"></script>'."\n";
	}
}
?>